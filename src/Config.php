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

use StyleCI\Config\Exceptions\InvalidFixerException;
use StyleCI\Config\Exceptions\InvalidPresetException;

/**
 * This is the config class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Config
{
    /**
     * The list of valid fixers.
     *
     * @var string[]
     */
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
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_params',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',
        'align_double_arrow',
        'align_equals',
        'concat_with_spaces',
        'ereg_to_preg',
        'long_array_syntax',
        'multiline_spaces_before_semicolon',
        'newline_after_open_tag',
        'no_blank_lines_before_namespace',
        'ordered_use',
        'php4_constructor',
        'phpdoc_order',
        'phpdoc_var_to_type',
        'short_array_syntax',
        'strict',
        'strict_param',
    ];

    /**
     * The list of psr1 fixers.
     *
     * @var string[]
     */
    protected static $psr1Fixers = [
        'psr0',
        'encoding',
        'short_tag',
    ];

    /**
     * The list of psr2 fixers.
     *
     * @var string[]
     */
    protected static $psr2Fixers = [
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
     * The list of symfony fixers.
     *
     * @var string[]
     */
    protected static $symfonyFixers = [
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
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_params',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',
    ];

    /**
     * The list of laravel fixers.
     *
     * @var string[]
     */
    protected static $laravelFixers = [
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
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_package',
        'phpdoc_scalar',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',
        'multiline_spaces_before_semicolon',
        'short_array_syntax',
    ];

    /**
     * The list of recommended fixers.
     *
     * @var string[]
     */
    protected static $recommendedFixers = [
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
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_package',
        'phpdoc_params',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',
        'align_double_arrow',
        'multiline_spaces_before_semicolon',
        'ordered_use',
        'phpdoc_order',
        'short_array_syntax',
    ];

    /**
     * The enabled fixers.
     *
     * @var string[]
     */
    protected $fixers = [];

    /**
     * The enabled file extensions.
     *
     * @var string[]
     */
    protected $extensions = [];

    /**
     * Set the enabled fixers to a preset.
     *
     * It should be noted that this will totally discard the list of already
     * enabled fixers, not append to it.
     *
     * @param string $preset
     *
     * @throws \StyleCI\Config\Exceptions\InvalidPresetException
     *
     * @return \StyleCI\Config\Config
     */
    public function preset($preset)
    {
        switch ($preset) {
            case 'none':
                $this->fixers = [];
                break;
            case 'psr1':
            case 'psr-1':
                $this->fixers = static::$psr1Fixers;
                break;
            case 'psr2':
            case 'psr-2':
                $this->fixers = static::$psr2Fixers;
                break;
            case 'symfony':
                $this->fixers = static::$symfonyFixers;
                break;
            case 'laravel':
                $this->fixers = static::$laravelFixers;
                break;
            case 'recommended':
            case 'styleci':
                $this->fixers = static::$recommendedFixers;
                break;
            default:
                throw new InvalidPresetException($preset);
        }

        return $this;
    }

    /**
     * Enable a fixer, if not already enabled.
     *
     * @param string $fixer
     *
     * @throws \StyleCI\Config\Exceptions\InvalidFixerException
     *
     * @return \StyleCI\Config\Config
     */
    public function enable($fixer)
    {
        if (!is_string($fixer) || !in_array($fixer, static::$validFixers, true)) {
            throw new InvalidFixerException($fixer);
        }

        Arr::add($this->fixers, $fixer);

        return $this;
    }

    /**
     * Disable a fixer, if already enabled.
     *
     * @param string $fixer
     *
     * @return \StyleCI\Config\Config
     */
    public function disable($fixer)
    {
        Arr::remove($this->fixers, $fixer);

        return $this;
    }

    /**
     * Get the enabled fixers.
     *
     * @return string[]
     */
    public function getFixers()
    {
        return $this->fixers;
    }

    /**
     * Set the enabled file extensions.
     *
     * @param string[] $extensions
     *
     * @return \StyleCI\Config\Config
     */
    public function extensions(array $extensions)
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * Get the enabled file extensions.
     *
     * @return string[]
     */
    public function getExtensions()
    {
        return $this->fixers;
    }

}
