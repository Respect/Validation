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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Key
 * @covers \Respect\Validation\Exceptions\KeyException
 */
class KeyTest extends TestCase
{
    public function testArrayWithPresentKeyShouldReturnTrue(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['bar'] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    public function testArrayWithNumericKeyShouldReturnTrue(): void
    {
        $validator = new Key(0);
        $someArray = [];
        $someArray[0] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    public function testEmptyInputMustReturnFalse(): void
    {
        $validator = new Key('someEmptyKey');
        $input = '';

        self::assertFalse($validator->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testEmptyInputMustNotAssert(): void
    {
        $validator = new Key('someEmptyKey');
        $validator->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testEmptyInputMustNotCheck(): void
    {
        $validator = new Key('someEmptyKey');
        $validator->check('');
    }

    public function testArrayWithEmptyKeyShouldReturnTrue(): void
    {
        $validator = new Key('someEmptyKey');
        $input = [];
        $input['someEmptyKey'] = '';

        self::assertTrue($validator->validate($input));
    }

    public function testShouldHaveTheSameReturnValueForAllValidators(): void
    {
        $rule = new Key('key', new NotEmpty());
        $input = ['key' => ''];

        try {
            $rule->assert($input);
            $this->fail('`assert()` must throws exception');
        } catch (\Exception $e) {
        }

        try {
            $rule->check($input);
            $this->fail('`check()` must throws exception');
        } catch (\Exception $e) {
        }

        self::assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testArrayWithAbsentKeyShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['baraaaaaa'] = 'foo';
        self::assertTrue($validator->assert($someArray));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     */
    public function testNotArrayShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = 123;
        self::assertFalse($validator->assert($someArray));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParametersShouldThrowComponentExceptionUponInstantiation(): void
    {
        $validator = new Key(['invalid']);
    }

    public function testExtraValidatorShouldValidateKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $someArray = [];
        $someArray['bar'] = 'foo';
        self::assertTrue($validator->assert($someArray));
    }

    public function testNotMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $someArray = [];
        self::assertTrue($validator->validate($someArray));
    }
}
