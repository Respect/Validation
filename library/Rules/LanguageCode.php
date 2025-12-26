<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Languages;

use function class_exists;
use function in_array;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid language code',
    '{{subject}} must not be a valid language code',
)]
final readonly class LanguageCode implements Rule
{
    private Languages $languages;

    /** @param "alpha-2"|"alpha-3" $set */
    public function __construct(
        private readonly string $set = 'alpha-2',
        Languages|null $languages = null,
    ) {
        if (!class_exists(Countries::class)) {
            throw new MissingComposerDependencyException(
                'LanguageCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }

        $availableSets = ['alpha-2', 'alpha-3'];
        if (!in_array($set, $availableSets, true)) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid set for ISO 639-3 (Available: %s)',
                $set,
                $availableSets,
            );
        }

        $this->languages = $languages ?? new Languages();
    }

    public function evaluate(mixed $input): Result
    {
        if (!is_string($input)) {
            return Result::failed($input, $this);
        }

        $currency = match ($this->set) {
            'alpha-2' => $this->languages->getByAlpha2($input),
            'alpha-3' => $this->languages->getByAlpha3($input),
        };

        return Result::of($currency !== null, $input, $this);
    }
}
