<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Subdivisions;

use function class_exists;

#[Template(
    '{{name}} must be a subdivision code of {{countryName|trans}}',
    '{{name}} must not be a subdivision code of {{countryName|trans}}',
)]
final class SubdivisionCode extends Standard
{
    use CanValidateUndefined;

    private readonly Countries\Country $country;

    private readonly Subdivisions $subdivisions;

    public function __construct(string $countryCode, ?Countries $countries = null, ?Subdivisions $subdivisions = null)
    {
        if (!class_exists(Countries::class) || !class_exists(Subdivisions::class)) {
            throw new MissingComposerDependencyException(
                'SubdivisionCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only'
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

        return new Result($subdivision !== null, $input, $this, $parameters);
    }
}
