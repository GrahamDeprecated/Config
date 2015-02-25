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
use StyleCI\Config\Arr;

/**
 * This is the array helper test case class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class ArrTest extends AbstractTestCase
{
    public function testArrayGet()
    {
        $array = ['foo' => 'bar'];

        $normalValue = Arr::get($array, 'foo');
        $defaultValue = Arr::get($array, 'baz', 'default');

        $this->assertEquals('bar', $normalValue);
        $this->assertEquals('default', $defaultValue);
    }

    public function testArrayAdd()
    {
        $array = ['foo', 'bar'];

        Arr::add($array, 'baz');

        $this->assertCount(3, $array);
    }

    public function testArrayRemove()
    {
        $array = ['foo', 'bar'];

        Arr::remove($array, 'foo');

        $this->assertCount(1, $array);
    }
}
