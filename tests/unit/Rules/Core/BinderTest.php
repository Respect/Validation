<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Rule;
use Respect\Validation\Rules\AlwaysInvalid;

use function uniqid;

#[CoversClass(Binder::class)]
final class BinderTest extends TestCase
{
    #[Test]
    public function shouldBindNameToBoundRule(): void
    {
        $sourceName = 'source name';

        $source = new AlwaysInvalid();
        $source->setName($sourceName);

        $bound = new AlwaysInvalid();
        $binder = new Binder($source, $bound);
        $result = $binder->evaluate(null);

        self::assertSame($sourceName, $bound->getName());
        self::assertSame($sourceName, $result->name);
    }

    #[Test]
    public function shouldNotBindNameToBoundRuleWhenItAlreadyHasSomeName(): void
    {
        $source = new AlwaysInvalid();
        $source->setName('source name');

        $boundName = 'bound name';

        $bound = new AlwaysInvalid();
        $bound->setName($boundName);

        $binder = new Binder($source, $bound);
        $result = $binder->evaluate(null);

        self::assertSame($boundName, $bound->getName());
        self::assertSame($boundName, $result->name);
    }

    #[Test]
    public function shouldNotBindNameToBoundRuleWhenSourceHasNoName(): void
    {
        $bound = new AlwaysInvalid();

        $binder = new Binder(new AlwaysInvalid(), $bound);
        $result = $binder->evaluate(null);

        self::assertNull($bound->getName());
        self::assertNull($result->name);
    }

    #[Test]
    public function shouldBindTemplateToBoundRule(): void
    {
        $sourceTemplate = uniqid();

        $source = new AlwaysInvalid();
        $source->setTemplate($sourceTemplate);

        $bound = new AlwaysInvalid();
        $binder = new Binder($source, $bound);
        $result = $binder->evaluate(null);

        self::assertSame($sourceTemplate, $bound->getTemplate());
        self::assertSame($sourceTemplate, $result->template);
    }

    #[Test]
    public function shouldNotBindTemplateToBoundRuleWhenItAlreadyHasSomeTemplate(): void
    {
        $source = new AlwaysInvalid();
        $source->setTemplate('source template');

        $boundTemplate = 'bound name';

        $bound = new AlwaysInvalid();
        $bound->setTemplate($boundTemplate);

        $binder = new Binder($source, $bound);
        $result = $binder->evaluate(null);

        self::assertSame($boundTemplate, $bound->getTemplate());
        self::assertSame($boundTemplate, $result->template);
    }

    #[Test]
    public function shouldNotBindTemplateToBoundRuleWhenSourceHasNoTemplate(): void
    {
        $bound = new AlwaysInvalid();

        $binder = new Binder(new AlwaysInvalid(), $bound);
        $result = $binder->evaluate(null);

        self::assertNull($bound->getTemplate());
        self::assertSame(Rule::TEMPLATE_STANDARD, $result->template);
    }
}
