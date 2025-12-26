<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function bccomp;
use function explode;
use function filter_var;
use function ip2long;
use function is_string;
use function long2ip;
use function mb_strpos;
use function mb_substr_count;
use function min;
use function sprintf;
use function str_repeat;
use function str_replace;
use function strtr;

use const FILTER_VALIDATE_IP;
use const PHP_INT_MAX;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an IP address',
    '{{subject}} must not be an IP address',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be an IP address in the {{range|raw}} range',
    '{{subject}} must not be an IP address in the {{range|raw}} range',
    self::TEMPLATE_NETWORK_RANGE,
)]
final class Ip implements Rule
{
    public const string TEMPLATE_NETWORK_RANGE = '__network_range__';

    private string|null $range = null;

    private string|null $startAddress = null;

    private string|null $endAddress = null;

    private string|null $mask = null;

    public function __construct(string $range = '*', private int|null $options = null)
    {
        $this->parseRange($range);
        $this->range = $this->createRange();
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['range' => $this->range];
        $template = $this->range ? self::TEMPLATE_NETWORK_RANGE : self::TEMPLATE_STANDARD;
        if (!is_string($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if (!$this->verifyAddress($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if ($this->mask) {
            return Result::of($this->belongsToSubnet($input), $input, $this, $parameters, $template);
        }

        if ($this->startAddress && $this->endAddress) {
            return Result::of($this->verifyNetwork($input), $input, $this, $parameters, $template);
        }

        return Result::passed($input, $this, $parameters, $template);
    }

    private function createRange(): string|null
    {
        if ($this->startAddress && $this->endAddress) {
            return $this->startAddress . '-' . $this->endAddress;
        }

        if ($this->startAddress && $this->mask) {
            return $this->startAddress . '/' . long2ip((int) min($this->mask, PHP_INT_MAX));
        }

        return null;
    }

    private function parseRange(string $input): void
    {
        if ($input == '*' || $input == '*.*.*.*' || $input == '0.0.0.0-255.255.255.255') {
            return;
        }

        if (mb_strpos($input, '-') !== false) {
            [$this->startAddress, $this->endAddress] = explode('-', $input);

            if (is_string($this->startAddress) && !$this->verifyAddress($this->startAddress)) {
                throw new InvalidRuleConstructorException('Invalid network range');
            }

            if (is_string($this->endAddress) && !$this->verifyAddress($this->endAddress)) {
                throw new InvalidRuleConstructorException('Invalid network range');
            }

            return;
        }

        if (mb_strpos($input, '*') !== false) {
            $this->parseRangeUsingWildcards($input);

            return;
        }

        if (mb_strpos($input, '/') !== false) {
            $this->parseRangeUsingCidr($input);

            return;
        }

        throw new InvalidRuleConstructorException('Invalid network range');
    }

    private function fillAddress(string $address, string $fill = '*'): string
    {
        return $address . str_repeat('.' . $fill, 3 - mb_substr_count($address, '.'));
    }

    private function parseRangeUsingWildcards(string $input): void
    {
        $address = $this->fillAddress($input);

        $this->startAddress = strtr($address, '*', '0');
        $this->endAddress = str_replace('*', '255', $address);
    }

    private function parseRangeUsingCidr(string $input): void
    {
        $parts = explode('/', $input);

        $this->startAddress = $this->fillAddress($parts[0], '0');
        $isAddressMask = mb_strpos($parts[1], '.') !== false;

        if ($isAddressMask && $this->verifyAddress($parts[1])) {
            $this->mask = sprintf('%032b', ip2long($parts[1]));

            return;
        }

        if ($isAddressMask || $parts[1] < 8 || $parts[1] > 30) {
            throw new InvalidRuleConstructorException('Invalid network mask');
        }

        $this->mask = sprintf('%032b', ip2long(long2ip(~(2 ** (32 - (int) $parts[1]) - 1))));
    }

    private function verifyAddress(string $address): bool
    {
        return filter_var($address, FILTER_VALIDATE_IP, ['flags' => $this->options]) !== false;
    }

    private function verifyNetwork(string $input): bool
    {
        $input = sprintf('%u', ip2long($input));

        return $this->startAddress !== null
            && $this->endAddress !== null
            && bccomp($input, sprintf('%u', ip2long($this->startAddress))) >= 0
            && bccomp($input, sprintf('%u', ip2long($this->endAddress))) <= 0;
    }

    private function belongsToSubnet(string $input): bool
    {
        if ($this->mask === null || $this->startAddress === null) {
            return false;
        }

        $min = sprintf('%032b', ip2long($this->startAddress));
        $input = sprintf('%032b', ip2long($input));

        return ($input & $this->mask) === ($min & $this->mask);
    }
}
