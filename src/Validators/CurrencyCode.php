<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Justin Hook <justinhook88@yahoo.co.uk>
 * SPDX-FileContributor: Tim Strijdhorst
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Psr\Container\NotFoundExceptionInterface;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Sokil\IsoCodes\Database\Currencies;

use function in_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid currency code',
    '{{subject}} must not be a valid currency code',
)]
final readonly class CurrencyCode implements Validator
{
    private Currencies $currencies;

    /** @param "alpha-3"|"numeric" $set */
    public function __construct(
        private string $set = 'alpha-3',
        Currencies|null $currencies = null,
    ) {
        $availableSets = ['alpha-3', 'numeric'];
        if (!in_array($set, $availableSets, true)) {
            throw new InvalidValidatorException(
                '"%s" is not a valid set for ISO 4217 (Available: %s)',
                $set,
                $availableSets,
            );
        }

        try {
            $this->currencies = $currencies ?? ContainerRegistry::getContainer()->get(Currencies::class);
        } catch (NotFoundExceptionInterface) {
            throw new MissingComposerDependencyException(
                'CurrencyCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $currency = match ($this->set) {
            'alpha-3' => $this->currencies->getByLetterCode($input),
            'numeric' => $this->currencies->getByNumericCode($input),
        };

        return Result::of($currency !== null, $input, $this);
    }
}
