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

use InvalidArgumentException;

/**
 * This is the invalid fixer exception class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class InvalidFixerException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid fixer.
     *
     * @var mixed
     */
    protected $fixer;

    /**
     * Create a new invalid fixer exception instance.
     *
     * @param mixed $fixer
     *
     * @return void
     */
    public function __construct($fixer)
    {
        $this->fixer = $fixer;

        if (is_string($fixer)) {
            parent::__construct("The provided fixer '$fixer' was not valid.");
        } else {
            parent::__construct("The provided fixer was not valid.");
        }
    }

    /**
     * Get the invalid fixer.
     *
     * @return mixed
     */
    public function getFixer()
    {
        return $this->fixer;
    }
}
