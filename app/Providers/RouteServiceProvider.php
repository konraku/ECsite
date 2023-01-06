<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    //リダイレクト処理
    public const HOME = '/dashboard';
    public const OWNER_HOME = '/owner/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    //ルートモデルのバインディング、パターンフィルタ、その他のルート設定を定義
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')//middlewareをgroup内全てのルートに割り当てるには、middleware()を使用する
                ->prefix('api')//グループ内の各ルートに特定のURIをプレフィックスとして付ける
                ->group(base_path('routes/api.php'));//group()の全てのURLに割り当て

            Route::prefix('admin')
                ->as('admin.')
                ->middleware('web')
                ->group(base_path('routes/admin/web.php'));

            Route::prefix('owner')
                ->as('owner.')
                ->middleware('web')
                ->group(base_path('routes/owner/web.php'));

            Route::prefix('/')
                ->as('user.')
                ->middleware('web')
                ->group(base_path('routes/web.php'));//user入れない？
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
