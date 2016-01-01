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
     * @var mixed
     */
    protected $option;

    /**
     * Create a new invalid finder option exception instance.
     *
     * @param mixed $option
     *
     * @return void
     */
    public function __construct($option)
    {
        $this->option = $option;

        if (is_scalar($option)) {
            parent::__construct("The provided finder option '$option' was not valid.");
        } else {
            parent::__construct("A provided finder option was not valid.");
        }
    }

    /**
     * Get the invalid finder option.
     *
     * @return mixed
     */
    public function getOption()
    {
        return $this->option;
    }
}
