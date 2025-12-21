<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Rules\Core\Nameable;

use function array_filter;
use function array_map;
use function count;
use function preg_match;

final readonly class Result
{
    /** @var array<Result> */
    public array $children;

    public Id $id;

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public bool $hasPassed,
        public mixed $input,
        public Rule $rule,
        public array $parameters = [],
        public string $template = Rule::TEMPLATE_STANDARD,
        public bool $hasInvertedMode = false,
        public Name|null $name = null,
        Id|null $id = null,
        public Result|null $adjacent = null,
        public Path|null $path = null,
        Result ...$children,
    ) {
        $this->id = $id ?? Id::fromRule($rule);
        $this->children = $children;
    }

    /** @param array<string, mixed> $parameters */
    public static function failed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): self {
        return new self(false, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function passed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): self {
        return new self(true, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function fromAdjacent(
        mixed $input,
        string $prefix,
        Rule $rule,
        Result $adjacent,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): Result {
        if ($adjacent->allowsAdjacent()) {
            return (new Result(
                $adjacent->hasPassed,
                $input,
                $rule,
                $parameters,
                $template,
                id: $adjacent->id->withPrefix($prefix),
            ))->withAdjacent($adjacent->withInput($input));
        }

        $childrenAsAdjacent = array_map(
            static fn(Result $child) => self::fromAdjacent($input, $prefix, $rule, $child, $parameters, $template),
            $adjacent->children,
        );

        return $adjacent->withInput($input)->withChildren(...$childrenAsAdjacent);
    }

    public function withTemplate(string $template): self
    {
        return clone($this, ['template' => $template]);
    }

    /** @param array<string, mixed> $parameters */
    public function withExtraParameters(array $parameters): self
    {
        // phpcs:ignore SlevomatCodingStandard.PHP.UselessParentheses
        return clone($this, ['parameters' => $parameters + $this->parameters]);
    }

    public function withId(Id $id): self
    {
        return clone($this, ['id' => $id]);
    }

    public function withIdFrom(Rule $rule): self
    {
        return clone($this, ['id' => Id::fromRule($rule)]);
    }

    public function withPath(Path $path): self
    {
        if ($this->path === $path) {
            return $this;
        }

        if ($this->path !== null) {
            $this->path->withParent($path);

            return $this;
        }

        return clone($this, [
            'path' => $path,
            'adjacent' => $this->adjacent?->withPath($path),
            'children' => array_map(
                static fn(Result $child) => $child->withPath($path),
                $this->children,
            ),
        ]);
    }

    public function withoutParentPath(): self
    {
        if ($this->path === null || $this->path->isOrphan()) {
            return $this;
        }

        return clone ($this, [
            'path' => new Path($this->path->value),
            'adjacent' => $this->adjacent?->withoutParentPath(),
            'children' => array_map(
                fn(Result $child) => $child->path === $this->path ? $child->withoutParentPath() : $child,
                $this->children,
            ),
        ]);
    }

    public function withoutName(): self
    {
        if ($this->name === null) {
            return $this;
        }

        return clone ($this, [
            'name' => null,
            'adjacent' => $this->adjacent?->withoutName(),
            'children' => array_map(
                fn(Result $child) => $child->name === $this->name ? $child->withoutName() : $child,
                $this->children,
            ),
        ]);
    }

    public function withChildren(Result ...$children): self
    {
        if ($this->path === null) {
            return clone($this, ['children' => $children]);
        }

        return clone($this, ['children' => array_map(fn(Result $child) => $child->withPath($this->path), $children)]);
    }

    public function withName(Name $name): self
    {
        return clone($this, [
            'name' => $this->name ?? $name,
            'adjacent' => $this->adjacent?->withName($name),
            'children' => array_map(
                static fn(Result $child) => $child->withName($child->name ?? $name),
                $this->children,
            ),
        ]);
    }

    public function withNameFrom(Rule $rule): self
    {
        if ($rule instanceof Nameable && $rule->getName() !== null) {
            return $this->withName($rule->getName());
        }

        return $this;
    }

    public function withInput(mixed $input): self
    {
        $currentInput = $this->input;

        return clone($this, [
            'input' => $input,
            'children' => array_map(
                static fn(Result $child) => $child->input === $currentInput ? $child->withInput($input) : $child,
                $this->children,
            ),
        ]);
    }

    public function withAdjacent(Result $adjacent): self
    {
        return clone($this, ['adjacent' => $adjacent]);
    }

    public function withToggledValidation(): self
    {
        return clone($this, [
            'hasPassed' => !$this->hasPassed,
            'adjacent' => $this->adjacent?->withToggledValidation(),
            'children' => array_map(static fn(Result $child) => $child->withToggledValidation(), $this->children),
        ]);
    }

    public function withToggledModeAndValidation(): self
    {
        return clone($this, [
            'hasPassed' => !$this->hasPassed,
            'hasInvertedMode' => !$this->hasInvertedMode,
            'adjacent' => $this->adjacent?->withToggledModeAndValidation(),
            'children' => array_map(
                static fn(Result $child) => $child->withToggledModeAndValidation(),
                $this->children,
            ),
        ]);
    }

    public function hasCustomTemplate(): bool
    {
        return preg_match('/__[0-9a-z_]+_/', $this->template) === 0;
    }

    public function allowsAdjacent(): bool
    {
        if ($this->children === [] && !$this->hasCustomTemplate()) {
            return true;
        }

        $childrenThatAllowAdjacent = array_filter(
            $this->children,
            static fn(Result $child) => $child->allowsAdjacent(),
        );

        return count($childrenThatAllowAdjacent) === 1;
    }
}
