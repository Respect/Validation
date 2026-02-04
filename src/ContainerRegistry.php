<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use DI\Container;
use libphonenumber\PhoneNumberUtil;
use Psr\Container\ContainerInterface;
use Respect\StringFormatter\BypassTranslator;
use Respect\StringFormatter\Modifier;
use Respect\StringFormatter\Modifiers\ListModifier;
use Respect\StringFormatter\Modifiers\QuoteModifier;
use Respect\StringFormatter\Modifiers\RawModifier;
use Respect\StringFormatter\Modifiers\StringifyModifier;
use Respect\StringFormatter\Modifiers\TransModifier;
use Respect\StringFormatter\PlaceholderFormatter;
use Respect\Stringifier\DumpStringifier;
use Respect\Stringifier\Handler;
use Respect\Stringifier\Handlers\CompositeHandler;
use Respect\Stringifier\HandlerStringifier;
use Respect\Stringifier\Quoter;
use Respect\Stringifier\Quoters\CodeQuoter;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Formatter\FirstResultStringFormatter;
use Respect\Validation\Message\Formatter\NestedArrayFormatter;
use Respect\Validation\Message\Formatter\NestedListStringFormatter;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\InterpolationRenderer;
use Respect\Validation\Message\Parameters\NameHandler;
use Respect\Validation\Message\Parameters\PathHandler;
use Respect\Validation\Message\Parameters\ResultHandler;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\TemplateRegistry;
use Respect\Validation\Transformers\Prefix;
use Respect\Validation\Transformers\Transformer;
use Symfony\Contracts\Translation\TranslatorInterface;

use function DI\autowire;
use function DI\create;
use function DI\factory;

final class ContainerRegistry
{
    private static ContainerInterface|null $container = null;

    /** @param array<string, mixed> $definitions */
    public static function createContainer(array $definitions = []): Container
    {
        return new Container($definitions + [
            PhoneNumberUtil::class => factory(static fn() => PhoneNumberUtil::getInstance()),
            Transformer::class => create(Prefix::class),
            TemplateRegistry::class => create(TemplateRegistry::class),
            TemplateResolver::class => autowire(TemplateResolver::class),
            TranslatorInterface::class => autowire(BypassTranslator::class),
            Renderer::class => autowire(InterpolationRenderer::class),
            ResultFilter::class => create(OnlyFailedChildrenResultFilter::class),
            'respect.validation.formatter.message' => autowire(FirstResultStringFormatter::class),
            'respect.validation.formatter.full_message' => autowire(NestedListStringFormatter::class),
            'respect.validation.formatter.messages' => autowire(NestedArrayFormatter::class),
            'respect.validation.ignored_backtrace_paths' => [__DIR__ . '/ValidatorBuilder.php'],
            'respect.validation.rule_factory.namespaces' => ['Respect\\Validation\\Validators'],
            ValidatorFactory::class => factory(static fn(Container $container) => new NamespacedValidatorFactory(
                $container->get(Transformer::class),
                $container->get('respect.validation.rule_factory.namespaces'),
            )),
            Quoter::class => create(CodeQuoter::class)->constructor(120),
            Handler::class => factory(static function (Container $container) {
                $handler = CompositeHandler::create();
                $handler->prependHandler(new PathHandler($container->get(Quoter::class)));
                $handler->prependHandler(new NameHandler());
                $handler->prependHandler(new ResultHandler($handler));

                return $handler;
            }),
            PlaceholderFormatter::class => factory(static fn(Container $container) => new PlaceholderFormatter(
                [],
                $container->get(Modifier::class),
            )),
            Stringifier::class => factory(static fn(Container $container) => new HandlerStringifier(
                $container->get(Handler::class),
                new DumpStringifier(),
            )),
            Modifier::class => factory(static fn(Container $container) => new TransModifier(
                new ListModifier(
                    new QuoteModifier(
                        new RawModifier(
                            new StringifyModifier($container->get(Stringifier::class)),
                        ),
                    ),
                    $container->get(TranslatorInterface::class),
                ),
                $container->get(TranslatorInterface::class),
            )),
            ValidatorBuilder::class => factory(static fn(Container $container) => new ValidatorBuilder(
                $container->get(ValidatorFactory::class),
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
