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

use Psr\Http\Message\StreamInterface;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;
use stdClass;

use function chmod;

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
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Writable();
        $filename = $this->getFixtureDirectory() . '/valid-image.png';

        return [
            'writable file' => [$sut, $filename],
            'writable directory' => [$sut, $this->getFixtureDirectory()],
            'writable SplFileInfo file' => [$sut, new SplFileInfo($filename)],
            'writable SplFileObject file' => [$sut, new SplFileObject($filename)],
            'writable PSR-7 stream' => [$sut, $this->createPsr7Stream(true)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Writable();
        $filename = $this->getFixtureDirectory() . '/non-writable';

        $this->changeFileModeToUnwritable($filename);

        return [
            'unwritable PSR-7 stream' => [$rule, $this->createPsr7Stream(false)],
            'unwritable filename' => [$rule, $filename],
            'unwritable SplFileInfo file' => [$rule, new SplFileInfo($filename)],
            'unwritable SplFileObject file' => [$rule, new SplFileObject($filename)],
            'invalid filename' => [$rule, '/path/of/a/valid/writable/file.txt'],
            'empty string' => [$rule, ''],
            'boolean true' => [$rule, true],
            'boolean false' => [$rule, false],
            'integer' => [$rule, 123456],
            'float' => [$rule, 1.1111],
            'instance of stdClass' => [$rule, new stdClass()],
            'array' => [$rule, []],
        ];
    }

    private function createPsr7Stream(bool $isWritable): StreamInterface
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())->method('isWritable')->willReturn($isWritable);

        return $stream;
    }

    private function changeFileModeToUnwritable(string $filename): void
    {
        chmod($filename, 0555);
    }
}
