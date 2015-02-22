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

/**
 * This is the config factory class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ConfigFactory
{
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
        $config = new Config();

        if ($level = Arr::get($parsed, 'level')) {
            $config->setLevel($level);
        }

        if ($enabled = (array) Arr::get($parsed, 'enabled', [])) {
            $config->setEnabled($enabled);
        }

        if ($disabled = (array) Arr::get($parsed, 'disabled', [])) {
            $config->setEnabled($disabled);
        }
    }
}
