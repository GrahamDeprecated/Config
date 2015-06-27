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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use StyleCI\Config\ConfigFactory;
use StyleCI\Config\FinderConfig;

/**
 * This is the config factory test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
 */
class ConfigFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeConfig()
    {
        $fixers = (new ConfigFactory())->make()->getFixers();

        $this->assertInArray('psr0', $fixers);
        $this->assertInArray('encoding', $fixers);
        $this->assertInArray('elseif', $fixers);
        $this->assertNotContains('strict_param', $fixers);
    }

    public function testMakeConfigWithOptions()
    {
        $config = (new ConfigFactory())->make(['preset' => 'symfony']);

        $this->assertInArray('unused_use', $config->getFixers());
        $this->assertInArray('phpdoc_no_empty_return', $config->getFixers());
        $this->assertNotContains('strict', $config->getFixers());
        $this->assertSame(['php'], $config->getExtensions());
        $this->assertSame(['storage'], $config->getExcluded());
    }

    public function testMakeConfigFromYml()
    {
        $fixers = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/config.yml'))->getFixers();

        $this->assertInArray('unused_use', $fixers);
    }

    public function testMakeConfigFromYmlWithEnablers()
    {
        $config = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/custom.yml'));

        $this->assertInArray('phpdoc_no_package', $config->getFixers());
        $this->assertNotContains('psr0', $config->getFixers());
        $this->assertSame(['php', 'php.stub'], $config->getExtensions());
        $this->assertSame(['foo', 'bar'], $config->getExcluded());
    }

    public function testMakeConfigFromYmlWithFinder()
    {
        $config = (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/finder.yml'));

        $this->assertInstanceOf(FinderConfig::class, $config->getFinderConfig());

        $this->assertEquals(['src'], $config->getFinderConfig()->getIn());
        $this->assertEquals(['*.php', '*.php.stub'], $config->getFinderConfig()->getName());
        $this->assertEquals(['foo', 'bar'], $config->getFinderConfig()->getExclude());
        $this->assertEquals(['Kernel'], $config->getFinderConfig()->getNotContains());
        $this->assertEquals(['Fixtures/*'], $config->getFinderConfig()->getNotPath());
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidFinderTypeException
     * @expectedExceptionMessage The provided finder type 'filter' was not valid.
     */
    public function testMakeConfigFromYmlWithInvalidFinderType()
    {
        (new ConfigFactory())->makeFromYaml(file_get_contents(__DIR__.'/stubs/invalid_finder_type.yml'));
    }

    /**
     * @expectedException \StyleCI\Config\Exceptions\InvalidYamlException
     * @expectedExceptionMessage Object support when parsing a YAML file has been disabled
     */
    public function testMakeInvalidConfig()
    {
        (new ConfigFactory())->makeFromYaml('foo: !!php/object:O:30:"foo";}');
    }
}
