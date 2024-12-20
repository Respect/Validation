<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use function array_filter;
use function array_map;
use function count;
use function lcfirst;
use function preg_match;
use function strrchr;
use function substr;
use function ucfirst;

final class Result
{
    /** @var array<Result> */
    public readonly array $children;

    public readonly string $id;

    public readonly ?string $name;

    public readonly string $template;

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public readonly bool $isValid,
        public readonly mixed $input,
        public readonly Rule $rule,
        public readonly array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
        public readonly Mode $mode = Mode::DEFAULT,
        ?string $name = null,
        ?string $id = null,
        public readonly ?Result $adjacent = null,
        public readonly bool $unchangeableId = false,
        Result ...$children,
    ) {
        $this->name = $rule->getName() ?? $name;
        $this->template = $rule->getTemplate() ?? $template;
        $this->id = $id ?? lcfirst(substr((string) strrchr($rule::class, '\\'), 1));
        $this->children = $children;
    }

    /** @param array<string, mixed> $parameters */
    public static function failed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD
    ): self {
        return new self(false, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function passed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD
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
        string $template = Rule::TEMPLATE_STANDARD
    ): Result {
        if ($adjacent->allowsAdjacent()) {
            return (new Result($adjacent->isValid, $input, $rule, $parameters, $template, id: $adjacent->id))
                ->withPrefixedId($prefix)
                ->withAdjacent($adjacent->withInput($input));
        }

        $childrenAsAdjacent = array_map(
            static fn(Result $child) => self::fromAdjacent($input, $prefix, $rule, $child, $parameters, $template),
            $adjacent->children
        );

        return $adjacent->withInput($input)->withChildren(...$childrenAsAdjacent);
    }

    public function withTemplate(string $template): self
    {
        return $this->clone(template: $template);
    }

    public function withId(string $id): self
    {
        if ($this->unchangeableId) {
            return $this;
        }

        return $this->clone(id: $id);
    }

    public function withUnchangeableId(string $id): self
    {
        return $this->clone(id: $id, unchangeableId: true);
    }

    public function withPrefixedId(string $prefix): self
    {
        if ($this->id === $this->name || $this->unchangeableId) {
            return $this;
        }

        return $this->clone(id: $prefix . ucfirst($this->id));
    }

    public function withChildren(Result ...$children): self
    {
        return $this->clone(children: $children);
    }

    public function withNameIfMissing(string $name): self
    {
        return $this->clone(
            name: $this->name ?? $name,
            children: array_map(static fn (Result $child) => $child->withNameIfMissing($name), $this->children),
        );
    }

    public function withInput(mixed $input): self
    {
        $currentInput = $this->input;

        return $this->clone(
            input: $input,
            children: array_map(
                static fn (Result $child) => $child->input === $currentInput ? $child->withInput($input) : $child,
                $this->children
            ),
        );
    }

    public function withAdjacent(Result $adjacent): self
    {
        return $this->clone(adjacent: $adjacent);
    }

    public function withInvertedValidation(): self
    {
        return $this->clone(
            isValid: !$this->isValid,
            adjacent: $this->adjacent?->withInvertedValidation(),
            children: array_map(static fn (Result $child) => $child->withInvertedValidation(), $this->children),
        );
    }

    public function withInvertedMode(): self
    {
        return $this->clone(
            isValid: !$this->isValid,
            mode: $this->mode == Mode::DEFAULT ? Mode::INVERTED : Mode::DEFAULT,
            adjacent: $this->adjacent?->withInvertedMode(),
            children: array_map(static fn (Result $child) => $child->withInvertedMode(), $this->children),
        );
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
            static fn (Result $child) => $child->allowsAdjacent()
        );

        return count($childrenThatAllowAdjacent) === 1;
    }

    /**
     * @param array<Result>|null $children
     */
    private function clone(
        ?bool $isValid = null,
        mixed $input = null,
        ?string $template = null,
        ?Mode $mode = null,
        ?string $name = null,
        ?string $id = null,
        ?Result $adjacent = null,
        ?bool $unchangeableId = null,
        ?array $children = null
    ): self {
        return new self(
            $isValid ?? $this->isValid,
            $input ?? $this->input,
            $this->rule,
            $this->parameters,
            $template ?? $this->template,
            $mode ?? $this->mode,
            $name ?? $this->name,
            $id ?? $this->id,
            $adjacent ?? $this->adjacent,
            $unchangeableId ?? $this->unchangeableId,
            ...($children ?? $this->children)
        );
    }
}
