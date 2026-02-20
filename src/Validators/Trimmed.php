<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must not contain leading or trailing whitespace',
    '{{subject}} must contain leading or trailing whitespace',
    Validator::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must not contain leading or trailing {{trimValues|list:or}}',
    '{{subject}} must contain leading or trailing {{trimValues|list:or}}',
    self::TEMPLATE_CUSTOM,
)]
final class Trimmed extends Envelope
{
    public const string TEMPLATE_CUSTOM = '__custom__';

    /** Unicode whitespace and zero-width characters. */
    private const array DEFAULT_TRIM_VALUES = [
        "\u{0009}", // CHARACTER TABULATION
        "\u{000A}", // LINE FEED
        "\u{000B}", // LINE TABULATION
        "\u{000C}", // FORM FEED
        "\u{000D}", // CARRIAGE RETURN
        "\u{0020}", // SPACE
        "\u{0085}", // NEXT LINE
        "\u{00A0}", // NO-BREAK SPACE
        "\u{1680}", // OGHAM SPACE MARK
        "\u{180E}", // MONGOLIAN VOWEL SEPARATOR
        "\u{2000}", // EN QUAD
        "\u{2001}", // EM QUAD
        "\u{2002}", // EN SPACE
        "\u{2003}", // EM SPACE
        "\u{2004}", // THREE-PER-EM SPACE
        "\u{2005}", // FOUR-PER-EM SPACE
        "\u{2006}", // SIX-PER-EM SPACE
        "\u{2007}", // FIGURE SPACE
        "\u{2008}", // PUNCTUATION SPACE
        "\u{2009}", // THIN SPACE
        "\u{200A}", // HAIR SPACE
        "\u{200B}", // ZERO WIDTH SPACE
        "\u{200C}", // ZERO WIDTH NON-JOINER
        "\u{200D}", // ZERO WIDTH JOINER
        "\u{2028}", // LINE SEPARATOR
        "\u{2029}", // PARAGRAPH SEPARATOR
        "\u{202F}", // NARROW NO-BREAK SPACE
        "\u{205F}", // MEDIUM MATHEMATICAL SPACE
        "\u{2060}", // WORD JOINER
        "\u{3000}", // IDEOGRAPHIC SPACE
        "\u{FEFF}", // ZERO WIDTH NO-BREAK SPACE
    ];

    public function __construct(string ...$trimValues)
    {
        $hasCustomTrimValues = $trimValues !== [];
        $trimValues = $hasCustomTrimValues ? $trimValues : self::DEFAULT_TRIM_VALUES;

        parent::__construct(
            new ShortCircuit(
                new StringType(),
                new Not(
                    new AnyOf(
                        new StartsWith(...$trimValues),
                        new EndsWith(...$trimValues),
                    ),
                ),
            ),
            $hasCustomTrimValues ? ['trimValues' => $trimValues] : [],
            $hasCustomTrimValues ? self::TEMPLATE_CUSTOM : Validator::TEMPLATE_STANDARD,
        );
    }
}
