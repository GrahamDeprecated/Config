<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Cachet HQ <support@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config\Exceptions;

use InvalidArgumentException;

/**
 * This is the invalid preset exception class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class InvalidPresetException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid preset.
     *
     * @var mixed
     */
    protected $preset;

    /**
     * Create a new invalid preset exception instance.
     *
     * @param mixed $preset
     *
     * @return void
     */
    public function __construct($preset)
    {
        $this->preset = $preset;

        if (is_string($preset)) {
            parent::__construct("The provided preset '$preset' was not valid.");
        } else {
            parent::__construct('The provided preset was not valid.');
        }
    }

    /**
     * Get the invalid preset.
     *
     * @return mixed
     */
    public function getPreset()
    {
        return $this->preset;
    }
}
