<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\KeyException;
use Respect\Validation\Test\TestCase;
use Throwable;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractRelated
 * @covers \Respect\Validation\Rules\Key
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeyTest extends TestCase
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
     * @test
     */
    public function emptyInputMustNotAssert(): void
    {
        $validator = new Key('someEmptyKey');

        $this->expectException(KeyException::class);

        $validator->assert('');
    }

    /**
     * @test
     */
    public function emptyInputMustNotCheck(): void
    {
        $validator = new Key('someEmptyKey');

        $this->expectException(KeyException::class);

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
        } catch (Throwable $e) {
        }

        try {
            $rule->check($input);
            self::fail('`check()` must throws exception');
        } catch (Throwable $e) {
        }

        self::assertFalse($rule->validate($input));
    }

    /**
     * @test
     */
    public function arrayWithAbsentKeyShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['baraaaaaa'] = 'foo';

        $this->expectException(KeyException::class);

        $validator->assert($someArray);
    }

    /**
     * @test
     */
    public function notArrayShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = 123;

        $this->expectException(KeyException::class);

        $validator->assert($someArray);
    }

    /**
     * @test
     */
    public function invalidConstructorParametersShouldThrowComponentExceptionUponInstantiation(): void
    {
        $this->expectException(ComponentException::class);

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
