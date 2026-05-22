<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Services\CustomerDeviceLoginService;
use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureLocalCustomerActive
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('local')->check()) {
            return $next($request);
        }

        $customer = Customer::find(Auth::guard('local')->id());

        if (!$customer || (string) $customer->status !== '1') {
            Auth::guard('local')->logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => CustomerDeviceLoginService::PAUSED_MESSAGE,
                ], 403);
            }

            return redirect()->route('sign_in')->with([
                'failed' => CustomerDeviceLoginService::PAUSED_MESSAGE,
            ]);
        }

        return $next($request);
    }
}
