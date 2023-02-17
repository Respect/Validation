<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AllOfException;

use function count;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class AllOf extends AbstractComposite
{
    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        $exceptions = $this->getAllThrownExceptions($input);
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        $summary = [
            'total' => $numRules,
            'failed' => $numExceptions,
            'passed' => $numRules - $numExceptions,
        ];
        if (!empty($exceptions)) {
            /** @var AllOfException $allOfException */
            $allOfException = $this->reportError($input, $summary);
            $allOfException->addChildren($exceptions);

            throw $allOfException;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        foreach ($this->getRules() as $rule) {
            $rule->check($input);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        foreach ($this->getRules() as $rule) {
            if (!$rule->validate($input)) {
                return false;
            }
        }

        return true;
    }
}
