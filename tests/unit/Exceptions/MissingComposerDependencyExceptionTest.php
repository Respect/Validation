<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[CoversClass(MissingComposerDependencyException::class)]
final class MissingComposerDependencyExceptionTest extends TestCase
{
    #[Test]
    public function itShouldCreateMessageForMultipleDependencies(): void
    {
        $exception = new MissingComposerDependencyException('message', 'dependency1', 'dependency2');

        $expected = 'message. Run `composer require dependency1 dependency2` to fix this issue.';

        self::assertEquals($expected, $exception->getMessage());
    }
}
