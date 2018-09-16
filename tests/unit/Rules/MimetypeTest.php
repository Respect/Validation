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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Mimetype
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Mimetype1Test extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $splFileInfo = new SplFileInfo($this->getFixtureDirectory().'/valid-image.png');

        return [
            [new Mimetype('image/png', new finfo(FILEINFO_MIME_TYPE)), $splFileInfo],
            [new Mimetype('image/gif', new finfo(FILEINFO_MIME_TYPE)), $this->getFixtureDirectory().'/valid-image.gif'],
            [new Mimetype('image/png'), $this->getFixtureDirectory().'/valid-image.png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $splFileInfo = new SplFileInfo($this->getFixtureDirectory().'/valid-image.png');

        return [
            [new Mimetype('image/png'), $this->getFixtureDirectory().'/invalid-image.png'],
            [new Mimetype('image/gif'), $this->getFixtureDirectory().'/valid-image.png'],
            [new Mimetype('image/gif'), $splFileInfo],
            [new Mimetype('image/png', new finfo(FILEINFO_MIME_TYPE)), $this->getFixtureDirectory().'/invalid-image.png'],
            [new Mimetype('image/gif', new finfo(FILEINFO_MIME_TYPE)), $this->getFixtureDirectory().'/valid-image.png'],
            [new Mimetype('image/gif', new finfo(FILEINFO_MIME_TYPE)), $splFileInfo],
            [new Mimetype('application/octet-stream'), __DIR__],
            [new Mimetype('application/octet-stream'), [__FILE__]],
        ];
    }
}
