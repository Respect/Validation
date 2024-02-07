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
        string $template = Rule::TEMPLATE_STANDARD,
        public readonly array $parameters = [],
        public readonly Mode $mode = Mode::DEFAULT,
        ?string $name = null,
        ?string $id = null,
        public readonly ?Result $nextSibling = null,
        Result ...$children,
    ) {
        $this->name = $rule->getName() ?? $name;
        $this->template = $rule->getTemplate() ?? $template;
        $this->id = $id ?? $this->name ?? lcfirst(substr((string) strrchr($rule::class, '\\'), 1));
        $this->children = $children;
    }

    public static function failed(mixed $input, Rule $rule, string $template = Rule::TEMPLATE_STANDARD): self
    {
        return new self(false, $input, $rule, $template);
    }

    public static function passed(mixed $input, Rule $rule, string $template = Rule::TEMPLATE_STANDARD): self
    {
        return new self(true, $input, $rule, $template);
    }

    public function withTemplate(string $template): self
    {
        return $this->clone(template: $template);
    }

    public function withId(string $id): self
    {
        return $this->clone(id: $id);
    }

    public function withChildren(Result ...$children): self
    {
        return $this->clone(children: $children);
    }

    /** @param array<string, mixed> $parameters */
    public function withParameters(array $parameters): self
    {
        return $this->clone(parameters: $parameters);
    }

    public function withNameIfMissing(string $name): self
    {
        return $this->clone(
            name: $this->name ?? $name,
            children: array_map(static fn (Result $child) => $child->withNameIfMissing($name), $this->children),
        );
    }

    public function withNextSibling(Result $nextSibling): self
    {
        return $this->clone(nextSibling: $nextSibling);
    }

    public function withInvertedMode(): self
    {
        return $this->clone(
            isValid: !$this->isValid,
            mode: $this->mode == Mode::DEFAULT ? Mode::NEGATIVE : Mode::DEFAULT,
            nextSibling: $this->nextSibling?->withInvertedMode(),
            children: array_map(static fn (Result $child) => $child->withInvertedMode(), $this->children),
        );
    }

    public function withMode(Mode $mode): self
    {
        return $this->clone(mode: $mode);
    }

    public function hasCustomTemplate(): bool
    {
        return preg_match('/__[0-9a-z_]+_/', $this->template) === 0;
    }

    public function isAlwaysVisible(): bool
    {
        if ($this->isValid) {
            return false;
        }

        if ($this->hasCustomTemplate()) {
            return true;
        }

        $childrenAlwaysVisible = array_filter($this->children, static fn (Result $child) => $child->isAlwaysVisible());

        return count($childrenAlwaysVisible) !== 1;
    }

    /**
     * @param array<string, mixed>|null $parameters
     * @param array<Result>|null $children
     */
    private function clone(
        ?bool $isValid = null,
        ?string $template = null,
        ?array $parameters = null,
        ?Mode $mode = null,
        ?string $name = null,
        ?string $id = null,
        ?Result $nextSibling = null,
        ?array $children = null
    ): self {
        return new self(
            $isValid ?? $this->isValid,
            $this->input,
            $this->rule,
            $template ?? $this->template,
            $parameters ?? $this->parameters,
            $mode ?? $this->mode,
            $name ?? $this->name,
            $id ?? $this->id,
            $nextSibling ?? $this->nextSibling,
            ...($children ?? $this->children)
        );
    }
}
