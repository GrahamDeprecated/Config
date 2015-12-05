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
 * This is the risky fixer exception class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class RiskyFixerException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The risky fixer.
     *
     * @var mixed
     */
    protected $fixer;

    /**
     * Create a new risky fixer exception instance.
     *
     * @param mixed $fixer
     *
     * @return void
     */
    public function __construct($fixer)
    {
        $this->fixer = $fixer;

        parent::__construct("The provided risky fixer '$fixer' is not allowed.");
    }

    /**
     * Get the risky fixer.
     *
     * @return mixed
     */
    public function getFixer()
    {
        return $this->fixer;
    }
}
