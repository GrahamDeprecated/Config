<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

/**
 * This is the finder configuration class.
 *
 * Each configuration is used for a "test", the Finder uses the tests to
 * determine if the matched file fulfills the tests condition. Note that setter
 * methods will overwrite the existing configuration of the related type.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class FinderConfig
{
    /**
     * The directories which are excluded.
     *
     * @var string[]
     */
    protected $exclude = [];

    /**
     * The rules that files must match.
     *
     * @var string[]
     */
    protected $name = [];

    /**
     * The rules that files must not match.
     *
     * @var string[]
     */
    protected $notName = [];

    /**
     * The tests that file contents must match.
     *
     * @var string[]
     */
    protected $contains = [];

    /**
     * The tests that file contents must not match.
     *
     * @var string[]
     */
    protected $notContains = [];

    /**
     * The rules that filenames must match.
     *
     * @var string[]
     */
    protected $path = [];

    /**
     * The rules that filenames must not match.
     *
     * @var string[]
     */
    protected $notPath = [];

    /**
     * The tests for the directory depth.
     *
     * Eg:
     *
     *    '> 1' // the Finder will start matching at level 1.
     *    '< 3' // the Finder will descend at most 3 levels of directories below the starting point.
     *
     * @var string[]
     */
    protected $depth = [];

    /**
     * Set which directories are excluded.
     *
     * @param string[]|string $dirs
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function exclude($dirs)
    {
        $this->exclude = (array) $dirs;

        return $this;
    }

    /**
     * Set the rules that files must match.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function name($patters)
    {
        $this->name = (array) $patters;

        return $this;
    }

    /**
     * Set the rules that files must not match.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function notName($patters)
    {
        $this->notName = (array) $patters;

        return $this;
    }

    /**
     * Set tests that file contents must match.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function contains($patters)
    {
        $this->contains = (array) $patters;

        return $this;
    }

    /**
     * Set tests that file contents must not match.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function notContains($patters)
    {
        $this->notContains = (array) $patters;

        return $this;
    }

    /**
     * Set rules that filenames must match.
     *
     * You can use patterns (delimited with / sign) or simple strings.
     *
     *  'some/special/dir'
     *  '/some\/special\/dir/' // same as above
     *
     * Use only / as dirname separator.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function path($patters)
    {
        $this->path = (array) $patters;

        return $this;
    }

    /**
     * Set rules that filenames must not match.
     *
     * You can use patterns (delimited with / sign) or simple strings.
     *
     *  'some/special/dir'
     *  '/some\/special\/dir/' // same as above
     *
     * Use only / as dirname separator.
     *
     * @param string[]|string $patters
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function notPath($patters)
    {
        $this->notPath = (array) $patters;

        return $this;
    }

    /**
     * Set tests for the directory depth.
     *
     * Usage:
     *
     *   '> 1' // the Finder will start matching at level 1.
     *   '< 3' // the Finder will descend at most 3 levels of directories below the starting point.
     *
     * @param string[]|string $depth
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function depth($depth)
    {
        $this->depth = (array) $depth;

        return $this;
    }

    /**
     * Get the directories which are excluded.
     *
     * @return string[]
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * Get the rules that files must match.
     *
     * @return string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the rules that files must not match.
     *
     * @return string[]
     */
    public function getNotName()
    {
        return $this->notName;
    }

    /**
     * Get rhe tests that file contents must match.
     *
     * @return string[]
     */
    public function getContains()
    {
        return $this->contains;
    }

    /**
     * Get the tests that file contents must not match.
     *
     * @return string[]
     */
    public function getNotContains()
    {
        return $this->notContains;
    }

    /**
     * Get the rules that filenames must match.
     *
     * @return string[]
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the rules that filenames must not match.
     *
     * @return string[]
     */
    public function getNotPath()
    {
        return $this->notPath;
    }

    /**
     * Get the tests for the directory depth.
     *
     * @return string[]
     */
    public function getDepth()
    {
        return $this->depth;
    }
}
