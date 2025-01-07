<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;

require_once 'vendor/autoload.php';

$baseError = 'Calling size() with scalar values has been deprecated, and will not be allowed in the next major version. ';
beforeEach(function (): void {
    $root = vfsStream::setup();
    $this->filename = vfsStream::newFile('filename.blob')
        ->withContent(LargeFileContent::withKilobytes(2))
        ->at($root)
        ->url();
});

test('Greater than, only integer', expectMessageAndDeprecation(
    fn() => v::size(6042, null)->assert($this->filename),
    'The size in bytes of "vfs://root/filename.blob" must be greater than or equal to 6042',
    $baseError . 'Use size(\'B\', greaterThanOrEqual(6042)) instead.',
));

test('Greater than, with storage unit', expectMessageAndDeprecation(
    fn() => v::size('2.5MB', null)->assert($this->filename),
    'The size in megabytes of "vfs://root/filename.blob" must be greater than or equal to 2.5',
    $baseError . 'Use size(\'MB\', greaterThanOrEqual(2.5)) instead.',
));

test('Less than, only integer', expectMessageAndDeprecation(
    fn() => v::size(null, 526)->assert($this->filename),
    'The size in bytes of "vfs://root/filename.blob" must be less than or equal to 526',
    $baseError . 'Use size(\'B\', lessThanOrEqual(526)) instead.',
));

test('Less than, with storage unit', expectMessageAndDeprecation(
    fn() => v::size(null, '1KB')->assert($this->filename),
    'The size in kilobytes of "vfs://root/filename.blob" must be less than or equal to 1',
    $baseError . 'Use size(\'KB\', lessThanOrEqual(1)) instead.',
));

test('Equal, only integer', expectMessageAndDeprecation(
    fn() => v::size(1024, 1024)->assert($this->filename),
    'The size in bytes of "vfs://root/filename.blob" must be equal to 1024',
    $baseError . 'Use size(\'B\', equals(1024)) instead.',
));

test('Equal, with storage unit', expectMessageAndDeprecation(
    fn() => v::size('1PB', '1PB')->assert($this->filename),
    'The size in petabytes of "vfs://root/filename.blob" must be equal to 1',
    $baseError . 'Use size(\'PB\', equals(1)) instead.',
));

test('Between, only integer', expectMessageAndDeprecation(
    fn() => v::size(1, 1024)->assert($this->filename),
    'The size in bytes of "vfs://root/filename.blob" must be between 1 and 1024',
    $baseError . 'Use size(\'B\', between(1, 1024)) instead.',
));

test('Between, with storage unit', expectMessageAndDeprecation(
    fn() => v::size('1zb', '2.5zb')->assert($this->filename),
    'The size in zettabytes of "vfs://root/filename.blob" must be between 1 and 2.5',
    $baseError . 'Use size(\'ZB\', between(1, 2.5)) instead.',
));

test('Wrong storage unit', expectDeprecation(
    fn() => v::size('1jb', null),
    $baseError . 'Use size(\'JB\', greaterThanOrEqual(1)) instead.',
))->throws('"JB" is not a recognized data storage unit');

test('Missing storage unit and size', expectDeprecation(
    fn() => v::size('something', null),
    $baseError . 'Use size(\'SOMETHING\', greaterThanOrEqual("")) instead.',
))->throws('"SOMETHING" is not a recognized data storage unit');
