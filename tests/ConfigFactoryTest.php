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
use StyleCI\Config\ConfigFactory;
use StyleCI\Config\FinderConfig;

/**
 * This is the config factory test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
 */
class ConfigFactoryTest extends AbstractTestCase
{
    public function testMakeConfig()
    {
        $config = (new ConfigFactory())->make();

        $this->assertInArray('psr4', $config->getFixers());
        $this->assertInArray('encoding', $config->getFixers());
        $this->assertInArray('elseif', $config->getFixers());
        $this->assertNotContains('strict_param', $config->getFixers());

        $this->assertEquals(['*.php'], $config->getFinderConfig()->getName());
        $this->assertEquals(['storage', 'vendor'], $config->getFinderConfig()->getExclude());
        $this->assertEquals([], $config->getFinderConfig()->getNotContains());
        $this->assertEquals([], $config->getFinderConfig()->getNotPath());
    }

    public function testMakeConfigSymfonyWithOptions()
    {
        $config = (new ConfigFactory())->make(['preset' => 'symfony']);

        $this->assertInArray('psr4', $config->getFixers());
        $this->assertInArray('unused_use', $config->getFixers());
        $this->assertInArray('phpdoc_no_empty_return', $config->getFixers());
        $this->assertNotContains('strict', $config->getFixers());
        $this->assertTrue($config->isLinting());
    }

    public function testMakeConfigSymfonyWithOptionsNoRisky()
    {
        $config = (new ConfigFactory())->make(['preset' => 'symfony', 'risky' => false]);

        $this->assertInArray('unused_use', $config->getFixers());
        $this->assertInArray('phpdoc_no_empty_return', $config->getFixers());
        $this->assertNotContains('psr4', $config->getFixers());
        $this->assertNotContains('strict', $config->getFixers());
        $this->assertTrue($config->isLinting());
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidConfigOptionException
     * @expectedExceptionMessage The provided config option 'presett' was not valid.
     */
    public function testMakeInvalidConfigOption()
    {
        try {
            (new ConfigFactory())->make(['presett' => 'symfony']);
        } catch (Exception $e) {
            $this->assertSame('presett', $e->getOption());
            throw $e;
        }
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFinderOptionException
     * @expectedExceptionMessage The provided finder option 'foo' was not valid.
     */
    public function testMakeInvalidFinderOption()
    {
        try {
            (new ConfigFactory())->make(['finder' => ['foo' => 'bar']]);
        } catch (Exception $e) {
            $this->assertSame('foo', $e->getOption());
            throw $e;
        }
    }

    public function testMakeConfigFromYml()
    {
        $fixers = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/config.yml'))->getFixers();

        $this->assertInArray('unused_use', $fixers);
    }

    public function testMakeConfigFromYmlWithEnablers()
    {
        $config = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/custom.yml'));

        $this->assertSame(['short_tag', 'phpdoc_no_package'], $config->getFixers());
        $this->assertFalse($config->isLinting());
    }

    public function testMakeConfigFromYmlWithFinder()
    {
        $config = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/finder.yml'));

        $this->assertInstanceOf(FinderConfig::class, $config->getFinderConfig());

        $this->assertEquals(['*.php', '*.php.stub'], $config->getFinderConfig()->getName());
        $this->assertEquals(['foo', 'bar'], $config->getFinderConfig()->getExclude());
        $this->assertEquals(['Kernel'], $config->getFinderConfig()->getNotContains());
        $this->assertEquals(['Fixtures/*'], $config->getFinderConfig()->getNotPath());
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidYamlException
     * @expectedExceptionMessage Object support when parsing a YAML file has been disabled
     */
    public function testMakeInvalidConfig()
    {
        (new ConfigFactory())->makeFromYaml('foo: !!php/object:O:30:"foo";}');
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidYamlException
     * @expectedExceptionMessage The yaml must represent an array.
     */
    public function testMakeNonArrayConfig()
    {
        (new ConfigFactory())->makeFromYaml(123);
    }
}
