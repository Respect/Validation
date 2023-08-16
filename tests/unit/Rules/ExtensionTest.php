<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Extension
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ExtensionTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'txt' => [new Extension('txt'), 'filename.txt'],
            'jpg' => [new Extension('jpg'), 'filename.jpg'],
            'inc' => [new Extension('inc'), 'filename.inc'],
            'bz2' => [new Extension('bz2'), 'filename.foo.bar.bz2'],
            'php' => [new Extension('php'), new SplFileInfo(__FILE__)],
            'png' => [new Extension('png'), $this->getFixtureDirectory() . 'valid-image.png'],
            'gif' => [new Extension('gif'), $this->getFixtureDirectory() . 'valid-image.gif'],
            'file-invalid' => [new Extension('png'), $this->getFixtureDirectory() . 'invalid-image.png'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'jpg' => [new Extension('jpg'), 'filename.txt'],
            'txt' => [new Extension('txt'), 'filename.jpg'],
            'bz2' => [new Extension('bz2'), 'filename.inc.php'],
            'js' => [new Extension('js'), 'filename.foo.bar.bz2'],
            'php' => [new Extension('php'), [__FILE__]],
            'mp3' => [new Extension('mp3'), 999],
            'gif' => [new Extension('gif'), ''],
            'doc' => [new Extension('doc'), null],
        ];
    }
}
