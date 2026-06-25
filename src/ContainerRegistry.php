<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use libphonenumber\PhoneNumberUtil;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\UuidFactory;
use Respect\Config\Autowire;
use Respect\Config\Container;
use Respect\Config\Instantiator;
use Respect\Fluent\Factories\NamespaceLookup;
use Respect\Fluent\Resolvers\ComposableMap;
use Respect\Fluent\Resolvers\Ucfirst;
use Respect\Parameter\ContainerResolver;
use Respect\Parameter\Resolver;
use Respect\StringFormatter\BypassTranslator;
use Respect\StringFormatter\Modifier;
use Respect\StringFormatter\Modifiers\FormatterModifier;
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
use Respect\Validation\Mixins\PrefixConstants;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\Subdivisions;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContainerRegistry
{
    private static ContainerInterface|null $container = null;

    /** @param array<string, mixed> $definitions */
    public static function createContainer(array $definitions = []): Container
    {
        return new Container($definitions + [
            Countries::class => new Instantiator(Countries::class),
            Currencies::class => new Instantiator(Currencies::class),
            Languages::class => new Instantiator(Languages::class),
            Subdivisions::class => new Instantiator(Subdivisions::class),
            UuidFactory::class => new Instantiator(UuidFactory::class),
            PhoneNumberUtil::class => static fn() => PhoneNumberUtil::getInstance(),
            TemplateRegistry::class => new Instantiator(TemplateRegistry::class),
            TemplateResolver::class => new Autowire(TemplateResolver::class),
            TranslatorInterface::class => new Autowire(BypassTranslator::class),
            Renderer::class => new Autowire(InterpolationRenderer::class),
            ResultFilter::class => new Instantiator(OnlyFailedChildrenResultFilter::class),
            'respect.validation.formatter.message' => new Autowire(FirstResultStringFormatter::class),
            'respect.validation.formatter.full_message' => new Autowire(NestedListStringFormatter::class),
            'respect.validation.formatter.messages' => new Autowire(NestedArrayFormatter::class),
            'respect.validation.ignored_backtrace_paths' => [__DIR__ . '/ValidatorBuilder.php'],
            'respect.validation.rule_factory.namespaces' => ['Respect\\Validation\\Validators'],
            Resolver::class => static fn(Container $container) => new ContainerResolver($container),
            ValidatorFactory::class => static function (Container $container) {
                $lookup = new NamespaceLookup(
                    new Ucfirst(),
                    Validator::class,
                    ...$container->get('respect.validation.rule_factory.namespaces'),
                );

                return new FluentValidatorFactory(
                    new AutowiringLookup(
                        $lookup,
                        new ComposableMap(PrefixConstants::COMPOSABLE, PrefixConstants::COMPOSABLE_WITH_ARGUMENT),
                        $container->get(Resolver::class),
                    ),
                );
            },
            Quoter::class => new Instantiator(CodeQuoter::class, ['maximumLength' => 120]),
            Handler::class => static function (Container $container) {
                $handler = CompositeHandler::create();
                $handler->prependHandler(new PathHandler($container->get(Quoter::class)));
                $handler->prependHandler(new NameHandler());
                $handler->prependHandler(new ResultHandler($handler));

                return $handler;
            },
            PlaceholderFormatter::class => static fn(Container $container) => new PlaceholderFormatter(
                [],
                $container->get(Modifier::class),
            ),
            Stringifier::class => static fn(Container $container) => new HandlerStringifier(
                $container->get(Handler::class),
                new DumpStringifier(),
            ),
            Modifier::class => static fn(Container $container) => new TransModifier(
                new ListModifier(
                    new QuoteModifier(
                        new RawModifier(
                            new FormatterModifier(new StringifyModifier($container->get(Stringifier::class))),
                        ),
                    ),
                    $container->get(TranslatorInterface::class),
                ),
                $container->get(TranslatorInterface::class),
            ),
            ValidatorBuilder::class => static fn(Container $container) => new ValidatorBuilder(
                $container->get(ValidatorFactory::class),
                $container->get(Renderer::class),
                $container->get('respect.validation.formatter.message'),
                $container->get('respect.validation.formatter.full_message'),
                $container->get('respect.validation.formatter.messages'),
                $container->get(ResultFilter::class),
                $container->get('respect.validation.ignored_backtrace_paths'),
            ),
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
