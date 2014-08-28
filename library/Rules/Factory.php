<?php

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Factory extends AbstractRule
{
    public $rule;

    public static $prefixes = array('Respect\\Validation\\Rules\\');

    public function __construct($ruleName, array $constructorArgs = array())
    {
        $this->rule = $this->rule($ruleName, $constructorArgs);
    }

    public function rule($ruleName, array $constructorArgs = array())
    {
        foreach (self::$prefixes as $prefix) {
            $className = $prefix.ucfirst($ruleName);

            if (! class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);
            if (! $reflection->isSubclassOf('Respect\\Validation\\Validatable')) {
                throw new ComponentException(sprintf('"%s" is not a valid respect rule', $className));
            }

            return $reflection->newInstanceArgs($constructorArgs);
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }

    public static function appendPrefix($rulePrefix)
    {
        array_push(self::$prefixes, $rulePrefix);
    }

    public static function prependPrefix($rulePrefix)
    {
        array_unshift(self::$prefixes, $rulePrefix);
    }

    public function assert($input)
    {
        return $this->rule->assert($input);
    }

    public function check($input)
    {
        return $this->rule->check($input);
    }

    public function validate($input)
    {
        return $this->rule->validate($input);
    }
}
