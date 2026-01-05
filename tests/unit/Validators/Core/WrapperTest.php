<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteWrapper;
use Respect\Validation\Test\Validators\Stub;

#[Group('core')]
#[CoversClass(Wrapper::class)]
final class WrapperTest extends TestCase
{
    #[Test]
    public function shouldUseWrappedToEvaluate(): void
    {
        $wrapped = Stub::pass(2);

        $wrapper = new ConcreteWrapper($wrapped);

        $input = 'Whatever';

        self::assertEquals($wrapped->evaluate($input), $wrapper->evaluate($input));
    }
}
