<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExcludeCsrfForWebhook
{
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah request menuju ke /notification/handling
        if ($request->is('notification/handling')) {
            // Lewati pengecekan CSRF untuk route tersebut
            return $next($request);
        }

        // Jalankan pengecekan CSRF untuk request lainnya
        return app(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
            ->handle($request, $next);
    }
}
