<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use \Validator;

use App\Services\CustomValidator;
use App\Services\TooMuchValidator;


use App\Tourist;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    



    public function boot()

    {

        $columns = Tourist::FieldsForValidation();

        foreach ($columns as $attribute) {

            $attribute_to_lower = strtolower($attribute); // Rule-name can be only lowercase

            Validator::extend("{$attribute_to_lower}_fail", "App\Services\CustomValidator@{$attribute}FailValidate");
            Validator::replacer("{$attribute_to_lower}_fail", "App\Services\CustomValidator@{$attribute}FailReplace");

        }

            Validator::extend("tour_exists", "App\Services\CustomValidator@tourexistsValidate");
            Validator::replacer("tour_exists", "App\Services\CustomValidator@tourexistsReplace");

            Validator::extend("toomuch", "App\Services\TooMuchValidator@toomuchValidate");

        // Validator::extend("lastName_fail", "App\Services\CustomValidator@lastNameFailValidate");

        // die();


        // $array = array('fullname', 'smth');

        // foreach ($array as $attribute) {
        //         Validator::extend("{$attribute}_fail", "App\Services\CustomValidator@{$attribute}FailValidate");
        // }
        
        // Validator::extend("fullname_fail", "App\Services\CustomValidator@fullnameFailValidate");
        // Validator::extend("smth_fail", "App\Services\CustomValidator@smthFailValidate");
        // Validator::replacer('fullname_fail', "App\Services\CustomValidator@fullnameFailReplace");
        // Validator::replacer('smth_fail', "App\Services\CustomValidator@smthFailReplace");


        
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
