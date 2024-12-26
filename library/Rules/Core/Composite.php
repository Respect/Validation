<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Helpers\DeprecatedValidatableMethods;
use Respect\Validation\Rule;

use function array_merge;

abstract class Composite implements Rule
{
    use DeprecatedValidatableMethods;

    /** @var non-empty-array<Rule> */
    protected readonly array $rules;

    private ?string $name = null;

    public function __construct(Rule $rule1, Rule $rule2, Rule ...$rules)
    {
        $this->rules = array_merge([$rule1, $rule2], $rules);
    }

    /** @return non-empty-array<Rule> */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function setName(string $name): static
    {
        foreach ($this->rules as $rule) {
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
}
