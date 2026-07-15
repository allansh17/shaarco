<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CustomerDeviceLoginService
{
    public const COOKIE_NAME = 'stc_device_uid';

    public const PAUSED_MESSAGE = 'تم إيقاف حسابك بسبب تسجيل الدخول من جهاز آخر. يرجى التواصل مع الشركة.';

    public function evaluateLogin(Customer $customer, Request $request): array
    {
        $stored = $customer->login_device_hash;
        $deviceCookie = $this->readDeviceCookie($request);

        // First successful login ever: lock this browser as the only allowed device.
        if (empty($stored)) {
            return $this->registerDevice($customer, 'first_login');
        }

        // Same registered browser (cookie matches DB).
        if (
            $deviceCookie['present']
            && !$deviceCookie['legacy']
            && hash_equals($stored, $deviceCookie['value'])
        ) {
            return [
                'allowed' => true,
                'paused' => false,
                'device_uid' => $stored,
                'message' => null,
            ];
        }

        // Old encrypted cookie from before the plain-cookie change: same browser migration only.
        if ($deviceCookie['present'] && $deviceCookie['legacy']) {
            Log::info('Customer device cookie migrated from legacy encryption', [
                'customer_id' => $customer->id,
            ]);

            return [
                'allowed' => true,
                'paused' => false,
                'device_uid' => $stored,
                'message' => null,
            ];
        }

        // Missing cookie (new phone / incognito / cleared data) OR wrong cookie = sharing / other device.
        return $this->pauseForDifferentDevice($customer, $request, $deviceCookie['present'] ? 'cookie_mismatch' : 'missing_cookie');
    }

    public function queueDeviceCookie(Response $response, ?string $deviceUid, ?Request $request = null): Response
    {
        if (!$deviceUid) {
            return $response;
        }

        $request = $request ?? request();

        return $response->cookie(
            self::COOKIE_NAME,
            $deviceUid,
            60 * 24 * 365,
            '/',
            config('session.domain'),
            $this->cookieIsSecure($request),
            true,
            false,
            config('session.same_site', 'lax')
        );
    }

    public function clearRegisteredDevice(Customer $customer): void
    {
        $customer->login_device_hash = null;
        $customer->save();
    }

    private function registerDevice(Customer $customer, string $reason): array
    {
        $newUid = (string) Str::uuid();
        $customer->login_device_hash = $newUid;
        $customer->save();

        Log::info('Customer device registered', [
            'customer_id' => $customer->id,
            'reason' => $reason,
        ]);

        return [
            'allowed' => true,
            'paused' => false,
            'device_uid' => $newUid,
            'message' => null,
        ];
    }

    private function readDeviceCookie(Request $request): array
    {
        if (!$request->cookies->has(self::COOKIE_NAME)) {
            return [
                'present' => false,
                'legacy' => false,
                'value' => '',
            ];
        }

        $raw = (string) $request->cookies->get(self::COOKIE_NAME);

        return [
            'present' => true,
            'legacy' => $this->isLegacyEncryptedCookie($raw),
            'value' => $raw,
        ];
    }

    private function isLegacyEncryptedCookie(string $value): bool
    {
        return str_starts_with($value, 'eyJpdiI6');
    }

    private function pauseForDifferentDevice(Customer $customer, Request $request, string $reason): array
    {
        Log::warning('Customer account paused for device mismatch', [
            'customer_id' => $customer->id,
            'reason' => $reason,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $customer->status = '2';
        $customer->save();

        if (Auth::guard('local')->check() && (int) Auth::guard('local')->id() === (int) $customer->id) {
            Auth::guard('local')->logout();
        }

        return [
            'allowed' => false,
            'paused' => true,
            'device_uid' => null,
            'message' => self::PAUSED_MESSAGE,
        ];
    }

    private function cookieIsSecure(Request $request): bool
    {
        $configured = config('session.secure');

        if ($configured !== null) {
            return (bool) $configured;
        }

        return $request->isSecure();
    }
}
