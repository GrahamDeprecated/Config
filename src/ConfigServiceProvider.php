<?php

declare(strict_types=1);

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

use Illuminate\Support\ServiceProvider;

/**
 * This is the config service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigFactory();
    }

    /**
     * Register the config factory class.
     *
     * @return void
     */
    protected function registerConfigFactory()
    {
        $this->app->singleton('config.factory', function () {
            return new ConfigFactory();
        });

        $this->app->alias('config.factory', ConfigFactory::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'config.factory',
        ];
    }
}
