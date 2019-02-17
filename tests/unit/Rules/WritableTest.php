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
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Writable();
        $filename = $this->getFixtureDirectory().'/valid-image.png';

        return [
            'writable file' => [$sut, $filename],
            'writable directory' => [$sut, $this->getFixtureDirectory()],
            'writable SplFileInfo file' => [$sut, new SplFileInfo($filename)],
            'writable SplFileObject file' => [$sut, new SplFileObject($filename)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Writable();
        $filename = $this->getFixtureDirectory().'/non-writable';

        $this->changeFileModeToUnwritable($filename);

        return [
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

    private function changeFileModeToUnwritable(string $filename): void
    {
        chmod($filename, 0555);
    }
}
