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
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Message\TemplateRenderer;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

#[Group('core')]
#[CoversClass(NestedValidationException::class)]
final class NestedValidationExceptionTest extends TestCase
{
    #[Test]
    public function getChildrenShouldReturnExceptionAddedByAddRelated(): void
    {
        $composite = $this->createNestedValidationException();
        $node = $this->createValidationException();
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(ValidationException::class, $composite->getChildren());
    }

    #[Test]
    public function addingTheSameInstanceShouldAddJustOneSingleReference(): void
    {
        $composite = $this->createNestedValidationException();
        $node = $this->createValidationException();
        $composite->addChild($node);
        $composite->addChild($node);
        $composite->addChild($node);
        self::assertCount(1, $composite->getChildren());
        self::assertContainsOnly(ValidationException::class, $composite->getChildren());
    }

    public function createNestedValidationException(): NestedValidationException
    {
        return new NestedValidationException(
            input: 'input',
            id: 'id',
            params: [],
            template: Validatable::TEMPLATE_STANDARD,
            templates: [],
            formatter: new TemplateRenderer('strval', new KeepOriginalStringName())
        );
    }

    public function createValidationException(): ValidationException
    {
        return new ValidationException(
            input: 'input',
            id: 'id',
            params: [],
            template: Validatable::TEMPLATE_STANDARD,
            templates: [],
            formatter: new TemplateRenderer('strval', new KeepOriginalStringName())
        );
    }
}
