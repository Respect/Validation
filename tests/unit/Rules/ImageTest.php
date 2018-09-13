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

use finfo;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Image
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ImageTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Image();

        return [
            [$rule, $this->getFixtureDirectory().'/valid-image.gif'],
            [$rule, $this->getFixtureDirectory().'/valid-image.jpg'],
            [$rule, $this->getFixtureDirectory().'/valid-image.png'],
            [$rule, new SplFileInfo($this->getFixtureDirectory().'/valid-image.gif')],
            [$rule, new SplFileInfo($this->getFixtureDirectory().'/valid-image.jpg')],
            [$rule, new SplFileObject($this->getFixtureDirectory().'/valid-image.png')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Image();

        return [
            [$rule, $this->getFixtureDirectory().'/invalid-image.png'],
            [$rule, 'asdf'],
            [$rule, 1],
            [$rule, true],
        ];
    }

    /**
     * @test
     */
    public function shouldValidateWithDefinedInstanceOfFileInfo(): void
    {
        $input = $this->getFixtureDirectory().'/valid-image.gif';

        $finfo = $this->createMock(finfo::class);
        $finfo
            ->expects(self::once())
            ->method('file')
            ->with($input)
            ->will(self::returnValue('image/gif'));

        $rule = new Image($finfo);

        self::assertTrue($rule->validate($input));
    }
}
