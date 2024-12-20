<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;

beforeEach(function (): void {
    $this->root = vfsStream::setup();

    $this->file2Kb = vfsStream::newFile('2kb.txt')
        ->withContent(LargeFileContent::withKilobytes(2))
        ->at($this->root);

    $this->file2Mb = vfsStream::newFile('3mb.txt')
        ->withContent(LargeFileContent::withMegabytes(3))
        ->at($this->root);
});

test('Default', expectAll(
    fn() => v::size('KB', v::lessThan(2))->assert($this->file2Kb->url()),
    'The size in kilobytes of "vfs://root/2kb.txt" must be less than 2',
    '- The size in kilobytes of "vfs://root/2kb.txt" must be less than 2',
    ['sizeLessThan' => 'The size in kilobytes of "vfs://root/2kb.txt" must be less than 2']
));

test('Wrong type', expectAll(
    fn() => v::size('KB', v::lessThan(2))->assert(new stdClass()),
    '`stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface',
    '- `stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface',
    ['sizeLessThan' => '`stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface']
));

test('Inverted', expectAll(
    fn() => v::size('MB', v::not(v::equals(3)))->assert($this->file2Mb->url()),
    'The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3',
    '- The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3',
    ['sizeNotEquals' => 'The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3']
));

test('Wrapped with name', expectAll(
    fn() => v::size('KB', v::lessThan(2)->setName('Wrapped'))->assert($this->file2Kb->url()),
    'The size in kilobytes of Wrapped must be less than 2',
    '- The size in kilobytes of Wrapped must be less than 2',
    ['sizeLessThan' => 'The size in kilobytes of Wrapped must be less than 2']
));

test('Wrapper with name', expectAll(
    fn() => v::size('KB', v::lessThan(2))->setName('Wrapper')->assert($this->file2Kb->url()),
    'The size in kilobytes of Wrapper must be less than 2',
    '- The size in kilobytes of Wrapper must be less than 2',
    ['sizeLessThan' => 'The size in kilobytes of Wrapper must be less than 2']
));

test('Chained wrapped rule', expectAll(
    fn() => v::size('KB', v::between(5, 7)->odd())->assert($this->file2Kb->url()),
    'The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for "vfs://root/2kb.txt"
      - The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7
      - The size in kilobytes of "vfs://root/2kb.txt" must be an odd number
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for "vfs://root/2kb.txt"',
        'sizeBetween' => 'The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7',
        'sizeOdd' => 'The size in kilobytes of "vfs://root/2kb.txt" must be an odd number',
    ]
));
