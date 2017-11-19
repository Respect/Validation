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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\KeySetException;
use Respect\Validation\Validatable;

/**
 * Validates a keys in a defined structure.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class KeySet extends AllOf
{
    /**
     * @param AllOf $rule
     *
     * @return Validatable
     */
    private function filterAllOf(AllOf $rule)
    {
        $rules = $rule->getRules();
        if (1 != count($rules)) {
            throw new ComponentException('AllOf rule must have only one Key rule');
        }

        return current($rules);
    }

    /**
     * {@inheritdoc}
     */
    public function addRule($rule, $arguments = [])
    {
        if ($rule instanceof AllOf) {
            $rule = $this->filterAllOf($rule);
        }

        if (!$rule instanceof Key) {
            throw new ComponentException('KeySet rule accepts only Key rules');
        }

        $this->appendRule($rule);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        $keys = [];
        foreach ($this->getRules() as $keyRule) {
            $keys[] = $keyRule->reference;
        }

        return $keys;
    }

    /**
     * @param array $input
     *
     * @return bool
     */
    private function hasValidStructure($input)
    {
        if (!is_array($input)) {
            return false;
        }

        foreach ($this->getRules() as $keyRule) {
            if (!array_key_exists($keyRule->reference, $input) && $keyRule->mandatory) {
                return false;
            }

            unset($input[$keyRule->reference]);
        }

        return 0 == count($input);
    }

    /**
     * @throws KeySetException
     */
    private function checkKeys($input): void
    {
        if (!$this->hasValidStructure($input)) {
            $params = ['keys' => $this->getKeys()];
            $exception = $this->reportError($input, $params);

            throw $exception;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input)
    {
        $this->checkKeys($input);

        return parent::assert($input);
    }

    /**
     * {@inheritdoc}
     */
    public function check($input)
    {
        $this->checkKeys($input);

        return parent::check($input);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (!$this->hasValidStructure($input)) {
            return false;
        }

        return parent::validate($input);
    }
}
