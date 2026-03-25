<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Fluent\Attributes\AssuranceAssertion;
use Respect\Fluent\Attributes\AssuranceParameter;
use Respect\Fluent\Attributes\FluentNamespace;
use Respect\Fluent\Builders\Append;
use Respect\Fluent\Factories\ComposingLookup;
use Respect\Fluent\Factories\NamespaceLookup;
use Respect\Fluent\FluentFactory;
use Respect\Fluent\Resolvers\ComposableMap;
use Respect\Fluent\Resolvers\Ucfirst;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Mixins\Builder;
use Respect\Validation\Mixins\PrefixConstants;
use Respect\Validation\Validators\AllOf;
use Respect\Validation\Validators\Core\Nameable;
use Respect\Validation\Validators\Core\ShortCircuitable;
use Respect\Validation\Validators\ShortCircuit;
use Throwable;

use function count;
use function current;
use function is_array;
use function is_callable;
use function is_string;

/** @mixin Builder */
#[FluentNamespace(new ComposingLookup(
    new NamespaceLookup(new Ucfirst(), Validator::class, 'Respect\\Validation\\Validators'),
    new ComposableMap(PrefixConstants::COMPOSABLE, PrefixConstants::COMPOSABLE_WITH_ARGUMENT),
))]
final readonly class ValidatorBuilder extends Append implements Nameable, ShortCircuitable
{
    /** @param array<string> $ignoredBacktracePaths */
    public function __construct(
        FluentFactory $factory,
        private Renderer $renderer,
        private StringFormatter $mainMessageFormatter,
        private StringFormatter $fullMessageFormatter,
        private ArrayFormatter $messagesFormatter,
        private ResultFilter $resultFilter,
        private array $ignoredBacktracePaths,
        Validator ...$validators,
    ) {
        parent::__construct($factory, ...$validators);
    }

    public static function init(Validator ...$validators): self
    {
        if ($validators === []) {
            return ContainerRegistry::getContainer()->get(self::class);
        }

        return ContainerRegistry::getContainer()->get(self::class)->attach(...$validators);
    }

    public function evaluate(mixed $input): Result
    {
        $validators = $this->getValidators();

        $validator = match (count($validators)) {
            0 => throw new ComponentException('No validators have been added.'),
            1 => current($validators),
            default => new AllOf(...$validators),
        };

        return $validator->evaluate($input);
    }

    public function evaluateShortCircuit(mixed $input): Result
    {
        $validators = $this->getValidators();

        return (new ShortCircuit(...$validators))->evaluate($input);
    }

    /** @param array<string|int, mixed>|string|null $template */
    public function validate(mixed $input, array|string|null $template = null): ResultQuery
    {
        return $this->toResultQuery($this->evaluate($input), $template);
    }

    #[AssuranceAssertion]
    public function isValid(
        #[AssuranceParameter]
        mixed $input,
    ): bool {
        return $this->evaluateShortCircuit($input)->hasPassed;
    }

    /** @param array<string|int, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    #[AssuranceAssertion]
    public function check(
        #[AssuranceParameter]
        mixed $input,
        array|string|Throwable|callable|null $template = null,
    ): void {
        $this->throwOnFailure($this->evaluateShortCircuit($input), $template);
    }

    /** @param array<string|int, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    #[AssuranceAssertion]
    public function assert(
        #[AssuranceParameter]
        mixed $input,
        array|string|Throwable|callable|null $template = null,
    ): void {
        $this->throwOnFailure($this->evaluate($input), $template);
    }

    /** @return array<Validator> */
    public function getValidators(): array
    {
        return $this->getNodes();
    }

    public function getName(): Name|null
    {
        $validators = $this->getNodes();

        if (count($validators) === 1 && current($validators) instanceof Nameable) {
            return current($validators)->getName();
        }

        return null;
    }

    /** @param array<string|int, mixed>|string|null $template */
    private function toResultQuery(Result $result, array|string|null $template): ResultQuery
    {
        return new ResultQuery(
            $this->resultFilter->filter(is_string($template) ? $result->withTemplate($template) : $result),
            $this->renderer,
            $this->mainMessageFormatter,
            $this->fullMessageFormatter,
            $this->messagesFormatter,
            is_array($template) ? $template : [],
        );
    }

    /** @param array<string|int, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    private function throwOnFailure(Result $result, array|callable|Throwable|string|null $template): void
    {
        if ($result->hasPassed) {
            return;
        }

        if ($template instanceof Throwable) {
            throw $template;
        }

        $resultQuery = $this->toResultQuery($result, is_callable($template) ? null : $template);

        $exception = new ValidationException($resultQuery->getMessage(), $resultQuery, ...$this->ignoredBacktracePaths);
        if (is_callable($template)) {
            throw $template($exception);
        }

        throw $exception;
    }

    /** @param array<int, mixed> $arguments */
    public static function __callStatic(string $ruleName, array $arguments): static
    {
        return self::init()->__call($ruleName, $arguments);
    }
}
