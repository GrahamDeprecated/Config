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

/**
 * This is the array helper class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
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
    public static function get(&$array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
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

    /**
     * Remove an item from an array.
     *
     * @param array $array
     * @param mixed $item
     *
     * @return void
     */
    public static function remove(&$array, $item)
    {
        $index = array_search($item, $array, true);

        if ($index !== false) {
            unset($array[$index]);
        }
    }
}
