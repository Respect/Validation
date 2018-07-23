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
 * @covers \Respect\Validation\Exceptions\KeyException
 * @covers \Respect\Validation\Rules\Key
 */
class KeyTest extends TestCase
{
    /**
     * @test
     */
    public function arrayWithPresentKeyShouldReturnTrue(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['bar'] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    /**
     * @test
     */
    public function arrayWithNumericKeyShouldReturnTrue(): void
    {
        $validator = new Key(0);
        $someArray = [];
        $someArray[0] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    /**
     * @test
     */
    public function emptyInputMustReturnFalse(): void
    {
        $validator = new Key('someEmptyKey');
        $input = '';

        self::assertFalse($validator->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     *
     * @test
     */
    public function emptyInputMustNotAssert(): void
    {
        $validator = new Key('someEmptyKey');
        $validator->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     *
     * @test
     */
    public function emptyInputMustNotCheck(): void
    {
        $validator = new Key('someEmptyKey');
        $validator->check('');
    }

    /**
     * @test
     */
    public function arrayWithEmptyKeyShouldReturnTrue(): void
    {
        $validator = new Key('someEmptyKey');
        $input = [];
        $input['someEmptyKey'] = '';

        self::assertTrue($validator->validate($input));
    }

    /**
     * @test
     */
    public function shouldHaveTheSameReturnValueForAllValidators(): void
    {
        $rule = new Key('key', new NotEmpty());
        $input = ['key' => ''];

        try {
            $rule->assert($input);
            self::fail('`assert()` must throws exception');
        } catch (\Exception $e) {
        }

        try {
            $rule->check($input);
            self::fail('`check()` must throws exception');
        } catch (\Exception $e) {
        }

        self::assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     *
     * @test
     */
    public function arrayWithAbsentKeyShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['baraaaaaa'] = 'foo';
        $validator->assert($someArray);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyException
     *
     * @test
     */
    public function notArrayShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = 123;
        $validator->assert($someArray);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParametersShouldThrowComponentExceptionUponInstantiation(): void
    {
        new Key(['invalid']);
    }

    /**
     * @doesNotPerformAssertions
     *
     * @test
     */
    public function extraValidatorShouldValidateKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $someArray = [];
        $someArray['bar'] = 'foo';
        $validator->assert($someArray);
    }

    /**
     * @test
     */
    public function notMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $someArray = [];
        self::assertTrue($validator->validate($someArray));
    }
}
