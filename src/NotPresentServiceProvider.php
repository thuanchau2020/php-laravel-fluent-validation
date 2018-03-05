<?php

namespace Saritasa\Laravel\Validation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Validation\Rule;
use Saritasa\Laravel\Validation\Rules\NotPresent;

class NotPresentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerValidator();

        $this->registerRule();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the "not_present" validator.
     */
    protected function registerValidator()
    {
        $this->app['validator']->extendImplicit('not_present', NotPresent::class . '@validate');
        $this->app['validator']->replacer('not_present', NotPresent::class . '@message');
    }

    /**
     * Register the "not_present" rule macro.
     */
    protected function registerRule()
    {
        if (class_exists('Illuminate\Validation\Rule') && class_uses(Rule::class, Macroable::class)) {
            Rule::macro('not_present', function () {
                return new Rules\NotPresent();
            });
        }
    }
}