<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Test\SmokeTestProvider;

test('Can be serialized and unserialized', function ($validator, $input): void {
    expect(
        unserialize(serialize($validator))->evaluate($input)->hasPassed,
    )->toBeTrue();
})->with(fn(): Generator => (new class {
    use SmokeTestProvider {
        provideValidatorInput as public __invoke;
    }
})());
