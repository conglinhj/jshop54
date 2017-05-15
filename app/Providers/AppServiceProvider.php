<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DbCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(DbCart $dbcart)
    {
//        $cart = $dbcart->getCartOfUser(Auth::id());
//        View::share(compact('cart'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
