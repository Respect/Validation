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
use const FILEINFO_MIME_TYPE;
use const PHP_INT_MAX;
use function random_int;
use function tmpfile;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Mimetype
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MimetypeTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldValidateWithDefinedFinfoInstance(): void
    {
        $mimetype = 'application/octet-stream';
        $filename = $this->getFixtureDirectory().'/valid-image.png';

        $fileInfoMock = $this
            ->getMockBuilder(finfo::class)
            ->disableOriginalConstructor()
            ->setMethods(['file'])
            ->getMock();

        $fileInfoMock
            ->expects(self::once())
            ->method('file')
            ->with($filename, FILEINFO_MIME_TYPE)
            ->will(self::returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        self::assertTrue($rule->validate($filename));
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'image/png' => [new Mimetype('image/png'), $this->getFixtureDirectory().'/valid-image.png'],
            'image/gif' => [new Mimetype('image/gif'), $this->getFixtureDirectory().'/valid-image.gif'],
            'image/jpeg' => [new Mimetype('image/jpeg'), $this->getFixtureDirectory().'/valid-image.jpg'],
            'text/plain' => [new Mimetype('text/plain'), $this->getFixtureDirectory().'/executable'],
            'SplFileInfo' => [new Mimetype('image/png'), new SplFileInfo($this->getFixtureDirectory().'/valid-image.png')],
            'SplFileObject' => [new Mimetype('image/png'), new SplFileObject($this->getFixtureDirectory().'/valid-image.png')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'invalid file' => [new Mimetype('image/png'), $this->getFixtureDirectory().'/invalid-image.png'],
            'mismatch' => [new Mimetype('image/gif'), $this->getFixtureDirectory().'/valid-image.png'],
            'directory' => [new Mimetype('application/octet-stream'), __DIR__],
            'boolean' => [new Mimetype('application/octet-stream'), true],
            'array' => [new Mimetype('application/octet-stream'), [__FILE__]],
            'integer' => [new Mimetype('application/octet-stream'), random_int(1, PHP_INT_MAX)],
            'float' => [new Mimetype('application/octet-stream'), random_int(1, 9) / 10],
            'null' => [new Mimetype('application/octet-stream'), null],
            'resource' => [new Mimetype('application/octet-stream'), tmpfile()],
        ];
    }
}
