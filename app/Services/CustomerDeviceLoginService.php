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
        $cookieUid = $request->cookie(self::COOKIE_NAME);
        $stored = $customer->login_device_hash;

        if (empty($stored)) {
            return $this->registerDevice($customer, 'first_login');
        }

        if ($cookieUid && hash_equals($stored, $cookieUid)) {
            return [
                'allowed' => true,
                'paused' => false,
                'device_uid' => $stored,
                'message' => null,
            ];
        }

        if (empty($cookieUid)) {
            return $this->registerDevice($customer, 'missing_cookie_rebind');
        }

        return $this->pauseForDifferentDevice($customer, $request);
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

    private function pauseForDifferentDevice(Customer $customer, Request $request): array
    {
        Log::warning('Customer account paused for device mismatch', [
            'customer_id' => $customer->id,
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
