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
use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Subdivisions;

use function class_exists;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a subdivision code of {{countryName|trans}}',
    '{{subject}} must not be a subdivision code of {{countryName|trans}}',
)]
final readonly class SubdivisionCode implements Rule
{
    use CanValidateUndefined;

    private Countries\Country $country;

    private Subdivisions $subdivisions;

    public function __construct(
        string $countryCode,
        Countries|null $countries = null,
        Subdivisions|null $subdivisions = null,
    ) {
        if (!class_exists(Countries::class) || !class_exists(Subdivisions::class)) {
            throw new MissingComposerDependencyException(
                'SubdivisionCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }

        $countries ??= new Countries();
        $country = $countries->getByAlpha2($countryCode);
        if ($country === null) {
            throw new InvalidRuleConstructorException('"%s" is not a supported country code', $countryCode);
        }

        $this->country = $country;
        $this->subdivisions = $subdivisions ?? new Subdivisions();
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['countryName' => $this->country->getName()];
        $subdivision = $this->subdivisions->getByCode($this->country->getAlpha2() . '-' . $input);
        if ($this->isUndefined($input) && $subdivision === null) {
            return Result::passed($input, $this, $parameters);
        }

        return Result::of($subdivision !== null, $input, $this, $parameters);
    }
}
