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

use function implode;
use function is_string;
use function preg_match;

/**
 * Validates if the input does not contain an emoji.
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class NotEmoji extends AbstractRule
{
    private const GROUPS = [
        '[\x{1F385}-\x{1F9E6}]',
        '[\x{1F331}-\x{1F9A2}]',
        '[\x{1F32D}-\x{1F9C2}]',
        '[\x{1F300}-\x{1F9F3}]',
        '[\x{1F004}-\x{1F9FF}]',
        '[\x{1F399}-\x{1F9FE}]',
        '[\x{1F170}-\x{1F6D0}]',
        '[\x{1F38C}-\x{1F6A9}]',
        '[\x{261D}]',
        '[\x{2620}]',
        '[\x{2639}-\x{263A}]',
        '[\x{26D1}]',
        '[\x{26F7}-\x{26F9}]',
        '[\x{270A}-\x{270D}]',
        '[\x{2763}-\x{2764}]',
        '[\x{2618}]',
        '[\x{2615}]',
        '[\x{231A}-\x{231B}]',
        '[\x{23F0}-\x{23F3}]',
        '[\x{2600}-\x{2604}]',
        '[\x{2614}]',
        '[\x{2668}]',
        '[\x{2693}]',
        '[\x{26A1}]',
        '[\x{26C4}-\x{26C5}]',
        '[\x{26C8}]',
        '[\x{26E9}-\x{26EA}]',
        '[\x{26F0}-\x{26F5}]',
        '[\x{26FA}]',
        '[\x{26FD}]',
        '[\x{2708}]',
        '[\x{2744}]',
        '[\x{2B50}]',
        '[\x{265F}-\x{2660}]',
        '[\x{2663}-\x{2666}]',
        '[\x{26BD}-\x{26BE}]',
        '[\x{26F3}]',
        '[\x{26F8}]',
        '[\x{2728}]',
        '[\x{2328}]',
        '[\x{260E}]',
        '[\x{2692}-\x{2699}]',
        '[\x{26B0}-\x{26B1}]',
        '[\x{26CF}]',
        '[\x{26D3}]',
        '[\x{2702}]',
        '[\x{2709}]',
        '[\x{270F}]',
        '[\x{2712}]',
        '[\x{00A9}]',
        '[\x{00AE}]',
        '[\x{203C}]',
        '[\x{2049}]',
        '[\x{2122}]',
        '[\x{2139}]',
        '[\x{2194}-\x{2199}]',
        '[\x{21A9}-\x{21AA}]',
        '[\x{23CF}]',
        '[\x{23EA}-\x{23EF}]',
        '[\x{23F8}-\x{23FA}]',
        '[\x{24C2}]',
        '[\x{25AA}-\x{25AB}]',
        '[\x{25B6}]',
        '[\x{25C0}]',
        '[\x{25FB}-\x{25FE}]',
        '[\x{2611}]',
        '[\x{2622}-\x{2623}]',
        '[\x{2626}]',
        '[\x{262A}]',
        '[\x{262E}-\x{262F}]',
        '[\x{2638}]',
        '[\x{2640}-\x{2642}]',
        '[\x{2648}-\x{2653}]',
        '[\x{267B}]',
        '[\x{267E}-\x{267F}]',
        '[\x{2695}]',
        '[\x{23E9}]',
        '[\x{269B}-\x{269C}]',
        '[\x{26A0}]',
        '[\x{26AA}-\x{26AB}]',
        '[\x{26CE}]',
        '[\x{26D4}]',
        '[\x{2705}]',
        '[\x{2714}-\x{2716}]',
        '[\x{271D}]',
        '[\x{2721}]',
        '[\x{2733}-\x{2734}]',
        '[\x{2747}]',
        '[\x{274C}-\x{274E}]',
        '[\x{2753}-\x{2757}]',
        '[\x{2795}-\x{2797}]',
        '[\x{27A1}]',
        '[\x{27B0}]',
        '[\x{27BF}]',
        '[\x{2934}-\x{2935}]',
        '[\x{2B05}-\x{2B07}]',
        '[\x{2B1B}-\x{2B1C}]',
        '[\x{2B55}]',
        '[\x{3030}]',
        '[\x{303D}]',
        '[\x{3297}-\x{3299}]',
        '[\x{1F1E6}-\x{1F1FF}]',
        '\x{0023}\x{20E3}',
        '\x{0023}\x{FE0F}\x{20E3}',
        '\x{002A}\x{20E3}',
        '\x{002A}\x{FE0F}\x{20E3}',
        '\x{0030}\x{20E3}',
        '\x{0030}\x{FE0F}\x{20E3}',
        '\x{0031}\x{20E3}',
        '\x{0031}\x{FE0F}\x{20E3}',
        '\x{0032}\x{20E3}',
        '\x{0032}\x{FE0F}\x{20E3}',
        '\x{0033}\x{20E3}',
        '\x{0033}\x{FE0F}\x{20E3}',
        '\x{0034}\x{20E3}',
        '\x{0034}\x{FE0F}\x{20E3}',
        '\x{0035}\x{20E3}',
        '\x{0035}\x{FE0F}\x{20E3}',
        '\x{0036}\x{20E3}',
        '\x{0036}\x{FE0F}\x{20E3}',
        '\x{0037}\x{20E3}',
        '\x{0037}\x{FE0F}\x{20E3}',
        '\x{0038}\x{20E3}',
        '\x{0038}\x{FE0F}\x{20E3}',
        '\x{0039}\x{20E3}',
        '\x{0039}\x{FE0F}\x{20E3}',
    ];

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/'.implode('|', self::GROUPS).'/mu', $input) === 0;
    }
}
