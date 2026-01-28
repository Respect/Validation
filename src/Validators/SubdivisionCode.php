<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Psr\Container\NotFoundExceptionInterface;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Subdivisions;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a subdivision code of {{countryName|trans}}',
    '{{subject}} must not be a subdivision code of {{countryName|trans}}',
)]
final readonly class SubdivisionCode implements Validator
{
    use CanValidateUndefined;

    private Countries\Country $country;

    private Subdivisions $subdivisions;

    public function __construct(
        string $countryCode,
        Countries|null $countries = null,
        Subdivisions|null $subdivisions = null,
    ) {
        try {
            $container = ContainerRegistry::getContainer();
            $countries ??= $container->get(Countries::class);
            $this->subdivisions = $subdivisions ?? $container->get(Subdivisions::class);
        } catch (NotFoundExceptionInterface) {
            throw new MissingComposerDependencyException(
                'SubdivisionCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }

        $country = $countries->getByAlpha2($countryCode);
        if ($country === null) {
            throw new InvalidValidatorException('"%s" is not a supported country code', $countryCode);
        }

        $this->country = $country;
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
