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
use function end;
use function explode;
use function lcfirst;
use function preg_match;
use function strrchr;
use function substr;
use function ucfirst;

final readonly class Result
{
    /** @var array<Result> */
    public array $children;

    public string $id;

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public bool $hasPassed,
        public mixed $input,
        public Rule $rule,
        public array $parameters = [],
        public string $template = Rule::TEMPLATE_STANDARD,
        public bool $hasInvertedMode = false,
        public string|null $name = null,
        string|null $id = null,
        public Result|null $adjacent = null,
        public string|int|null $path = null,
        Result ...$children,
    ) {
        $this->id = $id ?? lcfirst(substr((string) strrchr($rule::class, '\\'), 1));
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
            return (new Result($adjacent->hasPassed, $input, $rule, $parameters, $template, id: $adjacent->id))
                ->withPrefix($prefix)
                ->withAdjacent($adjacent->withInput($input));
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

    public function withId(string $id): self
    {
        return clone($this, ['id' => $id]);
    }

    public function withIdFrom(Rule $rule): self
    {
        return clone($this, ['id' => lcfirst(substr((string) strrchr($rule::class, '\\'), 1))]);
    }

    public function withPath(string|int $path): self
    {
        return clone($this, [
            'adjacent' => $this->adjacent?->withPath($path),
            'path' => $this->path === null ? $path : $path . '.' . $this->path,
        ]);
    }

    public function withDeepestPath(): self
    {
        $path = $this->getDeepestPath();
        if ($path === null || $path === (string) $this->path) {
            return $this;
        }

        return clone($this, [
            'adjacent' => $this->adjacent?->withPath($path),
            'path' => $path,
        ]);
    }

    public function getDeepestPath(): string|null
    {
        if ($this->path === null) {
            return null;
        }

        $paths = explode('.', (string) $this->path);
        if (count($paths) === 1) {
            return (string) $this->path;
        }

        return end($paths);
    }

    public function withPrefix(string $prefix): self
    {
        if ($this->id === $this->name || $this->path !== null) {
            return $this;
        }

        // phpcs:ignore SlevomatCodingStandard.PHP.UselessParentheses
        return clone($this, ['id' => $prefix . ucfirst($this->id)]);
    }

    public function withChildren(Result ...$children): self
    {
        return clone($this, ['children' => $children]);
    }

    public function withName(string $name): self
    {
        return clone($this, [
            'name' => $this->name ?? $name,
            'adjacent' => $this->adjacent?->withName($name),
            'children' => array_map(
                static fn(Result $child) => $child->path === null ? $child->withName($child->name ?? $name) : $child,
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
