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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Caio César Tavares <caiotava@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Not extends AbstractRule
{
    /**
     * @var Validatable
     */
    public $rule;

    public function __construct(Validatable $rule)
    {
        $this->rule = $rule;
    }

    public function setName(string $name): Validatable
    {
        $this->rule->setName($name);

        return parent::setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return $this->rule->validate($input) === false;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        if ($this->validate($input)) {
            return;
        }

        $rule = $this->rule;
        if ($rule instanceof AllOf) {
            $rule = $this->absorbAllOf($rule, $input);
        }

        $exception = $rule->reportError($input);
        $exception->updateMode(ValidationException::MODE_NEGATIVE);

        throw $exception;
    }

    /**
     * @param mixed $input
     */
    private function absorbAllOf(AllOf $rule, $input): Validatable
    {
        $rules = $rule->getRules();
        while (($current = array_shift($rules))) {
            $rule = $current;
            if (!$rule instanceof AllOf) {
                continue;
            }

            if (!$rule->validate($input)) {
                continue;
            }

            $rules = $rule->getRules();
        }

        return $rule;
    }
}
