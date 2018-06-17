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

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Executable
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Royall Spence <royall@royall.us>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class ExecutableTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Executable();

        $object = $this->createMock('SplFileInfo', ['isExecutable'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isExecutable')
                ->will($this->returnValue(true));

        return [
            [$rule, $object],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Executable();

        $object = $this->createMock('SplFileInfo', ['isExecutable'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isExecutable')
                ->will($this->returnValue(false));

        return [
            [$rule, $object],
        ];
    }
}
