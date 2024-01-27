<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Test\TestCase;

/**
 * @covers \Respect\Validation\Exceptions\NestedValidationException
 */
final class NestedValidationExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function getChildrenShouldReturnExceptionAddedByAddRelated(): void
    {
        $composite = new AttributeException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $node = new IntValException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }

    /**
     * @test
     */
    public function addingTheSameInstanceShouldAddJustOneSingleReference(): void
    {
        $composite = new AttributeException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $node = new IntValException('input', 'id', [], new Formatter('strval', new KeepOriginalStringName()));
        $composite->addChild($node);
        $composite->addChild($node);
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }
}
