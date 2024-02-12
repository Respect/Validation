<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\WrapperStub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Wrapper::class)]
final class WrapperTest extends TestCase
{
    #[Test]
    public function shouldUseWrappedToEvaluate(): void
    {
        $wrapped = Stub::pass(2);

        $wrapper = new WrapperStub($wrapped);

        $input = 'Whatever';

        self::assertEquals($wrapped->evaluate($input), $wrapper->evaluate($input));
    }

    #[Test]
    public function shouldPassNameOnToWrapped(): void
    {
        $name = 'Whatever';

        $rule = Stub::pass(1);

        $sut = new WrapperStub($rule);
        $sut->setName($name);

        self::assertSame($name, $rule->getName());
        self::assertSame($name, $sut->getName());
    }

    #[Test]
    public function shouldPassTemplateOnToWrapped(): void
    {
        $template = 'Whatever';

        $rule = Stub::pass(1);

        $sut = new WrapperStub($rule);
        $sut->setTemplate($template);

        self::assertSame($template, $rule->getTemplate());
        self::assertSame($template, $sut->getTemplate());
    }
}
