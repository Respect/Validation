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

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public bool $hasPassed,
        public Subject $subject,
        public Rule $rule,
        public Id $id,
        public array $parameters = [],
        public string $template = Rule::TEMPLATE_STANDARD,
        public bool $hasInvertedMode = false,
        public Result|null $adjacent = null,
        Result ...$children,
    ) {
        $this->children = $children;
    }

    /** @param array<string, mixed> $parameters */
    public static function of(
        bool $hasPassed,
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): self {
        return new self($hasPassed, new Subject($input), $rule, Id::fromRule($rule), $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function failed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): self {
        return self::of(false, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function passed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD,
    ): self {
        return self::of(true, $input, $rule, $parameters, $template);
    }

    public function asAdjacentOf(Result $result, string $prefix): Result
    {
        if ($this->allowsAdjacent()) {
            return clone ($result, [
                'id' => $this->id->withPrefix($prefix),
                'adjacent' => $this->withSubject($result->subject),
            ]);
        }

        return clone ($this, [
            'subject' => $result->subject,
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

    public function withIdFrom(Rule $rule): self
    {
        return clone($this, ['id' => Id::fromRule($rule)]);
    }

    public function withPath(Path $path): self
    {
        return clone($this, [
            'subject' => $this->subject->withPath($path),
            'adjacent' => $this->adjacent?->withPath($path),
            'children' => array_map(
                static fn(Result $child) => $child->withPath($path),
                $this->children,
            ),
        ]);
    }

    public function withoutName(): self
    {
        return clone ($this, [
            'subject' => $this->subject->withoutName(),
            'adjacent' => $this->adjacent?->withoutName(),
            'children' => array_map(
                fn(Result $child) => $child->subject->name === $this->subject->name ? $child->withoutName() : $child,
                $this->children,
            ),
        ]);
    }

    public function withChildren(Result ...$children): self
    {
        return clone($this, [
            'children' => array_map(fn(Result $child) => $child->withSubject($this->subject), $children),
        ]);
    }

    public function withName(Name $name): self
    {
        return clone($this, [
            'subject' => $this->subject->withName($name),
            'adjacent' => $this->adjacent?->withName($name),
            'children' => array_map(
                static fn(Result $child) => $child->withName($name),
                $this->children,
            ),
        ]);
    }

    public function withNameFrom(Rule $rule): self
    {
        if ($rule instanceof Nameable && $rule->getName() !== null) {
            return clone($this, [
                'subject' => $this->subject->withName2($rule->getName()),
                'adjacent' => $this->adjacent?->withNameFrom($rule),
                'children' => array_map(
                    static fn(Result $child) => $child->withNameFrom($rule),
                    $this->children,
                ),
            ]);
        }

        return $this;
    }

    public function withSubject(Subject $subject): self
    {
        return clone($this, [
            'subject' => $this->subject->withMergeFrom($subject),
            'adjacent' => $this->adjacent?->withSubject($subject),
            'children' => array_map(static fn(Result $child) => $child->withSubject($subject), $this->children),
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
