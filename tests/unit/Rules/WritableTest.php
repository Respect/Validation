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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Writable
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class WritableTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Writable();
        $object = $this->createMock('SplFileInfo');
        $object->expects(self::once())
            ->method('isWritable')
            ->will(self::returnValue(true));

        return [
            'directory and file valid' => [$rule, $this->getFixtureDirectory().'/valid-image.png'],
            'directory and file invalid' => [$rule, $this->getFixtureDirectory().'/invalid-image.png'],
            'instance SplFileInfo' => [$rule, $object],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Writable();
        $object = $this->createMock('SplFileInfo');
        $object->expects(self::once())
            ->method('isWritable')
            ->will(self::returnValue(false));

        return [
            'directory and fake file' => [$rule, '/path/of/a/valid/writable/file.txt'],
            'false file' => [$rule, 'new-file.txt'],
            'splFileInfo' => [$rule, $object],
            'integer' => [$rule, 123456],
            'float' => [$rule, 1.1111],
            'instancie stdClass' => [$rule, new stdClass()],
            'array empty' => [$rule, []],
        ];
    }
}
