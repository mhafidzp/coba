<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Notifikasi;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if(Auth::check()){

                    $notif = Notifikasi::where('user_id', auth()->user()->id)
                    ->orderBy('id','desc')
                    ->get();

                    $notif_count = Notifikasi::where('user_id', auth()->user()->id)->where('status','0')->count();

                $view->with(['notif' => $notif, 'notif_count' => $notif_count]);
            }

        });
    }
}
