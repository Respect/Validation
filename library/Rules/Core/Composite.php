<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rule;

use function array_merge;

abstract class Composite implements Rule
{
    /** @var non-empty-array<Rule> */
    protected readonly array $rules;

    public function __construct(Rule $rule1, Rule $rule2, Rule ...$rules)
    {
        $this->rules = array_merge([$rule1, $rule2], $rules);
    }

    /** @return non-empty-array<Rule> */
    public function getRules(): array
    {
        return $this->rules;
    }
}
