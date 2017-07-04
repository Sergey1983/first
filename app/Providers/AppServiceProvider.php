<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use \Validator;

use App\Services\CustomValidator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('document_num_fail', 'App\Services\CustomValidator@documentNumFailValidate');
        Validator::replacer('document_num_fail', 'App\Services\CustomValidator@documentNumFailReplacer');
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
