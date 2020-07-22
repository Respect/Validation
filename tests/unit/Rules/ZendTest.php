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
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\ZendValidator;
use Zend\Validator\ConfigProvider;
use Zend\Validator\Date as ZendDate;
use Zend\Validator\ValidatorInterface;

use function sprintf;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Zend
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class ZendTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'Constructor with name' => [new Zend('Date'), '2019-02-05'],
            'Constructor with class name' => [new Zend(ZendDate::class), '2015-02-05'],
            'Constructor with custom class name' => [new Zend(ZendValidator::class), '2015-02-05'],
            'Constructor with instance' => [new Zend(new ZendDate()), '2018-02-05'],
            'Constructor with custom instance' => [new Zend(new ZendValidator()), 'whatever'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'Zend Date' => [new Zend('Date'), 'abc'],
            'Constructor with class name' => [new Zend(ZendDate::class), '05/02/19'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidValidator
     *
     * @param mixed $validator
     */
    public function itShouldThrowAnExceptionWhenValidatorIsNotValid($validator): void
    {
        $this->expectExceptionObject(new ComponentException('The given argument is not a valid Zend Validator'));

        new Zend($validator);
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidValidator(): array
    {
        return [
            [null],
            [[]],
            [new Stub()],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForUnbuildableValidator
     */
    public function itShouldThrowAnExceptionWhenValidatorCannotBeCreated(string $validator): void
    {
        $this->expectExceptionObject(
            new ComponentException(sprintf('Could not create "%s"', $validator))
        );

        new Zend($validator);
    }

    /**
     * @return string[][]
     */
    public function providerForUnbuildableValidator(): array
    {
        return [
            ['ConfigProvider'],
            [ConfigProvider::class],
            ['Zend\\Nonexistent\\Class'],
            [ValidatorInterface::class],
        ];
    }
}
