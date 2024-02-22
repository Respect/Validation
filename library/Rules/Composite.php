<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\DeprecatedValidatableMethods;
use Respect\Validation\Validatable;

use function array_merge;

abstract class Composite implements Validatable
{
    use DeprecatedValidatableMethods;

    /** @var non-empty-array<Validatable> */
    private readonly array $rules;

    private ?string $name = null;

    private ?string $template = null;

    public function __construct(Validatable $rule1, Validatable $rule2, Validatable ...$rules)
    {
        $this->rules = array_merge([$rule1, $rule2], $rules);
    }

    /** @return non-empty-array<Validatable> */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function setName(string $name): static
    {
        foreach ($this->getRules() as $rule) {
            if ($rule->getName() && $this->name !== $rule->getName()) {
                continue;
            }

            $rule->setName($name);
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }
}
