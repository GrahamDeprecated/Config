<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three LTD <support@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config\Exceptions;

use InvalidArgumentException;

/**
 * This is the invalid fixers exception class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class InvalidFixersException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid fixers.
     *
     * @var string[]
     */
    protected $fixers;

    /**
     * Create a new invalid fixer exception instance.
     *
     * @param string[] $fixers
     *
     * @return void
     */
    public function __construct(array $fixers)
    {
        $this->fixers = $fixers;

        parent::__construct("The provided fixer '$fixers[0]' cannot be enabled at the same time as '$fixers[1]'.");
    }

    /**
     * Get the invalid fixers.
     *
     * @return string[]
     */
    public function getFixers()
    {
        return $this->fixers;
    }
}
