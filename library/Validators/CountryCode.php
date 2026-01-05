<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Sokil\IsoCodes\Database\Countries;

use function class_exists;
use function in_array;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid country code',
    '{{subject}} must not be a valid country code',
)]
final readonly class CountryCode implements Validator
{
    private Countries $countries;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function __construct(
        private string $set = 'alpha-2',
        Countries|null $countries = null,
    ) {
        if (!class_exists(Countries::class)) {
            throw new MissingComposerDependencyException(
                'SubdivisionCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }

        $availableOptions = ['alpha-2', 'alpha-3', 'numeric'];
        if (!in_array($set, $availableOptions, true)) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid set for ISO 3166-1 (Available: %s)',
                $set,
                $availableOptions,
            );
        }

        $this->countries = $countries ?? new Countries();
    }

    public function evaluate(mixed $input): Result
    {
        if (!is_string($input)) {
            return Result::failed($input, $this);
        }

        $country = match ($this->set) {
            'alpha-2' => $this->countries->getByAlpha2($input),
            'alpha-3' => $this->countries->getByAlpha3($input),
            'numeric' => $this->countries->getByNumericCode($input),
        };
        if ($country !== null) {
            return Result::passed($input, $this);
        }

        return Result::failed($input, $this);
    }
}
