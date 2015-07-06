<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Config;

use StyleCI\Config\Exceptions\InvalidFixerException;
use StyleCI\Config\Exceptions\InvalidFixersException;
use StyleCI\Config\Exceptions\InvalidPresetException;

/**
 * This is the config class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
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
        'alias_functions',
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_align',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'pre_increment',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unalign_double_arrow',
        'unalign_equals',
        'unary_operators_spaces',
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
        'short_echo_tag',
        'strict',
        'strict_param',
    ];

    /**
     * The list of psr1 fixers.
     *
     * @var string[]
     */
    protected static $psr1Fixers = [
        'encoding',
        'short_tag',
    ];

    /**
     * The list of psr2 fixers.
     *
     * @var string[]
     */
    protected static $psr2Fixers = [
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
        'alias_functions',
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_align',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'pre_increment',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unalign_double_arrow',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'whitespacy_lines',
    ];

    /**
     * The list of laravel fixers.
     *
     * @var string[]
     */
    protected static $laravelFixers = [
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
        'single_line_after_imports',
        'trailing_spaces',
        'visibility',
        'alias_functions',
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
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
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unalign_equals',
        'unary_operators_spaces',
        'whitespacy_lines',
        'multiline_spaces_before_semicolon',
        'short_array_syntax',
        'short_echo_tag',
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
        'alias_functions',
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'list_commas',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_align',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        'phpdoc_no_package',
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
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'whitespacy_lines',
        'align_double_arrow',
        'multiline_spaces_before_semicolon',
        'ordered_use',
        'phpdoc_order',
        'short_array_syntax',
    ];

    /**
     * The conflicting fixers.
     *
     * @var string[]
     */
    protected static $conflicts = [
        'phpdoc_var_to_type'              => 'phpdoc_type_to_var',
        'long_array_syntax'               => 'short_array_syntax',
        'concat_with_spaces'              => 'concat_without_spaces',
        'unalign_equals'                  => 'align_equals',
        'unalign_double_arrow'            => 'align_double_arrow',
        'no_blank_lines_before_namespace' => 'single_blank_line_before_namespace',
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
     * The excluded paths.
     *
     * @var string[]
     */
    protected $excluded = [];

    /**
     * The configuration of the Finder.
     *
     * @var \StyleCI\Config\FinderConfig|null
     */
    protected $finderConfig;

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
     * @throws \StyleCI\Config\Exceptions\InvalidFixersException
     *
     * @return string[]
     */
    public function getFixers()
    {
        foreach (static::$conflicts as $first => $second) {
            if (in_array($first, $this->fixers, true) && in_array($second, $this->fixers, true)) {
                throw new InvalidFixersException([$first, $second]);
            }
        }

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
        return $this->extensions;
    }

    /**
     * Set the excluded paths.
     *
     * @param string[] $excluded
     *
     * @return \StyleCI\Config\Config
     */
    public function excluded(array $excluded)
    {
        $this->excluded = $excluded;

        return $this;
    }

    /**
     * Get the excluded paths.
     *
     * @return string[]
     */
    public function getExcluded()
    {
        return $this->excluded;
    }

    /**
     * Set the Finder configuration.
     *
     * @param \StyleCI\Config\FinderConfig $config
     *
     * @return \StyleCI\Config\Config
     */
    public function finderConfig(FinderConfig $config)
    {
        $this->finderConfig = $config;

        return $this;
    }

    /**
     * Get Finder configuration.
     *
     * @return \StyleCI\Config\FinderConfig|null
     */
    public function getFinderConfig()
    {
        return $this->finderConfig;
    }
}
