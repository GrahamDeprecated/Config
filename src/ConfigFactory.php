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

use InvalidArgumentException;
use StyleCI\Config\Exceptions\InvalidConfigOptionException;
use StyleCI\Config\Exceptions\InvalidFinderOptionException;
use StyleCI\Config\Exceptions\InvalidYamlException;
use Symfony\Component\Yaml\Yaml;
use Throwable;

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
        foreach ($input as $option => $value) {
            if (!in_array($option, ['preset', 'risky', 'linting', 'disabled', 'enabled', 'finder'], true)) {
                throw new InvalidConfigOptionException($option);
            }
        }

        $config = new Config(Arr::get($input, 'risky', true));

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
        foreach ($input as $option => $value) {
            if (!in_array($option, ['exclude', 'name', 'not-name', 'contains', 'not-contains', 'path', 'not-path', 'depth'], true)) {
                throw new InvalidFinderOptionException($option);
            }
        }

        $config = new FinderConfig();

        $config->exclude((array) Arr::get($input, 'exclude', ['storage', 'vendor']));
        $config->name((array) Arr::get($input, 'name', ['*.php']));
        $config->notName((array) Arr::get($input, 'not-name', ['*.blade.php']));
        $config->contains((array) Arr::get($input, 'contains', []));
        $config->notContains((array) Arr::get($input, 'not-contains', []));
        $config->path((array) Arr::get($input, 'path', []));
        $config->notPath((array) Arr::get($input, 'not-path', []));
        $config->depth((array) Arr::get($input, 'depth', []));

        return $config;
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
    public function makeFromYaml(string $yaml)
    {
        try {
            $parsed = Yaml::parse($yaml, true);
        } catch (Throwable $e) {
            throw new InvalidYamlException($e);
        }

        if (!is_array($parsed)) {
            throw new InvalidYamlException(new InvalidArgumentException('The yaml must represent an array.'));
        }

        return $this->make($parsed);
    }
}
