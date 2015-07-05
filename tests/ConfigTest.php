<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three LTD <support@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Config;

use Exception;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use StyleCI\Config\Config;
use StyleCI\Config\FinderConfig;

/**
 * This is the config test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
 */
class ConfigTest extends AbstractTestBenchTestCase
{
    public function testPreset()
    {
        $fixers = (new Config())->preset('styleci')->getFixers();

        $this->assertInArray('psr0', $fixers);
        $this->assertInArray('encoding', $fixers);
        $this->assertInArray('elseif', $fixers);
    }

    public function testPresetAgain()
    {
        $fixers = (new Config())->preset('psr2')->getFixers();

        $this->assertNotContains('psr0', $fixers);
        $this->assertInArray('visibility', $fixers);
    }

    public function testEnableConfig()
    {
        $fixers = (new Config())->enable('psr0')->getFixers();

        $this->assertInArray('psr0', $fixers);
        $this->assertNotContains('visibility', $fixers);
    }

    public function testWithNoFixers()
    {
        $fixers = (new Config())->preset('none')->getFixers();

        $this->assertSame($fixers, []);
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixerException
     * @expectedExceptionMessage The provided fixer 'foo' was not valid.
     */
    public function testEnableInvalidFixer()
    {
        try {
            (new Config())->enable('foo');
        } catch (Exception $e) {
            $this->assertSame('foo', $e->getFixer());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixerException
     * @expectedExceptionMessage The provided fixer was not valid.
     */
    public function testEnableInvalidFixerAgain()
    {
        try {
            (new Config())->enable([]);
        } catch (Exception $e) {
            $this->assertSame([], $e->getFixer());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixersException
     * @expectedExceptionMessage The provided fixer 'long_array_syntax' cannot be enabled at the same time as 'short_array_syntax'.
     */
    public function testConflictingFixers()
    {
        $config = new Config();

        $config->enable('psr0')->enable('short_array_syntax')->enable('encoding')->enable('long_array_syntax');

        try {
            $config->getFixers();
        } catch (Exception $e) {
            $this->assertSame(['long_array_syntax', 'short_array_syntax'], $e->getFixers());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidPresetException
     * @expectedExceptionMessage The provided preset 'bar' was not valid.
     */
    public function testEnableInvalidPreset()
    {
        try {
            (new Config())->preset('bar');
        } catch (Exception $e) {
            $this->assertSame('bar', $e->getPreset());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidPresetException
     * @expectedExceptionMessage The provided preset was not valid.
     */
    public function testEnableInvalidPresetAgain()
    {
        try {
            (new Config())->preset([]);
        } catch (Exception $e) {
            $this->assertSame([], $e->getPreset());
            throw $e;
        }
    }

    public function testDisableConfig()
    {
        $config = new Config();

        $config->preset('styleci');
        $this->assertInArray('psr0', $config->getFixers());

        $config->disable('psr0');
        $this->assertNotContains('psr0', $config->getFixers());
    }

    public function testFinderConfig()
    {
        $finderConfig = new FinderConfig();

        $config = new Config();

        $this->assertNull($config->getFinderConfig());

        $config->finderConfig($finderConfig);

        $this->assertSame($finderConfig, $config->getFinderConfig());
    }
}
