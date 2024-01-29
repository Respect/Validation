<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AllOfException;

use function count;

class AllOf extends AbstractComposite
{
    public const TEMPLATE_NONE = 'none';
    public const TEMPLATE_SOME = 'some';

    public function assert(mixed $input): void
    {
        try {
            parent::assert($input);
        } catch (AllOfException $exception) {
            if (count($exception->getChildren()) === count($this->getRules()) && !$exception->hasCustomTemplate()) {
                $exception->updateTemplate(self::TEMPLATE_NONE);
            }

            throw $exception;
        }
    }

    public function check(mixed $input): void
    {
        foreach ($this->getRules() as $rule) {
            $rule->check($input);
        }
    }

    public function validate(mixed $input): bool
    {
        foreach ($this->getRules() as $rule) {
            if (!$rule->validate($input)) {
                return false;
            }
        }

        return true;
    }

    public function getTemplate(mixed $input): string
    {
        return $this->template ?? self::TEMPLATE_SOME;
    }
}
