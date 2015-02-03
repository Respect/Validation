<?php

namespace Respect\Validation\Exceptions;

use ReflectionClass;
use DirectoryIterator;

class CheckExceptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $deprecateds = array(
        'Consonants',
        'Digits',
        'Vowels',
    );

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
            $exceptionClass = $this->buildExceptionClass($ruleName);
            if (class_exists($exceptionClass)) {
                continue;
            }

            $missingExceptions[] = $ruleName;
        }

        $this->assertEmpty($missingExceptions, 'No exceptions for: ' . $this->formatArrayAsString($missingExceptions));
    }

    public function testEveryRuleExceptionImplementsValidationExceptionInterface()
    {
        $exceptionsNotImplementingInterface = array();

        foreach ($this->getAllRuleNames() as $ruleName) {
            $exceptionClass = $this->buildExceptionClass($ruleName);
            $exceptionClassMock = new $exceptionClass();
            if ($exceptionClassMock instanceof ValidationExceptionInterface) {
                continue;
            }

            $exceptionsNotImplementingInterface[] = $ruleName;
        }

        $this->assertEmpty($exceptionsNotImplementingInterface,
            'ValidationExceptionInterface not implemented in: ' .
            $this->formatArrayAsString($exceptionsNotImplementingInterface));
    }

    /**
     * @param string $ruleName
     * @return string
     */
    private function buildExceptionClass($ruleName)
    {
        $exceptionClass = 'Respect\\Validation\\Exceptions\\' . $ruleName . 'Exception';
        return $exceptionClass;
    }

    /**
     * @param array $array
     * @return string
     */
    private function formatArrayAsString(array $array)
    {
        return implode(', ', $array);
    }
}
