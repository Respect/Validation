<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Subdivisions;

use function array_map;
use function class_exists;
use function str_replace;

#[Template(
    '{{name}} must be a subdivision code of {{countryName|trans}}',
    '{{name}} must not be a subdivision code of {{countryName|trans}}',
)]
final class SubdivisionCode extends AbstractSearcher
{
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

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['countryName' => $this->country->getName()];
    }

    /**
     * @return array<int, string>
     */
    protected function getDataSource(mixed $input = null): array
    {
        return array_map(
            fn (Subdivisions\Subdivision $subdivision): string => str_replace(
                $this->country->getAlpha2() . '-',
                '',
                $subdivision->getCode(),
            ),
            $this->subdivisions->getAllByCountryCode($this->country->getAlpha2()),
        );
    }
}
