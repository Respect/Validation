<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Respect\Validation\Exceptions\NestedValidationException
 */
class NestedValidationExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function getChildrenShouldReturnExceptionAddedByAddRelated(): void
    {
        $composite = new AttributeException('input', 'id', [], 'trim');
        $node = new IntValException('input', 'id', [], 'trim');
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren(true));
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }

    /**
     * @test
     */
    public function addingTheSameInstanceShouldAddJustASingleReference(): void
    {
        $composite = new AttributeException('input', 'id', [], 'trim');
        $node = new IntValException('input', 'id', [], 'trim');
        $composite->addChild($node);
        $composite->addChild($node);
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren(true));
        self::assertContainsOnly(IntValException::class, $composite->getChildren());
    }
}
