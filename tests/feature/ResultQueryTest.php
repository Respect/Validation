<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('findByPath with nested keys', function (): void {
    $validator = v::key('user', v::key('email', v::email()))
        ->key('items', v::each(v::positive()));

    $result = $validator->validate([
        'user' => ['email' => 'invalid'],
        'items' => [10, -5, 20],
    ]);

    $emailResult = $result->findByPath('user.email');
    expect()
        ->and($emailResult)->not->toBeNull()
        ->and($emailResult?->hasFailed())->toBeTrue()
        ->and($emailResult?->getMessage())->toBe('`.user.email` must be a valid email address');
});

test('findByPath with array index', function (): void {
    $validator = v::key('items', v::each(v::positive()));

    $result = $validator->validate([
        'items' => [10, -5, 20],
    ]);

    $itemResult = $result->findByPath('items.1');
    expect()
        ->and($itemResult)->not->toBeNull()
        ->and($itemResult?->hasFailed())->toBeTrue()
        ->and($itemResult?->getMessage())->toBe('`.items.1` must be a positive number');
});

test('findByName with named validator', function (): void {
    $result = v::named('User Email', v::email())->validate('bad');

    $namedResult = $result->findByName('User Email');
    expect()
        ->and($namedResult)->not->toBeNull()
        ->and($namedResult?->hasFailed())->toBeTrue()
        ->and($namedResult?->getMessage())->toBe('User Email must be a valid email address');
});

test('findById with validator id', function (): void {
    $result = v::stringType()->email()->validate(123);

    $stringResult = $result->findById('stringType');
    expect()
        ->and($stringResult)->not->toBeNull()
        ->and($stringResult?->hasFailed())->toBeTrue()
        ->and($stringResult?->getMessage())->toBe('123 must be a string');
});

test('findByPath returns null when path not found', function (): void {
    $result = v::key('user', v::email())->validate(['user' => 'bad']);

    expect($result->findByPath('nonexistent'))->toBeNull();
});

test('findByName returns null when name not found', function (): void {
    $result = v::email()->validate('bad');

    expect($result->findByName('Nonexistent'))->toBeNull();
});

test('findById returns null when id not found', function (): void {
    $result = v::email()->validate('bad');

    expect($result->findById('nonexistent'))->toBeNull();
});
