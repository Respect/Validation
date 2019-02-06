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

use DateTime;
use Respect\Validation\Test\RuleTestCase;
use Zend\Validator\Date as ZendDate;
use Zend\Validator\ValidatorInterface;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Zend
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ZendTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $zendValidatorInterface = $this
            ->getMockBuilder(ValidatorInterface::class)
            ->getMock();

        $zendValidatorInterface
            ->expects(self::once())
            ->method('isValid')
            ->with('2018-02-05')
            ->will(self::returnValue(true));

        return [
            'Constructor with name' => [new Zend('Date'), '2019-02-05'],
            'Constructor with class name' => [new Zend(ZendDate::class), '2015-02-05'],
            'Constructor with instance' => [new Zend($zendValidatorInterface), '2018-02-05'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $zendValidatorInterface = $this
            ->getMockBuilder(ValidatorInterface::class)
            ->getMock();

        $zendValidatorInterface
            ->expects(self::once())
            ->method('isValid')
            ->with('2018-02-05')
            ->will(self::returnValue(true));

        return [
            'Zend Date' => [new Zend('Date'), 'abc'],
            'Constructor with class name' => [new Zend(ZendDate::class), '05/02/19']
        ];
    }
}
