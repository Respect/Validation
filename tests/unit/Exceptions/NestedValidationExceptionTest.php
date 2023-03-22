<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(NestedValidationException::class)]
final class NestedValidationExceptionTest extends TestCase
{
    #[Test]
    public function getChildrenShouldReturnExceptionAddedByAddRelated(): void
    {
        $composite = new PropertyException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $node = new IntValException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }

    #[Test]
    public function addingTheSameInstanceShouldAddJustOneSingleReference(): void
    {
        $composite = new PropertyException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $node = new IntValException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $composite->addChild($node);
        $composite->addChild($node);
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }
}
