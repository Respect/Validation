<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use DI\Container;
use Psr\Container\ContainerInterface;
use Respect\Stringifier\Quoter;
use Respect\Stringifier\Quoters\StandardQuoter;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Formatter\FirstResultStringFormatter;
use Respect\Validation\Message\Formatter\NestedArrayFormatter;
use Respect\Validation\Message\Formatter\NestedListStringFormatter;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\InterpolationRenderer;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Message\ValidationStringifier;
use Respect\Validation\Transformers\Prefix;
use Respect\Validation\Transformers\Transformer;

use function DI\autowire;
use function DI\create;
use function DI\factory;

final class ContainerRegistry
{
    private static ContainerInterface|null $container = null;

    public static function createContainer(): Container
    {
        return new Container([
            Transformer::class => create(Prefix::class),
            Factory::class => autowire(Factory::class),
            TemplateResolver::class => create(TemplateResolver::class),
            Quoter::class => create(StandardQuoter::class)->constructor(ValidationStringifier::MAXIMUM_LENGTH),
            Stringifier::class => create(ValidationStringifier::class),
            Translator::class => autowire(DummyTranslator::class),
            Renderer::class => autowire(InterpolationRenderer::class),
            ResultFilter::class => create(OnlyFailedChildrenResultFilter::class),
            'respect.validation.formatter.message' => autowire(FirstResultStringFormatter::class),
            'respect.validation.formatter.full_message' => autowire(NestedListStringFormatter::class),
            'respect.validation.formatter.messages' => autowire(NestedArrayFormatter::class),
            'respect.validation.ignored_backtrace_paths' => [__DIR__ . '/Validator.php'],
            Validator::class => factory(static fn(Container $container) => new Validator(
                $container->get(Factory::class),
                $container->get('respect.validation.formatter.message'),
                $container->get('respect.validation.formatter.full_message'),
                $container->get('respect.validation.formatter.messages'),
                $container->get(Translator::class),
                $container->get(ResultFilter::class),
                $container->get('respect.validation.ignored_backtrace_paths'),
            )),
            ValidatorFactory::class => autowire(CloneValidatorFactory::class),
        ]);
    }

    public static function getContainer(): ContainerInterface
    {
        if (!isset(self::$container)) {
            self::$container = self::createContainer();
        }

        return self::$container;
    }

    public static function setContainer(ContainerInterface $instance): void
    {
        self::$container = $instance;
    }
}
