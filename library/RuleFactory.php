<?php

declare(strict_types=1);

namespace Respect\Validation;

interface RuleFactory
{
    /** @param array<int, mixed> $arguments */
    public function create(string $ruleName, array $arguments = []): Rule;
}
