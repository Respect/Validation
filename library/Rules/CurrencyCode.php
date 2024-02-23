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
use Respect\Validation\Result;
use Sokil\IsoCodes\Database\Currencies;

use function class_exists;
use function in_array;

#[Template(
    '{{name}} must be a valid currency',
    '{{name}} must not be a valid currency',
)]
final class CurrencyCode extends Standard
{
    private readonly Currencies $currencies;

    /** @param "alpha-3"|"numeric" $set */
    public function __construct(
        private readonly string $set = 'alpha-3',
        ?Currencies $currencies = null
    ) {
        if (!class_exists(Currencies::class)) {
            throw new MissingComposerDependencyException(
                'CurrencyCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only'
            );
        }

        $availableSets = ['alpha-3', 'numeric'];
        if (!in_array($set, $availableSets, true)) {
            throw new InvalidRuleConstructorException(
                '%s is not a valid set for ISO 4217 (Available: %s)',
                $set,
                $availableSets
            );
        }
        $this->currencies = $currencies ?? new Currencies();
    }

    public function evaluate(mixed $input): Result
    {
        $currency = match ($this->set) {
            'alpha-3' => $this->currencies->getByLetterCode($input),
            'numeric' => $this->currencies->getByNumericCode($input),
        };

        return new Result($currency !== null, $input, $this);
    }
}
