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
use InvalidArgumentException;
use StyleCI\Config\Exceptions\InvalidYamlException;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the config factory class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     *
     * @return \StyleCI\Config\Config
     */
    public function make(array $input = [])
    {
        $config = new Config();

        $config->preset(Arr::get($input, 'preset', 'recommended'));

        $config->linting((bool) Arr::get($input, 'linting', true));

        foreach ((array) Arr::get($input, 'disabled', []) as $fixer) {
            $config->disable($fixer);
        }

        foreach ((array) Arr::get($input, 'enabled', []) as $fixer) {
            $config->enable($fixer);
        }

        $config->finderConfig($this->makeFinderConfig((array) Arr::get($input, 'finder', [])));

        return $config;
    }

    /**
     * Make a new finder config object.
     *
     * @param array $input
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function makeFinderConfig(array $input = [])
    {
        $finderConfig = new FinderConfig();

        $finderConfig->exclude((array) Arr::get($input, 'exclude', ['storage', 'vendor']));
        $finderConfig->name((array) Arr::get($input, 'name', ['*.php']));
        $finderConfig->notName((array) Arr::get($input, 'not-name', ['*.blade.php']));
        $finderConfig->contains((array) Arr::get($input, 'contains', []));
        $finderConfig->notContains((array) Arr::get($input, 'not-contains', []));
        $finderConfig->path((array) Arr::get($input, 'path', []));
        $finderConfig->notPath((array) Arr::get($input, 'not-path', []));
        $finderConfig->depth((array) Arr::get($input, 'depth', []));

        return $finderConfig;
    }

    /**
     * Make a new config object from the provided yaml input.
     *
     * Note that fairly strict validation happens during this process.
     *
     * @param string $yaml
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

        if (!is_array($parsed)) {
            throw new InvalidYamlException(new InvalidArgumentException('The yaml must represent an array.'));
        }

        return $this->make($parsed);
    }
}
