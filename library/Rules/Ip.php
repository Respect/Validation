<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function bccomp;
use function explode;
use function filter_var;
use function ip2long;
use function is_string;
use function long2ip;
use function mb_strpos;
use function mb_substr_count;
use function sprintf;
use function str_repeat;
use function str_replace;
use function strtr;

use const FILTER_VALIDATE_IP;

/**
 * Validates whether the input is a valid IP address.
 *
 * This validator uses the native filter_var() PHP function.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
final class Ip extends AbstractRule
{
    /**
     * @var string|null
     */
    private $range;

    /**
     * @var int|null
     */
    private $options;

    /**
     * @var string|null
     */
    private $startAddress;

    /**
     * @var string|null
     */
    private $endAddress;

    /**
     * @var string|null
     */
    private $mask;

    /**
     * Initializes the rule defining the range and some options for filter_var().
     *
     * @throws ComponentException In case the range is invalid
     */
    public function __construct(string $range = '*', ?int $options = null)
    {
        $this->parseRange($range);
        $this->range = $this->createRange();
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!$this->verifyAddress($input)) {
            return false;
        }

        if ($this->mask) {
            return $this->belongsToSubnet($input);
        }

        if ($this->startAddress && $this->endAddress) {
            return $this->verifyNetwork($input);
        }

        return true;
    }

    private function createRange(): ?string
    {
        if ($this->endAddress && $this->endAddress) {
            return $this->startAddress . '-' . $this->endAddress;
        }

        if ($this->startAddress && $this->mask) {
            return $this->startAddress . '/' . long2ip((int) $this->mask);
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

            if ($this->startAddress !== null && !$this->verifyAddress($this->startAddress)) {
                throw new ComponentException('Invalid network range');
            }

            if ($this->endAddress !== null && !$this->verifyAddress($this->endAddress)) {
                throw new ComponentException('Invalid network range');
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

        throw new ComponentException('Invalid network range');
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
            throw new ComponentException('Invalid network mask');
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
