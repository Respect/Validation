<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Prefix::class)]
final class PrefixTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForTransformedValidatorSpec')]
    public function itShouldTransformValidatorSpec(ValidatorSpec $original, ValidatorSpec $expected): void
    {
        $transformer = new Prefix();
        $transformed = $transformer->transform($original);

        self::assertEquals($expected, $transformed);
    }

    #[Test]
    #[DataProvider('providerForUntransformedRuleNames')]
    public function itShouldPreventTransformingCanonicalRule(string $ruleName): void
    {
        $validatorSpec = new ValidatorSpec($ruleName);

        $transformer = new Prefix();
        self::assertSame($validatorSpec, $transformer->transform($validatorSpec));
    }

    /** @return array<array{ValidatorSpec, ValidatorSpec}> */
    public static function providerForTransformedValidatorSpec(): array
    {
        return [
            'key' => [
                new ValidatorSpec('keyNextRule', ['keyName', 123]),
                new ValidatorSpec('NextRule', [123], new ValidatorSpec('key', ['keyName'])),
            ],
            'length' => [
                new ValidatorSpec('lengthNextRule', [5]),
                new ValidatorSpec('NextRule', [5], new ValidatorSpec('length')),
            ],
            'max' => [
                new ValidatorSpec('maxNextRule', [1, 10]),
                new ValidatorSpec('NextRule', [1, 10], new ValidatorSpec('max')),
            ],
            'min' => [
                new ValidatorSpec('minNextRule', [1, 10]),
                new ValidatorSpec('NextRule', [1, 10], new ValidatorSpec('min')),
            ],
            'not' => [
                new ValidatorSpec('notNextRule', [1, 10]),
                new ValidatorSpec('NextRule', [1, 10], new ValidatorSpec('not')),
            ],
            'nullOr' => [
                new ValidatorSpec('nullOrNextRule', [1, 10]),
                new ValidatorSpec('NextRule', [1, 10], new ValidatorSpec('nullOr')),
            ],
            'property' => [
                new ValidatorSpec('propertyNextRule', ['propertyName', 567]),
                new ValidatorSpec('NextRule', [567], new ValidatorSpec('property', ['propertyName'])),
            ],
            'undefOr' => [
                new ValidatorSpec('undefOrNextRule', [1, 10]),
                new ValidatorSpec('NextRule', [1, 10], new ValidatorSpec('undefOr')),
            ],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForUntransformedRuleNames(): array
    {
        return [
            'equals' => ['equals'],
            'key' => ['key'],
            'keyExists' => ['keyExists'],
            'keyOptional' => ['keyOptional'],
            'keySet' => ['keySet'],
            'length' => ['length'],
            'max' => ['max'],
            'maxAge' => ['maxAge'],
            'min' => ['min'],
            'minAge' => ['minAge'],
            'not' => ['not'],
            'undef' => ['undef'],
            'property' => ['property'],
            'propertyExists' => ['propertyExists'],
            'propertyOptional' => ['propertyOptional'],
        ];
    }
}
