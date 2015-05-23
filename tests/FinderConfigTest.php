<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Config;

use stdClass;
use StyleCI\Config\Exceptions\InvalidFinderDirectoryException;
use StyleCI\Config\FinderConfig;

/**
 * This is the finder config test case class.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class FinderConfigTest extends AbstractTestCase
{
    public function testIn()
    {
        $in = (new FinderConfig())->in(['src/', '/tests/', 'lib/my'])->getIn();

        $this->assertEquals(['src', 'tests', 'lib/my'], $in);
    }

    public function testExclude()
    {
        $exclude = (new FinderConfig())->exclude(['fixtures', 'spec'])->getExclude();

        $this->assertEquals(['fixtures', 'spec'], $exclude);
    }

    public function testName()
    {
        $name = (new FinderConfig())->name(['*.php', '*.php.stub'])->getName();

        $this->assertEquals(['*.php', '*.php.stub'], $name);
    }

    public function testNotName()
    {
        $notName = (new FinderConfig())->notName(['*.blade.php', '*.html.php'])->getNotName();

        $this->assertEquals(['*.blade.php', '*.html.php'], $notName);
    }

    public function testContains()
    {
        $contains = (new FinderConfig())->contains('<'.'?php')->getContains();

        $this->assertEquals(['<'.'?php'], $contains);
    }

    public function testNotContains()
    {
        $notContains = (new FinderConfig())->notContains('Kernel')->getNotContains();

        $this->assertEquals(['Kernel'], $notContains);
    }

    public function testPath()
    {
        $path = (new FinderConfig())->path(['foo'])->getPath();

        $this->assertEquals(['foo'], $path);
    }

    public function testNotPath()
    {
        $notPath = (new FinderConfig())->notpath(['bar'])->getNotPath();

        $this->assertEquals(['bar'], $notPath);
    }

    public function testDepth()
    {
        $depth = (new FinderConfig())->depth(['> 5'])->getDepth();

        $this->assertEquals(['> 5'], $depth);
    }

    public function testDate()
    {
        $date = (new FinderConfig())->date(['> now'])->getDate();

        $this->assertEquals(['> now'], $date);
    }

    /**
     * @dataProvider provideValidDirectories
     */
    public function testInWithValidDirectories($directory)
    {
        $in = (new FinderConfig())->in($directory)->getIn();

        $this->assertEquals((array) $directory, $in);
    }

    /**
     * @dataProvider provideInvalidDirectoriesStrings
     */
    public function testInWithInvalidDirectoryString($directory)
    {
        $directoryDisplay = trim($directory, '/');
        $this->setExpectedException(InvalidFinderDirectoryException::class, "The provided finder directory '$directoryDisplay' was not valid.");

        (new FinderConfig())->in($directory);
    }

    /**
     * @dataProvider provideInvalidDirectoriesValues
     */
    public function testInWithInvalidDirectoryValue($directory)
    {
        $this->setExpectedException(InvalidFinderDirectoryException::class, 'The provided finder directory was not valid.');

        (new FinderConfig())->in([$directory]);
    }

    public static function provideValidDirectories()
    {
        return [
            ['src'],
            ['tests'],
            ['foo bar'],
            ['f2a2'],
            ['foo-bar'],
            [429242],
            [24.10],
            [['src']],
        ];
    }

    public static function provideInvalidDirectoriesStrings()
    {
        return [
            ['../src'],
            ['src/../'],
            ['../'],
            ['/../'],
            ['/..'],
        ];
    }

    public static function provideInvalidDirectoriesValues()
    {
        return [
            [[]],
            [null],
            [false],
            [new stdClass()],
        ];
    }
}
