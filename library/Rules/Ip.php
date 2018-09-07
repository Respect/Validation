<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use function bccomp;
use function explode;
use function filter_var;
use function ip2long;
use function is_int;
use function long2ip;
use function mb_strpos;
use function mb_substr_count;
use function sprintf;
use function str_replace;
use function strtr;

/**
 * Validates IP Addresses. This validator uses the native filter_var() PHP function.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
final class Ip extends AbstractRule
{
    /**
     * @var int|string
     */
    private $ipOptions;

    /**
     * @var array
     */
    private $range;

    /**
     * @var string
     */
    private $networkRange;

    /**
     * @param int|string $ipOptions
     */
    public function __construct($ipOptions = null)
    {
        if (is_int($ipOptions)) {
            $this->ipOptions = $ipOptions;

            return;
        }

        $this->networkRange = $this->parseRange($ipOptions);
        $this->range = $this->createRange();
    }

    private function createRange(): ?string
    {
        if (!$this->networkRange) {
            return null;
        }

        $range = $this->networkRange;
        $message = $range['min'];

        if (isset($range['max'])) {
            $message .= '-'.$range['max'];
        } else {
            $message .= '/'.long2ip((int) $range['mask']);
        }

        return $message;
    }

    private function parseRange($input)
    {
        if (null === $input || '*' == $input || '*.*.*.*' == $input
            || '0.0.0.0-255.255.255.255' == $input) {
            return;
        }

        $range = ['min' => null, 'max' => null, 'mask' => null];

        if (false !== mb_strpos($input, '-')) {
            list($range['min'], $range['max']) = explode('-', $input);
        } elseif (false !== mb_strpos($input, '*')) {
            $this->parseRangeUsingWildcards($input, $range);
        } elseif (false !== mb_strpos($input, '/')) {
            $this->parseRangeUsingCidr($input, $range);
        } else {
            throw new ComponentException('Invalid network range');
        }

        if (!$this->verifyAddress($range['min'])) {
            throw new ComponentException('Invalid network range');
        }

        if (isset($range['max']) && !$this->verifyAddress($range['max'])) {
            throw new ComponentException('Invalid network range');
        }

        return $range;
    }

    private function fillAddress(&$input, $char = '*'): void
    {
        while (mb_substr_count($input, '.') < 3) {
            $input .= '.'.$char;
        }
    }

    private function parseRangeUsingWildcards($input, &$range): void
    {
        $this->fillAddress($input);

        $range['min'] = strtr($input, '*', '0');
        $range['max'] = str_replace('*', '255', $input);
    }

    private function parseRangeUsingCidr($input, &$range): void
    {
        $input = explode('/', $input);
        $this->fillAddress($input[0], '0');

        $range['min'] = $input[0];
        $isAddressMask = false !== mb_strpos($input[1], '.');

        if ($isAddressMask && $this->verifyAddress($input[1])) {
            $range['mask'] = sprintf('%032b', ip2long($input[1]));

            return;
        }

        if ($isAddressMask || $input[1] < 8 || $input[1] > 30) {
            throw new ComponentException('Invalid network mask');
        }

        $range['mask'] = sprintf('%032b', ip2long(long2ip(~(2 ** (32 - $input[1]) - 1))));
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return $this->verifyAddress($input) && $this->verifyNetwork($input);
    }

    private function verifyAddress($address)
    {
        return (bool) filter_var(
            $address,
            FILTER_VALIDATE_IP,
            [
                'flags' => $this->ipOptions,
            ]
        );
    }

    private function verifyNetwork($input)
    {
        if (null === $this->networkRange) {
            return true;
        }

        if (isset($this->networkRange['mask'])) {
            return $this->belongsToSubnet($input);
        }

        $input = sprintf('%u', ip2long($input));

        return bccomp($input, sprintf('%u', ip2long($this->networkRange['min']))) >= 0
               && bccomp($input, sprintf('%u', ip2long($this->networkRange['max']))) <= 0;
    }

    private function belongsToSubnet($input)
    {
        $range = $this->networkRange;
        $min = sprintf('%032b', ip2long($range['min']));
        $input = sprintf('%032b', ip2long($input));

        return ($input & $range['mask']) === ($min & $range['mask']);
    }
}
