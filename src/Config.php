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
 * This is the config class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Config
{
    /**
     * Enable no fixers.
     *
     * This matches the equivalent constant in php-cs-fixer 1.x.
     *
     * @var int
     */
    const NONE_LEVEL = 0;

    /**
     * Enable psr0 fixers.
     *
     * This matches the equivalent constant in php-cs-fixer 1.x.
     *
     * @var int
     */
    const PSR0_LEVEL = 1;

    /**
     * Enable psr1 fixers.
     *
     * This matches the equivalent constant in php-cs-fixer 1.x.
     *
     * @var int
     */
    const PSR1_LEVEL = 3;

    /**
     * Enable psr2 fixers.
     *
     * This matches the equivalent constant in php-cs-fixer 1.x.
     *
     * @var int
     */
    const PSR2_LEVEL = 7;

    /**
     * Enable symfony fixers.
     *
     * This matches the equivalent constant in php-cs-fixer 1.x.
     *
     * @var int
     */
    const SYMFONY_LEVEL = 15;

    protected static $validFixers = [
        'psr0',
        'encoding',
        'short_tag',
        'braces',
        'elseif',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiple_use',
        'parenthesis',
        'php_closing_tag',
        'single_line_after_imports',
        'trailing_spaces',
        'visibility',
    ];

    /**
     * The fixer level.
     *
     * @var int
     */
    protected $level = static::PSR2_LEVEL;

    /**
     * The enabled fixers.
     *
     * @var string[]
     */
    protected $enabled = [];

    /**
     * The disabled fixers.
     *
     * @var string[]
     */
    protected $disabled = [];

    public function setLevel($level)
    {
        if (is_numeric($level)) {
            $level = (int) $level;
        } elseif (!is_string($level)) {
            throw new InvalidLevelException($level);
        }

        switch ($level) {
            case 'none':
            case 'nothing':
            case static::NONE_LEVEL:
                $this->level = static::NONE_LEVEL;
                break;
            case 'psr0':
            case 'psr-0':
            case static::PSR0_LEVEL:
                $this->level = static::PSR0_LEVEL;
                break;
            case 'psr1':
            case 'psr-1':
            case static::PSR1_LEVEL:
                $this->level = static::PSR1_LEVEL;
                break;
            case 'psr2':
            case 'psr-2':
            case static::PSR1_LEVEL:
                $this->level = static::PSR1_LEVEL;
                break;
            case 'symfony':
            case static::SYMFONY_LEVEL:
                $this->level = static::SYMFONY_LEVEL;
                break;
            default:
                throw new InvalidLevelException($level);
        }
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setEnabled(array $fixers)
    {
        foreach ($fixers as $fixer) {
            $this->addEnabled($fixer);
        }
    }

    public function addEnabled($fixer)
    {
        static::validateFixer($fixer);

        Arr::add($this->enabled, $fixer);
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setDisabled(array $fixers)
    {
        foreach ($fixers as $fixer) {
            $this->addDisabled($fixer);
        }
    }

    public function addDisabled($fixer)
    {
        static::validateFixer($fixer);

        Arr::add($this->disabled, $fixer);
    }

    public function getDisabled()
    {
        return $this->disabled;
    }

    protected static function validateFixer($fixer)
    {
        if (!is_string($fixer) || !in_array($fixer, static::$validFixers, true)) {
            throw new InvalidFixerException($fixer);
        }
    }
}
