<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard'; // valeur par défaut

    /**
     * Retourne le dashboard en fonction du rôle.
     */
    public static function redirectTo()
    {
        $user = Auth::user();

        if ($user->hasRole('administrateur')) {
            return '/admin/dashboard';
        }

        if ($user->hasRole('vendeur')) {
            return '/vendeur/dashboard';
        }

        return '/dashboard'; // fallback si pas de rôle
    }

    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
