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

test('Default', catchAll(
    fn() => v::size('KB', v::lessThan(2))->assert($this->file2Kb->url()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The size in kilobytes of "vfs://root/2kb.txt" must be less than 2')
        ->and($fullMessage)->toBe('- The size in kilobytes of "vfs://root/2kb.txt" must be less than 2')
        ->and($messages)->toBe(['sizeLessThan' => 'The size in kilobytes of "vfs://root/2kb.txt" must be less than 2']),
));

test('Wrong type', catchAll(
    fn() => v::size('KB', v::lessThan(2))->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface')
        ->and($fullMessage)->toBe('- `stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface')
        ->and($messages)->toBe(['sizeLessThan' => '`stdClass {}` must be a filename or an instance of SplFileInfo or a PSR-7 interface']),
));

test('Inverted', catchAll(
    fn() => v::size('MB', v::not(v::equals(3)))->assert($this->file2Mb->url()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3')
        ->and($fullMessage)->toBe('- The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3')
        ->and($messages)->toBe(['sizeNotEquals' => 'The size in megabytes of "vfs://root/3mb.txt" must not be equal to 3']),
));

test('Wrapped with name', catchAll(
    fn() => v::size('KB', v::named(v::lessThan(2), 'Wrapped'))->assert($this->file2Kb->url()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The size in kilobytes of Wrapped must be less than 2')
        ->and($fullMessage)->toBe('- The size in kilobytes of Wrapped must be less than 2')
        ->and($messages)->toBe(['sizeLessThan' => 'The size in kilobytes of Wrapped must be less than 2']),
));

test('Wrapper with name', catchAll(
    fn() => v::named(v::size('KB', v::lessThan(2)), 'Wrapper')->assert($this->file2Kb->url()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The size in kilobytes of Wrapper must be less than 2')
        ->and($fullMessage)->toBe('- The size in kilobytes of Wrapper must be less than 2')
        ->and($messages)->toBe(['sizeLessThan' => 'The size in kilobytes of Wrapper must be less than 2']),
));

test('Chained wrapped rule', catchAll(
    fn() => v::size('KB', v::between(5, 7)->odd())->assert($this->file2Kb->url()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "vfs://root/2kb.txt" must pass all the rules
          - The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7
          - The size in kilobytes of "vfs://root/2kb.txt" must be an odd number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"vfs://root/2kb.txt" must pass all the rules',
            'sizeBetween' => 'The size in kilobytes of "vfs://root/2kb.txt" must be between 5 and 7',
            'sizeOdd' => 'The size in kilobytes of "vfs://root/2kb.txt" must be an odd number',
        ]),
));
