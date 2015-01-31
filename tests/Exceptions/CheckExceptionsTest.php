<?php

namespace Respect\Validation\Exceptions;

use ReflectionClass;
use DirectoryIterator;

class CheckExceptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $deprecateds = array();

    private function getAllRuleNames()
    {
        $rulesDirectory = __DIR__.'/../../library/Rules';
        $rulesDirectoryIterator = new DirectoryIterator($rulesDirectory);
        $ruleNames = array();
        foreach ($rulesDirectoryIterator as $fileInfo) {
            if ($fileInfo->isDir()) {
                continue;
            }
            $ruleName = substr($fileInfo->getBasename(), 0, -4);
            if (in_array($ruleName, $this->deprecateds)) {
                continue;
            }

            $className = 'Respect\\Validation\\Rules\\'.$ruleName;

            $reflectionClass = new ReflectionClass($className);
            if ($reflectionClass->isAbstract()
            || $reflectionClass->isInterface()
            || ! $reflectionClass->implementsInterface('Respect\\Validation\\Validatable')) {
                continue;
            }

            $ruleNames[] = $ruleName;
        }

        return $ruleNames;
    }

    public function testEveryRuleMustBeItsOwnException()
    {
        $missingExceptions = array();

        foreach ($this->getAllRuleNames() as $ruleName) {
            $exceptionClass = 'Respect\\Validation\\Exceptions\\'.$ruleName.'Exception';
            if (class_exists($exceptionClass)) {
                continue;
            }

            $missingExceptions[] = $ruleName;
        }

        $this->assertEmpty($missingExceptions, 'No exceptions for: '.implode(', ', $missingExceptions));
    }
}
