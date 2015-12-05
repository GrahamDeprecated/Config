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

use Exception;
use GrahamCampbell\TestBench\AbstractTestCase;
use StyleCI\Config\Config;
use StyleCI\Config\FinderConfig;

/**
 * This is the config test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
 */
class ConfigTest extends AbstractTestCase
{
    public function testPreset()
    {
        $fixers = (new Config())->preset('recommended')->getFixers();

        $this->assertInArray('elseif', $fixers);
        $this->assertInArray('encoding', $fixers);
        $this->assertInArray('psr4', $fixers);
        $this->assertNotContains('logical_not_operators_with_spaces', $fixers);
    }

    public function testPresetAgain()
    {
        $fixers = (new Config())->preset('psr2')->getFixers();

        $this->assertNotContains('psr0', $fixers);
        $this->assertInArray('visibility', $fixers);
    }

    public function testLaravelPreset()
    {
        $fixers = (new Config())->preset('laravel')->getFixers();

        $this->assertInArray('visibility', $fixers);
        $this->assertNotContains('phpdoc_align', $fixers);
        $this->assertNotContains('psr0', $fixers);
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

        $this->assertSame([], $fixers);
    }

    public function testWithAlias()
    {
        $fixers = (new Config())->preset('none')->enable('phpdoc_params')->getFixers();

        $this->assertSame(['phpdoc_align'], $fixers);
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
     * @expectedExceptionMessage The provided fixer '123' was not valid.
     */
    public function testEnableInvalidNumericFixer()
    {
        try {
            (new Config())->enable(123);
        } catch (Exception $e) {
            $this->assertSame(123, $e->getFixer());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixerException
     * @expectedExceptionMessage A provided fixer was not valid.
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
     * @expectedException \StyleCI\Config\Exceptions\RiskyFixerException
     * @expectedExceptionMessage The provided risky fixer 'psr4' is not allowed.
     */
    public function testEnableRiskyFixer()
    {
        try {
            (new Config(false))->enable('psr4');
        } catch (Exception $e) {
            $this->assertSame('psr4', $e->getFixer());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\FixerAlreadyEnabledException
     * @expectedExceptionMessage The provided fixer 'phpdoc_indent' cannot be enabled again because it was already enabled by your preset.
     */
    public function testEnableAlreadyEnabledFixer()
    {
        try {
            (new Config())->preset('symfony')->enable('phpdoc_indent');
        } catch (Exception $e) {
            $this->assertSame('phpdoc_indent', $e->getFixer());
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
     * @expectedExceptionMessage The provided preset 'invalid' was not valid.
     */
    public function testEnableInvalidPreset()
    {
        try {
            (new Config())->preset('invalid');
        } catch (Exception $e) {
            $this->assertSame('invalid', $e->getPreset());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidPresetException
     * @expectedExceptionMessage A provided preset was not valid.
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

    public function testPsr1PresetWithRisky()
    {
        $config = (new Config(true))->preset('psr1');

        $this->assertSame(['encoding', 'psr4', 'short_tag'], $config->getFixers());
    }

    public function testPsr1PresetWithoutRisky()
    {
        $config = (new Config(false))->preset('psr1');

        $this->assertSame(['encoding', 'short_tag'], $config->getFixers());
    }

    public function testDisableConfig()
    {
        $config = new Config();

        $config->preset('recommended');
        $this->assertInArray('psr4', $config->getFixers());

        $config->disable('psr4');
        $this->assertNotContains('psr4', $config->getFixers());
    }

    public function testDisableConfigWithAlias()
    {
        $config = new Config();

        $config->preset('recommended');
        $this->assertInArray('phpdoc_align', $config->getFixers());

        $config->disable('phpdoc_params');
        $this->assertNotContains('phpdoc_align', $config->getFixers());
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFixerException
     * @expectedExceptionMessage The provided fixer 'foo' was not valid.
     */
    public function testDisableInvalidFixer()
    {
        try {
            (new Config())->preset('psr2')->disable('foo');
        } catch (Exception $e) {
            $this->assertSame('foo', $e->getFixer());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\FixerNotEnabledException
     * @expectedExceptionMessage The provided fixer 'psr0' cannot be disabled unless it was already enabled by your preset.
     */
    public function testDisableBadFixer()
    {
        try {
            (new Config())->preset('psr2')->disable('psr0');
        } catch (Exception $e) {
            $this->assertSame('psr0', $e->getFixer());
            throw $e;
        }
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
