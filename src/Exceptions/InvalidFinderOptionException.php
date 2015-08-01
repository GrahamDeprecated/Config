<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config\Exceptions;

use InvalidArgumentException;

/**
 * This is the invalid finder option exception class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class InvalidFinderOptionException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid finder option.
     *
     * @var string
     */
    protected $option;

    /**
     * Create a new invalid finder option exception instance.
     *
     * @param string $option
     *
     * @return void
     */
    public function __construct($option)
    {
        $this->option = $option;

        parent::__construct("The provided finder option '$option' was not valid.");
    }

    /**
     * Get the invalid finder option.
     *
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }
}
