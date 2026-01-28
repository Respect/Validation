<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Emmerson <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: The Respect Panda <therespectpanda@gmail.com>
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
use Sokil\IsoCodes\Database\Languages;

use function in_array;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid language code',
    '{{subject}} must not be a valid language code',
)]
final readonly class LanguageCode implements Validator
{
    private Languages $languages;

    /** @param "alpha-2"|"alpha-3" $set */
    public function __construct(
        private readonly string $set = 'alpha-2',
        Languages|null $languages = null,
    ) {
        $availableSets = ['alpha-2', 'alpha-3'];
        if (!in_array($set, $availableSets, true)) {
            throw new InvalidValidatorException(
                '"%s" is not a valid set for ISO 639-3 (Available: %s)',
                $set,
                $availableSets,
            );
        }

        try {
            $this->languages = $languages ?? ContainerRegistry::getContainer()->get(Languages::class);
        } catch (NotFoundExceptionInterface) {
            throw new MissingComposerDependencyException(
                'LanguageCode rule requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }
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
