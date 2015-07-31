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

use StyleCI\Config\Exceptions\FixerAlreadyEnabledException;
use StyleCI\Config\Exceptions\FixerNotEnabledException;
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
    const VALID = [
        'alias_functions',
        'align_double_arrow',
        'align_equals',
        'blankline_after_open_tag',
        'braces',
        'concat_without_spaces',
        'concat_with_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'elseif',
        'empty_return',
        'encoding',
        'eof_ending',
        'ereg_to_preg',
        'extra_empty_lines',
        'function_call_space',
        'function_declaration',
        'include',
        'indentation',
        'linefeed',
        'line_after_namespace',
        'list_commas',
        'logical_not_operators_with_spaces',
        'logical_not_operators_with_successor_space',
        'long_array_syntax',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'multiple_use',
        'namespace_no_leading_whitespace',
        'newline_after_open_tag',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_blank_lines_before_namespace',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'ordered_use',
        'parenthesis',
        'php4_constructor',
        'phpdoc_align',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_order',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_to_type',
        'phpdoc_var_without_name',
        'php_closing_tag',
        'pre_increment',
        'php_unit_construct',
        'php_unit_strict',
        'psr0',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'short_array_syntax',
        'short_echo_tag',
        'short_tag',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_line_after_imports',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'strict',
        'strict_param',
        'ternary_spaces',
        'trailing_spaces',
        'trim_array_spaces',
        'unalign_double_arrow',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',
    ];

    /**
     * The list of psr1 fixers.
     *
     * @var string[]
     */
    const PSR1_FIXERS = [
        'encoding',
        'short_tag',
    ];

    /**
     * The list of psr2 fixers.
     *
     * @var string[]
     */
    const PSR2_FIXERS = [
        'braces',
        'elseif',
        'encoding',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'linefeed',
        'line_after_namespace',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiple_use',
        'parenthesis',
        'php_closing_tag',
        'short_tag',
        'single_line_after_imports',
        'trailing_spaces',
        'visibility',
    ];

    /**
     * The list of symfony fixers.
     *
     * @var string[]
     */
    const SYMFONY_FIXERS = [
        'alias_functions',
        'blankline_after_open_tag',
        'braces',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'elseif',
        'empty_return',
        'encoding',
        'eof_ending',
        'extra_empty_lines',
        'function_call_space',
        'function_declaration',
        'include',
        'indentation',
        'linefeed',
        'line_after_namespace',
        'list_commas',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiline_array_trailing_comma',
        'multiple_use',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'parenthesis',
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
        'php_closing_tag',
        'pre_increment',
        'psr0',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'short_tag',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_line_after_imports',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trailing_spaces',
        'trim_array_spaces',
        'unalign_double_arrow',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',
    ];

    /**
     * The list of laravel fixers.
     *
     * @var string[]
     */
    const LARAVEL_FIXERS = [
        'alias_functions',
        'blankline_after_open_tag',
        'braces',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'elseif',
        'empty_return',
        'encoding',
        'eof_ending',
        'extra_empty_lines',
        'function_call_space',
        'function_declaration',
        'include',
        'indentation',
        'linefeed',
        'line_after_namespace',
        'list_commas',
        'logical_not_operators_with_successor_space',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'multiple_use',
        'namespace_no_leading_whitespace',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'parenthesis',
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
        'short_array_syntax',
        'short_echo_tag',
        'short_tag',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_line_after_imports',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trailing_spaces',
        'trim_array_spaces',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',
    ];

    /**
     * The list of recommended fixers.
     *
     * @var string[]
     */
    const RECOMMENDED_FIXERS = [
        'alias_functions',
        'align_double_arrow',
        'blankline_after_open_tag',
        'braces',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'elseif',
        'empty_return',
        'encoding',
        'eof_ending',
        'extra_empty_lines',
        'function_call_space',
        'function_declaration',
        'include',
        'indentation',
        'linefeed',
        'line_after_namespace',
        'list_commas',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'multiple_use',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'ordered_use',
        'parenthesis',
        'phpdoc_align',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        'phpdoc_no_package',
        'phpdoc_order',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'php_closing_tag',
        'psr0',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'return',
        'self_accessor',
        'short_array_syntax',
        'short_tag',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_line_after_imports',
        'single_quote',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trailing_spaces',
        'trim_array_spaces',
        'unalign_equals',
        'unary_operators_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',
    ];

    /**
     * The aliased fixers.
     *
     * @var string[]
     */
    const ALIASES = [
        'phpdoc_params' => 'phpdoc_align',
        'join_function' => 'alias_functions',
    ];

    /**
     * The conflicting fixers.
     *
     * @var string[]
     */
    const CONFLICTS = [
        'concat_with_spaces'              => 'concat_without_spaces',
        'long_array_syntax'               => 'short_array_syntax',
        'no_blank_lines_before_namespace' => 'single_blank_line_before_namespace',
        'phpdoc_var_to_type'              => 'phpdoc_type_to_var',
        'unalign_double_arrow'            => 'align_double_arrow',
        'unalign_equals'                  => 'align_equals',
    ];

    /**
     * The enabled fixers.
     *
     * @var string[]
     */
    protected $fixers = [];

    /**
     * Is linting enabled?
     *
     * @var bool
     */
    protected $linting = true;

    /**
     * The finder config.
     *
     * @var \StyleCI\Config\FinderConfig|null
     */
    protected $finderConfig;

    /**
     * Resolve the fixer name if it's a valid fixer.
     *
     * @param string $fixer
     *
     * @return string|null
     */
    public static function resolveFixer($fixer)
    {
        if (!is_string($fixer)) {
            return;
        }

        if (in_array($fixer, static::VALID, true)) {
            return $fixer;
        }

        if (array_key_exists($fixer, static::ALIASES)) {
            return static::ALIASES[$fixer];
        }
    }

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
        if ($preset === 'none') {
            $this->fixers = [];
        } elseif (is_string($preset) && defined($constant = 'static::'.strtoupper(str_replace('psr-', 'psr', $preset)).'_FIXERS')) {
            $this->fixers = constant($constant);
        } else {
            throw new InvalidPresetException($preset);
        }

        return $this;
    }

    /**
     * Enable a fixer, if not already enabled.
     *
     * @param string $fixer
     *
     * @throws \StyleCI\Config\Exceptions\FixerAlreadyEnabledException|\StyleCI\Config\Exceptions\InvalidFixerException
     *
     * @return \StyleCI\Config\Config
     */
    public function enable($fixer)
    {
        $resolved = static::resolveFixer($fixer);

        if (!$resolved) {
            throw new InvalidFixerException($fixer);
        }

        if (!Arr::add($this->fixers, $resolved)) {
            throw new FixerAlreadyEnabledException($fixer);
        }

        return $this;
    }

    /**
     * Disable a fixer, if already enabled.
     *
     * @param string $fixer
     *
     * @throws \StyleCI\Config\Exceptions\FixerNotEnabledException|\StyleCI\Config\Exceptions\InvalidFixerException
     *
     * @return \StyleCI\Config\Config
     */
    public function disable($fixer)
    {
        $resolved = static::resolveFixer($fixer);

        if (!$resolved) {
            throw new InvalidFixerException($fixer);
        }

        if (!Arr::remove($this->fixers, $resolved)) {
            throw new FixerNotEnabledException($fixer);
        }

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
        foreach (static::CONFLICTS as $first => $second) {
            if (in_array($first, $this->fixers, true) && in_array($second, $this->fixers, true)) {
                throw new InvalidFixersException([$first, $second]);
            }
        }

        return $this->fixers;
    }

    /**
     * Set if linting is enabled.
     *
     * @param bool $linting
     *
     * @return \StyleCI\Config\Config
     */
    public function linting($linting)
    {
        $this->linting = $linting;

        return $this;
    }

    /**
     * Get if linting is enabled.
     *
     * @return bool
     */
    public function isLinting()
    {
        return $this->linting;
    }

    /**
     * Set the finder config.
     *
     * @param \StyleCI\Config\FinderConfig $finderConfig
     *
     * @return \StyleCI\Config\Config
     */
    public function finderConfig(FinderConfig $finderConfig)
    {
        $this->finderConfig = $finderConfig;

        return $this;
    }

    /**
     * Get finder config.
     *
     * @return \StyleCI\Config\FinderConfig|null
     */
    public function getFinderConfig()
    {
        return $this->finderConfig;
    }
}
