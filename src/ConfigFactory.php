<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * This is the config factory class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class ConfigFactory
{
    /**
     * Make a new config object.
     *
     * Note that fairly strict validation happens during this process.
     *
     * @param array $input
     *
     * @throws \StyleCI\Config\Exceptions\ConfigExceptionInterface
     * @throws \Symfony\Component\Yaml\Exception\ExceptionInterface
     *
     * @return \StyleCI\Config\Config
     */
    public function make(array $input = [])
    {
        $config = new Config();

        $config->preset(Arr::get($input, 'preset', 'recommended'));

        foreach ((array) Arr::get($input, 'enabled', []) as $fixer) {
            $config->enable($fixer);
        }

        foreach ((array) Arr::get($input, 'disabled', []) as $fixer) {
            $config->disable($fixer);
        }

        return $config;
    }

    /**
     * Make a new config object from the provided yaml input.
     *
     * Note that fairly strict validation happens during this process.
     *
     * @throws \StyleCI\Config\Exceptions\ConfigExceptionInterface
     * @throws \Symfony\Component\Yaml\Exception\ExceptionInterface
     *
     * @return \StyleCI\Config\Config
     */
    public function makeFromYaml($yaml)
    {
        $parsed = Yaml::parse($yaml);

        return $this->make($parsed);
    }
}
