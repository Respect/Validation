<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\DataLoader;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_pop;
use function explode;
use function idn_to_ascii;
use function in_array;
use function is_scalar;
use function mb_strlen;
use function mb_strpos;
use function mb_strtoupper;
use function mb_substr;
use function str_contains;
use function str_ends_with;

use const IDNA_DEFAULT;
use const INTL_IDNA_VARIANT_UTS46;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a public domain suffix',
    '{{subject}} must not be a public domain suffix',
)]
final class PublicDomainSuffix extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $rawInput = (string) $input;
        if ($rawInput === '') {
            return true;
        }

        $unicodeInput = $this->normalizeUnicodeInput($rawInput);
        $normalizedInput = $this->normalizeInput($rawInput);

        if (!str_contains($normalizedInput, '.')) {
            return false;
        }

        $parts = explode('.', $normalizedInput);
        $tld = array_pop($parts);
        if ($tld === '') {
            return false;
        }

        $ruleMap = $this->loadRuleMap($tld);
        if ($ruleMap === null) {
            return false;
        }

        if ($this->isValidWithRuleMap($normalizedInput, $ruleMap)) {
            return true;
        }

        if ($normalizedInput === $unicodeInput) {
            return false;
        }

        return $this->isValidWithRuleMap($unicodeInput, $ruleMap);
    }

    /** @param array{rules: list<string>, wildcards: list<string>, exceptions: list<string>} $rules */
    private function isValidWithRuleMap(string $normalizedInput, array $rules): bool
    {
        if (in_array($normalizedInput, $rules['exceptions'], true)) {
            return false;
        }

        if (in_array($normalizedInput, $rules['rules'], true)) {
            return true;
        }

        if ($this->matchesWildcardRule($normalizedInput, $rules['wildcards'])) {
            return true;
        }

        return $this->matchesExceptionParentRule($normalizedInput, $rules['exceptions']);
    }

    private function normalizeInput(string $input): string
    {
        $asciiInput = idn_to_ascii($input, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        if ($asciiInput === false) {
            return $this->normalizeUnicodeInput($input);
        }

        return mb_strtoupper($asciiInput, 'UTF-8');
    }

    private function normalizeUnicodeInput(string $input): string
    {
        return mb_strtoupper($input, 'UTF-8');
    }

    /**
     * @return array{
     *     rules: list<string>,
     *     wildcards: list<string>,
     *     exceptions: list<string>,
     * }|null
     */
    private function loadRuleMap(string $tld): array|null
    {
        $rules = DataLoader::load('domain/public-suffix/' . $tld . '.php');
        if ($rules === []) {
            return null;
        }

        /** @var array{rules: list<string>, wildcards: list<string>, exceptions: list<string>} $ruleMap */
        $ruleMap = $rules;

        return $ruleMap;
    }

    /** @param list<string> $wildcards */
    private function matchesWildcardRule(string $normalizedInput, array $wildcards): bool
    {
        foreach ($wildcards as $wildcardRule) {
            if ($this->hasExactlyOneMoreLabel($normalizedInput, $wildcardRule)) {
                return true;
            }
        }

        return false;
    }

    /** @param list<string> $exceptions */
    private function matchesExceptionParentRule(string $normalizedInput, array $exceptions): bool
    {
        foreach ($exceptions as $exceptionRule) {
            $separatorPosition = mb_strpos($exceptionRule, '.');
            if ($separatorPosition === false) {
                continue;
            }

            $exceptionParent = mb_substr($exceptionRule, $separatorPosition + 1);
            if ($normalizedInput === $exceptionParent) {
                return true;
            }
        }

        return false;
    }

    private function hasExactlyOneMoreLabel(string $value, string $suffix): bool
    {
        if ($value === $suffix || !str_ends_with($value, '.' . $suffix)) {
            return false;
        }

        $prefixLength = mb_strlen($value, 'UTF-8') - mb_strlen($suffix, 'UTF-8') - 1;
        $prefix = mb_substr($value, 0, $prefixLength);

        return $prefix !== '' && !str_contains($prefix, '.');
    }
}
