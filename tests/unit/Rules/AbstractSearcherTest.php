<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\DataProvider\UndefinedProvider;
use Respect\Validation\Test\Rules\SearcherStub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(AbstractSearcher::class)]
final class AbstractSearcherTest extends TestCase
{
    use UndefinedProvider;

    #[Test]
    public function shouldValidateFromDataSource(): void
    {
        $input = 'BAZ';

        $rule = new SearcherStub(static fn() => ['FOO', $input, 'BAZ']);

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    public function shouldNotFindWhenNotIdentical(): void
    {
        $input = 2.0;

        $rule = new SearcherStub(static fn() => [1, (int) $input, 3]);

        self::assertFalse($rule->validate($input));
    }

    #[Test]
    #[DataProvider('providerForUndefined')]
    public function shouldValidateWhenValueIsUndefinedAndDataSourceIsEmpty(mixed $input): void
    {
        $rule = new SearcherStub(static fn() => []);

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    #[DataProvider('providerForNotUndefined')]
    public function shouldNotValidateWhenValueIsNotUndefinedAndDataSourceNotEmpty(mixed $input): void
    {
        $rule = new SearcherStub(static fn() => []);

        self::assertFalse($rule->validate($input));
    }
}
