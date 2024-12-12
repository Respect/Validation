<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Builders;

use Respect\Validation\Mode;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Test\Rules\Stub;

final class ResultBuilder
{
    private bool $isValid = false;

    private mixed $input = 'input';

    private Mode $mode = Mode::DEFAULT;

    private string $template = Rule::TEMPLATE_STANDARD;

    /** @var array<string, mixed> */
    private array $parameters = [];

    private ?string $name = null;

    private ?string $id = null;

    private Rule $rule;

    private ?Result $subsequent = null;

    private bool $unchangeableId = false;

    /** @var array<Result> */
    private array $children = [];

    public function __construct()
    {
        $this->rule = Stub::daze();
    }

    public function build(): Result
    {
        return new Result(
            $this->isValid,
            $this->input,
            $this->rule,
            $this->parameters,
            $this->template,
            $this->mode,
            $this->name,
            $this->id,
            $this->subsequent,
            $this->unchangeableId,
            ...$this->children
        );
    }

    public function isValid(bool $isValid): self
    {
        $this->isValid = $isValid;

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
        $this->name = $name;

        return $this;
    }

    public function id(string $id): self
    {
        $this->id = $id;

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

    public function mode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function subsequent(Result $build): self
    {
        $this->subsequent = $build;

        return $this;
    }
}
