<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function array_pop;
use function count;
use function explode;
use function mb_substr_count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid domain',
    '{{subject}} must not be a valid domain',
)]
final class Domain implements Rule
{
    private readonly Rule $genericRule;

    private readonly Rule $tldRule;

    private readonly Rule $partsRule;

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
            new NoWhitespace(),
            new Contains('.'),
            new Length(new GreaterThanOrEqual(3)),
        );
    }

    private function createTldRule(bool $realTldCheck): Rule
    {
        if ($realTldCheck) {
            return new Tld();
        }

        return new Circuit(new Not(new StartsWith('-')), new Length(new GreaterThanOrEqual(2)));
    }

    private function createPartsRule(): Rule
    {
        return new Each(
            new Circuit(
                new Alnum('-'),
                new Not(new StartsWith('-')),
                new AnyOf(
                    new Not(new Contains('--')),
                    new Callback(static function ($str) {
                        return mb_substr_count($str, '--') == 1;
                    }),
                ),
                new Not(new EndsWith('-')),
            ),
        );
    }
}
