<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Mehmet Tolga Avcioglu <mehmet@activecom.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Róbert Nagy <vrnagy@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_pop;
use function count;
use function explode;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an internet domain',
    '{{subject}} must not be an internet domain',
)]
final class Domain implements Validator
{
    private readonly Validator $genericRule;

    private readonly Validator $tldRule;

    private readonly Validator $partsRule;

    public function __construct(bool $tldCheck = true)
    {
        $this->genericRule = $this->createGenericRule();
        $this->tldRule = $this->createTldRule($tldCheck);
        $this->partsRule = $this->createPartsRule();
    }

    public function evaluate(mixed $input): Result
    {
        $genericResult = $this->genericRule->evaluate($input);
        if (!$genericResult->hasPassed) {
            return Result::failed($input, $this);
        }

        $parts = explode('.', (string) $input);
        if (count($parts) >= 2) {
            $childResult = $this->tldRule->evaluate(array_pop($parts));
            if (!$childResult->hasPassed) {
                return Result::failed($input, $this);
            }
        }

        return Result::of($this->partsRule->evaluate($parts)->hasPassed, $input, $this);
    }

    private function createGenericRule(): Circuit
    {
        return new Circuit(
            new StringType(),
            new Not(new Spaced()),
            new Contains('.'),
            new Length(new GreaterThanOrEqual(3)),
        );
    }

    private function createTldRule(bool $realTldCheck): Validator
    {
        if ($realTldCheck) {
            return new Tld();
        }

        return new Circuit(new Not(new StartsWith('-')), new Length(new GreaterThanOrEqual(2)));
    }

    private function createPartsRule(): Validator
    {
        return new Each(
            new Circuit(
                new Alnum('-'),
                new Not(new StartsWith('-')),
                new AnyOf(
                    new Not(new Contains('--')),
                    new ContainsCount('--', 1),
                ),
                new Not(new EndsWith('-')),
            ),
        );
    }
}
