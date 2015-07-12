<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

use Exception;
use StyleCI\Config\Exceptions\InvalidFinderException;
use StyleCI\Config\Exceptions\InvalidYamlException;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the config factory class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ConfigFactory
{
    protected static $finderMethods = [
        'exclude',
        'name',
        'notName',
        'contains',
        'notContains',
        'path',
        'notPath',
        'depth',
    ];

    /**
     * Make a new config object.
     *
     * Note that fairly strict validation happens during this process.
     *
     * @param array $input
     *
     * @throws \StyleCI\Config\Exceptions\ConfigExceptionInterface
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

        if (isset($input['finder'])) {
            $config->finderConfig($this->makeFinderConfig(Arr::get($input, 'finder', [])));
        } else {
            $config->extensions((array) Arr::get($input, 'extensions', ['php']));

            $config->excluded((array) Arr::get($input, 'excluded', ['storage']));
        }

        return $config;
    }

    /**
     * Make a new finder config object.
     *
     * @param array $input
     *
     * @throws \StyleCI\Config\Exceptions\InvalidFinderException
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function makeFinderConfig(array $input = [])
    {
        $finderConfig = new FinderConfig();

        foreach ($input as $name => $config) {
            $finderMethod = str_replace(' ', '', lcfirst(ucwords(strtr($name, '_- ', '  '))));

            if (!in_array($finderMethod, self::$finderMethods, true)) {
                throw new InvalidFinderException($name);
            }

            $finderConfig->$finderMethod($config);
        }

        return $finderConfig;
    }

    /**
     * Make a new config object from the provided yaml input.
     *
     * Note that fairly strict validation happens during this process.
     *
     * @throws \StyleCI\Config\Exceptions\ConfigExceptionInterface
     *
     * @return \StyleCI\Config\Config
     */
    public function makeFromYaml($yaml)
    {
        try {
            $parsed = Yaml::parse($yaml, true);
        } catch (Exception $e) {
            throw new InvalidYamlException($e);
        }

        return $this->make($parsed);
    }
}
