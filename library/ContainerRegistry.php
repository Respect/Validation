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
use Respect\Validation\Message\Modifier;
use Respect\Validation\Message\Modifier\ListAndModifier;
use Respect\Validation\Message\Modifier\ListOrModifier;
use Respect\Validation\Message\Modifier\QuoteModifier;
use Respect\Validation\Message\Modifier\RawModifier;
use Respect\Validation\Message\Modifier\StringifyModifier;
use Respect\Validation\Message\Modifier\TransModifier;
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
            'respect.validation.rule_factory.namespaces' => ['Respect\\Validation\\Rules'],
            RuleFactory::class => factory(static fn(Container $container) => new NamespacedRuleFactory(
                $container->get(Transformer::class),
                $container->get('respect.validation.rule_factory.namespaces'),
            )),
            Modifier::class => factory(static fn(Container $container) => new TransModifier(
                $container->get(Translator::class),
                new ListOrModifier(
                    $container->get(Translator::class),
                    new ListAndModifier(
                        $container->get(Translator::class),
                        new QuoteModifier(
                            new RawModifier(
                                new StringifyModifier($container->get(Stringifier::class)),
                            ),
                        ),
                    ),
                ),
            )),
            Validator::class => factory(static fn(Container $container) => new Validator(
                $container->get(RuleFactory::class),
                $container->get(Renderer::class),
                $container->get('respect.validation.formatter.message'),
                $container->get('respect.validation.formatter.full_message'),
                $container->get('respect.validation.formatter.messages'),
                $container->get(ResultFilter::class),
                $container->get('respect.validation.ignored_backtrace_paths'),
            )),
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
