<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $newUid = (string) Str::uuid();
            $customer->login_device_hash = $newUid;
            $customer->save();

            return [
                'allowed' => true,
                'paused' => false,
                'device_uid' => $newUid,
                'message' => null,
            ];
        }

        if ($cookieUid && hash_equals($stored, $cookieUid)) {
            return [
                'allowed' => true,
                'paused' => false,
                'device_uid' => null,
                'message' => null,
            ];
        }

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

    public function queueDeviceCookie(Response $response, ?string $deviceUid): Response
    {
        if (!$deviceUid) {
            return $response;
        }

        return $response->cookie(
            self::COOKIE_NAME,
            $deviceUid,
            60 * 24 * 365,
            '/',
            null,
            false,
            true,
            false,
            'lax'
        );
    }

    public function clearRegisteredDevice(Customer $customer): void
    {
        $customer->login_device_hash = null;
        $customer->save();
    }
}
