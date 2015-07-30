<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Config;

use GrahamCampbell\TestBench\AbstractTestCase;
use StyleCI\Config\FinderConfig;

/**
 * This is the finder config test case class.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class FinderConfigTest extends AbstractTestCase
{
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
        $contains = (new FinderConfig())->contains(['<'.'?php'])->getContains();

        $this->assertEquals(['<'.'?php'], $contains);
    }

    public function testNotContains()
    {
        $notContains = (new FinderConfig())->notContains(['Kernel'])->getNotContains();

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
}
