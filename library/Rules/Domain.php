<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;

use function array_pop;
use function count;
use function explode;
use function mb_substr_count;

#[Template(
    '{{name}} must be a valid domain',
    '{{name}} must not be a valid domain',
)]
final class Domain extends Standard
{
    private readonly Validatable $genericRule;

    private readonly Validatable $tldRule;

    private readonly Validatable $partsRule;

    public function __construct(bool $tldCheck = true)
    {
        $this->genericRule = $this->createGenericRule();
        $this->tldRule = $this->createTldRule($tldCheck);
        $this->partsRule = $this->createPartsRule();
    }

    public function evaluate(mixed $input): Result
    {
        $genericResult = $this->genericRule->evaluate($input);
        if (!$genericResult->isValid) {
            return Result::failed($input, $this);
        }

        $parts = explode('.', (string) $input);
        if (count($parts) >= 2) {
            $childResult = $this->tldRule->evaluate(array_pop($parts));
            if (!$childResult->isValid) {
                return Result::failed($input, $this);
            }
        }

        return new Result($this->partsRule->evaluate($parts)->isValid, $input, $this);
    }

    private function createGenericRule(): Consecutive
    {
        return new Consecutive(new StringType(), new NoWhitespace(), new Contains('.'), new Length(3));
    }

    private function createTldRule(bool $realTldCheck): Validatable
    {
        if ($realTldCheck) {
            return new Tld();
        }

        return new Consecutive(new Not(new StartsWith('-')), new Length(2));
    }

    private function createPartsRule(): Validatable
    {
        return new Each(
            new Consecutive(
                new Alnum('-'),
                new Not(new StartsWith('-')),
                new AnyOf(
                    new Not(new Contains('--')),
                    new Callback(static function ($str) {
                        return mb_substr_count($str, '--') == 1;
                    })
                ),
                new Not(new EndsWith('-'))
            )
        );
    }
}
