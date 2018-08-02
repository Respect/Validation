<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

class AllOf extends AbstractComposite
{
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
            throw $this->reportError($input, $summary)->addChildren($exceptions);
        }
    }

    public function check($input): void
    {
        foreach ($this->getRules() as $rule) {
            $rule->check($input);
        }
    }

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
