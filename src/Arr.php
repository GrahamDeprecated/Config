<?php

/*
 * This file is part of StyleCI Config.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

/**
 * This is the array helper class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Arr
{
    /**
     * Get an item from an array.
     *
     * @param array  $array
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public static function get(&$array, $key, $default)
    {
        if (in_array($key, $array, true)) {
            return $array[$key];
        }

        return $default;
    }

    /**
     * Add an item to an array.
     *
     * @param array $array
     * @param mixed $item
     *
     * @return void
     */
    public static function add(&$array, $item)
    {
        if (!in_array($item, $array, true)) {
            $array[] = $item;
        }
    }
}
