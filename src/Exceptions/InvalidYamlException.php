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

use RuntimeException;

/**
 * This is the invalid yaml exception class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class InvalidYamlException extends RuntimeException implements ConfigExceptionInterface
{
    /**
     * Create a new invalid yaml exception instance.
     *
     * @param \Throwable $previous
     *
     * @return void
     */
    public function __construct($previous)
    {
        parent::__construct($previous->getMessage(), $previous->getCode(), $previous);
    }
}
