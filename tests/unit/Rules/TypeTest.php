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
use stdClass;
use function tmpfile;

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\Type
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
class TypeTest extends RuleTestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid type (Available: array, bool, boolean, callable, double, float, int, integer, null, object, resource, string)
     *
     * @test
     */
    public function shouldThrowExceptionWhenTypeIsNotValid(): void
    {
        new Type('whatever');
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Type('array'), []],
            [new Type('bool'), true],
            [new Type('boolean'), false],
            [new Type('callable'), function (): void {
            }],
            [new Type('double'), 0.8],
            [new Type('float'), 1.0],
            [new Type('int'), 42],
            [new Type('integer'), 13],
            [new Type('null'), null],
            [new Type('object'), new stdClass()],
            [new Type('resource'), tmpfile()],
            [new Type('string'), 'Something'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Type('int'), '1'],
            [new Type('bool'), '1'],
        ];
    }
}
