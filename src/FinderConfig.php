<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Cachet HQ <support@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

use StyleCI\Config\Exceptions\InvalidFinderDirectoryException;

/**
 * This is the finder configuration class.
 *
 * Each configuration is used for a "test", the Finder uses
 * the tests to determine if the matched file fulfills the tests condition.
 *
 * Note that setter methods will overwrite the existing configuration
 * of the related type. So calling in() multiple times will overwrite
 * the previously set values of "in".
 *
 * @author Graham Campbell <graham@cachethq.io>
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class FinderConfig
{
    /**
     * The the files and directories which match the defined rules.
     *
     * Directories are relative to the root-directory of the "project".
     *
     * @var string[]
     */
    protected $in = [];

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
     * The tests for file dates (last modified).
     *
     * The date must be something that strtotime() is able to parse:
     *
     *   'since yesterday'
     *   'until 2 days ago'
     *   '> now - 2 hours'
     *   '>= 2005-10-15'
     *
     * @var string[]
     */
    protected $date = [];

    /**
     * Set the files and directories which match the defined rules.
     *
     * @param string[]|string $dirs
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function in($dirs)
    {
        $dirs = array_map(
            function ($directory) {
                if (!is_string($directory) && !is_numeric($directory)) {
                    throw new InvalidFinderDirectoryException($directory);
                }

                $directory = trim(str_replace('\\', '/', $directory), '/');

                // Detect for directory path traversal.
                if ($directory === '..' || false !== strpos($directory, '../') || false !== strpos($directory, '/..')) {
                    throw new InvalidFinderDirectoryException($directory);
                }

                return $directory;
            },
            (array) $dirs
        );

        $this->in = $dirs;

        return $this;
    }

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
     * Set tests for file dates (last modified).
     *
     * The date must be something that strtotime() is able to parse:
     *
     *   'since yesterday'
     *   'until 2 days ago'
     *   '> now - 2 hours'
     *   '>= 2005-10-15'
     *
     * @param string[]|string $date
     *
     * @return \StyleCI\Config\FinderConfig
     */
    public function date($date)
    {
        $this->date = (array) $date;

        return $this;
    }

    /**
     * Get the files and directories which match the defined rules.
     *
     * @return string[]
     */
    public function getIn()
    {
        return $this->in;
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

    /**
     * Get the tests for file dates (last modified).
     *
     * @return string[]
     */
    public function getDate()
    {
        return $this->date;
    }
}
