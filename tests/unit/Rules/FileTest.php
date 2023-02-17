<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;
use stdClass;

use const PHP_INT_MAX;

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
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new File();

        return [
            'filename' => [$sut, __FILE__],
            'SplFileInfo' => [$sut, new SplFileInfo($this->getFixtureDirectory() . '/valid-image.png')],
            'SplFileObject' => [$sut, new SplFileObject($this->getFixtureDirectory() . '/invalid-image.png')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new File();

        return [
            'directory' => [$sut, __DIR__],
            'object' => [$sut, new stdClass()],
            'array' => [$sut, []],
            'invalid filename' => [$sut, 'not-a-file-at-all'],
            'integer' => [$sut, PHP_INT_MAX],
            'float' => [$sut, 1.222],
            'boolean true' => [$sut, true],
            'boolean false' => [$sut, false],
        ];
    }
}
