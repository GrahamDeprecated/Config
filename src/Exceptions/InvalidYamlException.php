<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config\Exceptions;

use Exception;
use RuntimeException;

/**
 * This is the invalid yaml exception class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class InvalidYamlException extends RuntimeException implements ConfigExceptionInterface
{
    /**
     * Create a new invalid yaml exception instance.
     *
     * @param \Exception $previous
     *
     * @return void
     */
    public function __construct(Exception $previous)
    {
        parent::__construct($previous->getMessage(), $previous->getCode(), $previous);
    }
}
