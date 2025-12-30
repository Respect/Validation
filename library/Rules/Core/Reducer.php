<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Name;
use Respect\Validation\Rule;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Named;
use Respect\Validation\Rules\Templated;

final class Reducer extends Wrapper
{
    public function __construct(Rule $rule1, Rule ...$rules)
    {
        parent::__construct($rules === [] ? $rule1 : new AllOf($rule1, ...$rules));
    }

    public function withTemplate(string $template): self
    {
        return new self(new Templated($this->rule, $template));
    }

    public function withName(Name $name): self
    {
        return new self(new Named($this->rule, $name));
    }

    public function getName(): Name|null
    {
        if ($this->rule instanceof Nameable) {
            return $this->rule->getName();
        }

        return null;
    }
}
