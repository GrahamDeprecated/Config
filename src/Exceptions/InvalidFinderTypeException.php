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
 * This is the invalid finder type exception class.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class InvalidFinderTypeException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid type.
     *
     * @var mixed
     */
    protected $type;

    /**
     * Create a new invalid finder type exception instance.
     *
     * @param mixed $type
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;

        if (is_string($type)) {
            parent::__construct("The provided finder type '$type' was not valid.");
        } else {
            parent::__construct('The provided finder type was not valid.');
        }
    }

    /**
     * Get the invalid type.
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
