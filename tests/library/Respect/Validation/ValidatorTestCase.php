<?php

namespace Respect\Validation;

use Mockery;
use Respect\Validation\Exceptions\InvalidException;

abstract class ValidatorTestCase extends \PHPUnit_Framework_TestCase
{

    protected function assertValidatorPresence($validator)
    {
        $args = func_get_args();
        array_shift($args);
        foreach ($args as $req) {
            $this->assertTrue(
                $validator->hasRule('Respect\Validation\Rules\\' . $req)
            );
        }
    }

    protected function buildMockValidator($name, array $messages, $invalid=false)
    {
        $validator = Mockery::mock('Respect\Validation\Validatable');
        if ($invalid) {
            $validator->shouldReceive('assert')->andThrow(
                new InvalidException('Always invalid, man.')
            );
            $validator->shouldReceive('validate')->andReturn(false);
        } else {
            $validator->shouldReceive('validate')->andReturn(true);
            $validator->shouldReceive('assert')->andReturn(true);
        }
        $validator->shouldReceive('getMessageTemplates')->andReturn(
            $messages
        );
        $className = 'Respect\Validation\Rules\\' . $name;
        if (!class_exists($className, false)) {
            eval("
                namespace Respect\Validation\Rules; 
                class $name
                extends \Respect\Validation\Rules\AbstractRule
                implements \Respect\Validation\Validatable  {
                    public function assert(\$input) {}
                    public function validate(\$input) {}
                    public function getMessageTemplates() {
                        return " . var_export($messages,
                    true) . ";
                    }
                } 
                ");
        }

        return $validator;
    }

    public function providerForMockImpossibleValidators()
    {
        $firstValidator = $this->buildMockValidator(
                'FooBar', array('Bar_1' => 'fga', 'Bar_2' => 'dfgb'), true
        );
        $secondValidator = $this->buildMockValidator(
                'FooBaz', array('Baz_1' => 'gedg', 'Baz_2' => 'rihg49'), true
        );
        $thirdValidator = $this->buildMockValidator(
                'FooBat', array('Bat_1' => 'dfdsgdgfgb'), true
        );
        return array(
            array($firstValidator, $secondValidator, $thirdValidator),
            array($secondValidator, $firstValidator, $thirdValidator),
            array($thirdValidator, $secondValidator, $firstValidator)
        );
    }

    public function providerForMockValidators()
    {
        $firstValidator = $this->buildMockValidator(
                'FooBara', array('Bara_1' => 'fga', 'Bara_2' => 'dfgb'), false
        );
        $secondValidator = $this->buildMockValidator(
                'FooBaza', array('Baza_1' => 'gedg', 'Baza_2' => 'rihg49'),
                false
        );
        $thirdValidator = $this->buildMockValidator(
                'FooBata', array('Bata_1' => 'dfdsgdgfgb'), false
        );
        return array(
            array($firstValidator, $secondValidator, $thirdValidator),
            array($secondValidator, $firstValidator, $thirdValidator),
            array($thirdValidator, $secondValidator, $firstValidator)
        );
    }

}