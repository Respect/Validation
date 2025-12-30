<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Builders;

use Respect\Validation\Id;
use Respect\Validation\Name;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Test\Rules\Stub;

final class ResultBuilder
{
    private bool $hasPassed = false;

    private mixed $input = 'input';

    private bool $hasInvertedMode = false;

    private bool $hasPrecedentName = true;

    private string $template = Rule::TEMPLATE_STANDARD;

    /** @var array<string, mixed> */
    private array $parameters = [];

    private Name|null $name = null;

    private Id $id;

    private Rule $rule;

    private Result|null $adjacent = null;

    /** @var array<Result> */
    private array $children = [];

    private Path|null $path = null;

    public function __construct()
    {
        $this->rule = Stub::daze();
        $this->id = Id::fromRule($this->rule);
    }

    public function build(): Result
    {
        return new Result(
            $this->hasPassed,
            $this->input,
            $this->rule,
            $this->id,
            $this->parameters,
            $this->template,
            $this->hasInvertedMode,
            $this->hasPrecedentName,
            $this->name,
            $this->adjacent,
            $this->path,
            ...$this->children,
        );
    }

    public function withPath(Path $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function hasPassed(bool $hasPassed): self
    {
        $this->hasPassed = $hasPassed;

        return $this;
    }

    public function template(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function withCustomTemplate(): self
    {
        $this->template = 'Custom template';

        return $this;
    }

    /** @param array<string, mixed> $parameters */
    public function parameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function name(string $name): self
    {
        $this->name = new Name($name);

        return $this;
    }

    public function id(string $id): self
    {
        $this->id = new Id($id);

        return $this;
    }

    public function input(mixed $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function children(Result ...$children): self
    {
        $this->children = $children;

        return $this;
    }

    public function hasInvertedMode(): self
    {
        $this->hasInvertedMode = true;

        return $this;
    }

    public function adjacent(Result $build): self
    {
        $this->adjacent = $build;

        return $this;
    }
}
