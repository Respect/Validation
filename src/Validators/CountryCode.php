<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Felipe Martins <me@fefas.net>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jose H. Milan <jhmilan@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
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
            throw new InvalidValidatorException(
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
