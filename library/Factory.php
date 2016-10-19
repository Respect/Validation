<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;

class Factory
{
    protected $rulePrefixes = ['Respect\\Validation\\Rules\\'];

    public function getRulePrefixes()
    {
        return $this->rulePrefixes;
    }

    private function filterRulePrefix($rulePrefix)
    {
        $namespaceSeparator = '\\';
        $rulePrefix = rtrim($rulePrefix, $namespaceSeparator);

        return $rulePrefix.$namespaceSeparator;
    }

    public function appendRulePrefix($rulePrefix)
    {
        array_push($this->rulePrefixes, $this->filterRulePrefix($rulePrefix));
    }

    public function prependRulePrefix($rulePrefix)
    {
        array_unshift($this->rulePrefixes, $this->filterRulePrefix($rulePrefix));
    }

    public function rule($ruleName, array $arguments = [])
    {
        if ($ruleName instanceof Validatable) {
            return $ruleName;
        }

        // statically cache the reflections for performance reasons.
        // Since using RelectionClass is not very performant we statically cache
        // the initantized reflect objects so that subsequent requests for the
        // same rule to not have to do the expensive reflection startup process
        // once again.
        static $reflections = array();

        foreach ($this->getRulePrefixes() as $prefix) {
            $className = $prefix.ucfirst($ruleName);

            if(isset($reflections[$className]) === true) {
                return $reflections[$className]->newInstanceArgs($arguments);
            }

            if (!class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);
            if (!$reflection->isSubclassOf('Respect\\Validation\\Validatable')) {
                throw new ComponentException(sprintf('"%s" is not a valid respect rule', $className));
            }
            $reflections[$className] = $reflection;

            return $reflection->newInstanceArgs($arguments);
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }
}
