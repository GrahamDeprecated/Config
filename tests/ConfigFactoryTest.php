<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Config;

use GrahamCampbell\TestBench\AbstractTestCase;
use StyleCI\Config\ConfigFactory;

/**
 * This is the config factory test case class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class ConfigFactoryTest extends AbstractTestCase
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

        $this->assertInArray('unused_use', $fixers->getFixers());
        $this->assertInArray('phpdoc_no_empty_return', $fixers->getFixers());
        $this->assertNotContains('strict', $fixers->getFixers());
        $this->assertSame(['php'], $config->getExtensions());
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
