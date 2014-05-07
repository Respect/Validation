<?php

namespace Respect\Validation;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;

class Factory
{
    protected $rulePrefixes = array('Respect\\Validation\\Rules\\');

    public function getRulePrefixes()
    {
        return $this->rulePrefixes;
    }

    public function appendRulePrefix($rulePrefix)
    {
        array_push($this->rulePrefixes, $rulePrefix);
    }

    public function prependRulePrefix($rulePrefix)
    {
        array_unshift($this->rulePrefixes, $rulePrefix);
    }

    public function rule($ruleName, array $arguments = array())
    {
        if ($ruleName instanceof Validatable) {
            return $ruleName;
        }

        foreach ($this->getRulePrefixes() as $prefix) {
            $className = $prefix.ucfirst($ruleName);
            if (! class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);
            if (! $reflection->isSubclassOf('Respect\\Validation\\Validatable')) {
                throw new ComponentException(sprintf('"%s" is not a valid respect rule', $className));
            }

            return $reflection->newInstanceArgs($arguments);
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }
}
