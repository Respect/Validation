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
use SplFileInfo;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\File
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FileTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new File();
        $splFileInfo = new SplFileInfo(__FILE__);
        $object = $this->createMock('SplFileInfo');
        $object->expects(self::once())
            ->method('isFile')
            ->will(self::returnValue(true));

        return [
            '__FILE__' => [$rule, __FILE__],
            'SplFileInfo' => [$rule, $splFileInfo],
            'SplFileInfo (Mock)' => [$rule, $object],
            'valid-image.png' => [$rule, $this->getFixtureDirectory().'/valid-image.png'],
            'invalid-image.png' => [$rule, $this->getFixtureDirectory().'/invalid-image.png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new File();

        return [
            '__DIR__' => [$rule, __DIR__],
            'stdClass' => [$rule, new stdClass()],
            '[]' => [$rule, []],
            'a' => [$rule, 'a'],
            '123' => [$rule, 123],
            '1.222' => [$rule, 1.222],
        ];
    }
}
