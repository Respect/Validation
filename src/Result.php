<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Validators\Core\Nameable;

use function array_filter;
use function array_map;
use function count;
use function preg_match;

final readonly class Result
{
    /** @var array<Result> */
    public array $children;

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public bool $hasPassed,
        public mixed $input,
        public Validator $validator,
        public Id $id,
        public array $parameters = [],
        public string $template = Validator::TEMPLATE_STANDARD,
        public bool $hasInvertedMode = false,
        public bool $hasPrecedentName = true,
        public bool $isIndeterminate = false,
        public Name|null $name = null,
        public Result|null $adjacent = null,
        public Path|null $path = null,
        Result ...$children,
    ) {
        $this->children = $children;
    }

    /** @param array<string, mixed> $parameters */
    public static function of(
        bool $hasPassed,
        mixed $input,
        Validator $validator,
        array $parameters = [],
        string $template = Validator::TEMPLATE_STANDARD,
    ): self {
        return new self($hasPassed, $input, $validator, Id::fromValidator($validator), $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function failed(
        mixed $input,
        Validator $validator,
        array $parameters = [],
        string $template = Validator::TEMPLATE_STANDARD,
    ): self {
        return self::of(false, $input, $validator, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function passed(
        mixed $input,
        Validator $validator,
        array $parameters = [],
        string $template = Validator::TEMPLATE_STANDARD,
    ): self {
        return self::of(true, $input, $validator, $parameters, $template);
    }

    public function asAdjacentOf(Result $result, string $prefix): Result
    {
        if ($this->allowsAdjacent()) {
            return clone ($result, [
                'id' => $this->id->withPrefix($prefix),
                'adjacent' => $this->withInput($result->input),
            ]);
        }

        return clone ($this, [
            'input' => $result->input,
            'children' => array_map(
                static fn(Result $child) => $child->asAdjacentOf($result, $prefix),
                $this->children,
            ),
        ]);
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

    public function withIdFrom(Validator $validator): self
    {
        return clone($this, ['id' => Id::fromValidator($validator)]);
    }

    public function withPrecedentName(bool $hasPrecedentName): self
    {
        return clone($this, [
            'hasPrecedentName' => $hasPrecedentName,
            'adjacent' => $this->adjacent?->withPrecedentName($hasPrecedentName),
            'children' => $this->mapChildren(static fn(Result $r) => $r->withPrecedentName($hasPrecedentName)),
        ]);
    }

    public function withPath(Path $path): self
    {
        if ($this->path !== null) {
            $this->path->parent = $path;

            return $this;
        }

        return clone($this, [
            'path' => $path,
            'adjacent' => $this->adjacent?->withPath($path),
            'children' => $this->mapChildren(static fn(Result $r) => $r->withPath($path)),
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
            'children' => $this->mapChildrenIf(
                fn(Result $child) => $child->name === $this->name,
                static fn(Result $child) => $child->withoutName(),
            ),
        ]);
    }

    public function withChildren(Result ...$children): self
    {
        return clone($this, ['children' => $children]);
    }

    public function withName(Name $name): self
    {
        if ($this->name !== null) {
            return $this;
        }

        return clone($this, [
            'name' => $name,
            'hasPrecedentName' => $this->path === null,
            'adjacent' => $this->adjacent?->withName($name),
            'children' => $this->mapChildrenIf(
                static fn(Result $child) => $child->name === null,
                static fn(Result $child) => $child->withName($name),
            ),
        ]);
    }

    public function withNameFrom(Validator $validator): self
    {
        if (!$validator instanceof Nameable || $validator->getName() === null) {
            return $this;
        }

        return clone($this, [
            'name' => $this->name ?? $validator->getName(),
            'adjacent' => $this->adjacent?->withNameFrom($validator),
        ]);
    }

    public function withAdjacent(Result $adjacent): self
    {
        return clone($this, ['adjacent' => $adjacent]);
    }

    public function withInput(mixed $input): self
    {
        return clone($this, [
            'input' => $input,
            'adjacent' => $this->adjacent?->withInput($input),
            'children' => $this->mapChildrenIf(
                fn(Result $child) => $child->input === $this->input && $child->path === $this->path,
                static fn(Result $child) => $child->withInput($input),
            ),
        ]);
    }

    public function withToggledValidation(): self
    {
        return clone($this, [
            'hasPassed' => !$this->hasPassed,
            'adjacent' => $this->adjacent?->withToggledValidation(),
        ]);
    }

    public function withToggledModeAndValidation(): self
    {
        return clone($this, [
            'hasPassed' => !$this->hasPassed,
            'hasInvertedMode' => !$this->hasInvertedMode,
            'adjacent' => $this->adjacent?->withToggledModeAndValidation(),
            'children' => $this->mapChildren(static fn(Result $r) => $r->withToggledModeAndValidation()),
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

    public function asIndeterminate(): self
    {
        return clone($this, ['isIndeterminate' => true]);
    }

    /** @return array<Result> */
    private function mapChildren(callable $callback): array
    {
        return $this->children === [] ? [] : array_map($callback, $this->children);
    }

    /** @return array<Result> */
    private function mapChildrenIf(callable $condition, callable $callback): array
    {
        if ($this->children === []) {
            return [];
        }

        return array_map(static fn(self $child) => $condition($child) ? $callback($child) : $child, $this->children);
    }
}
