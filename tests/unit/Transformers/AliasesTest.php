<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;

#[CoversClass(Aliases::class)]
final class AliasesTest extends TestCase
{
    #[Test]
    public function itShouldConvertOptionalIntoUndefOr(): void
    {
        $transformer = new Aliases(new StubTransformer());

        $ruleSpec = new RuleSpec('optional', [Stub::daze()]);

        $actual = $transformer->transform($ruleSpec);
        $expected = new RuleSpec('undefOr', $ruleSpec->arguments);

        self::assertEquals($expected, $actual);
    }
}
