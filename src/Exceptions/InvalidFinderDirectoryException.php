<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Cachet HQ <support@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config\Exceptions;

use InvalidArgumentException;

/**
 * This is the invalid finder directory exception class.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class InvalidFinderDirectoryException extends InvalidArgumentException implements ConfigExceptionInterface
{
    /**
     * The invalid directory.
     *
     * @var mixed
     */
    protected $directory;

    /**
     * Create a new invalid finder directory exception instance.
     *
     * @param mixed $directory
     *
     * @return void
     */
    public function __construct($directory)
    {
        $this->directory = $directory;

        if (is_string($directory)) {
            parent::__construct("The provided finder directory '$directory' was not valid.");
        } else {
            parent::__construct('The provided finder directory was not valid.');
        }
    }

    /**
     * Get the invalid directory.
     *
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }
}
