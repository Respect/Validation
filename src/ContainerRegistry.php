<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use libphonenumber\PhoneNumberUtil;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\UuidFactory;
use Respect\Config\Container;
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
use Respect\Validation\Transformers\Prefix;
use Respect\Validation\Transformers\Transformer;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\Subdivisions;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContainerRegistry
{
    private static ContainerInterface|null $c = null;

    /** @param array<string, mixed> $definitions */
    public static function createContainer(array $definitions = []): Container
    {
        $c = new Container();

        $definitions += [
            // By key
            'respect.validation.formatter.full_message' => static fn() => new NestedListStringFormatter(),
            'respect.validation.formatter.message' => static fn() => new FirstResultStringFormatter(),
            'respect.validation.formatter.messages' => static fn() => new NestedArrayFormatter(),
            'respect.validation.ignored_backtrace_paths' => [__DIR__ . '/ValidatorBuilder.php'],
            'respect.validation.rule_factory.namespaces' => ['Respect\\Validation\\Validators'],

            // By interface
            Quoter::class => static fn() => new CodeQuoter(120),
            Transformer::class => static fn() => new Prefix(),
            TranslatorInterface::class => static fn() => new BypassTranslator(),
            Renderer::class => static fn() => new InterpolationRenderer(
                $c->get(TranslatorInterface::class),
                $c->get(PlaceholderFormatter::class),
                $c->get(TemplateResolver::class),
            ),
            Modifier::class => static fn() => new TransModifier(
                new ListModifier(
                    new QuoteModifier(new RawModifier(new StringifyModifier($c->get(Stringifier::class)))),
                    $c->get(TranslatorInterface::class),
                ),
                $c->get(TranslatorInterface::class),
            ),
            ResultFilter::class => static fn() => new OnlyFailedChildrenResultFilter(),
            Handler::class => static function () use ($c) {
                $handler = CompositeHandler::create();
                $handler->prependHandler(new PathHandler($c->get(Quoter::class)));
                $handler->prependHandler(new NameHandler());
                $handler->prependHandler(new ResultHandler($handler));

                return $handler;
            },
            Stringifier::class => static fn() => new HandlerStringifier($c->get(Handler::class), new DumpStringifier()),

            // By class
            Countries::class => static fn() => new Countries(),
            Currencies::class => static fn() => new Currencies(),
            Languages::class => static fn() => new Languages(),
            PhoneNumberUtil::class => static fn() => PhoneNumberUtil::getInstance(),
            PlaceholderFormatter::class => static fn() => new PlaceholderFormatter([], $c->get(Modifier::class)),
            Subdivisions::class => static fn() => new Subdivisions(),
            TemplateResolver::class => static fn() => new TemplateResolver(),
            UuidFactory::class => static fn() => new UuidFactory(),
            ValidatorBuilder::class => static fn() => new ValidatorBuilder(
                $c->get(ValidatorFactory::class),
                $c->get(Renderer::class),
                $c->get('respect.validation.formatter.message'),
                $c->get('respect.validation.formatter.full_message'),
                $c->get('respect.validation.formatter.messages'),
                $c->get(ResultFilter::class),
                $c->get('respect.validation.ignored_backtrace_paths'),
            ),
            ValidatorFactory::class => static fn() => new NamespacedValidatorFactory(
                $c->get(Transformer::class),
                $c->get('respect.validation.rule_factory.namespaces'),
            ),
        ];

        foreach ($definitions as $key => $value) {
            $c->$key = $value;
        }

        return $c;
    }

    public static function getContainer(): ContainerInterface
    {
        if (!isset(self::$c)) {
            self::$c = self::createContainer();
        }

        return self::$c;
    }

    public static function setContainer(ContainerInterface $instance): void
    {
        self::$c = $instance;
    }

    public static function resetContainer(): void
    {
        self::$c = null;
    }
}
