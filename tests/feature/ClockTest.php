<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

use Lcobucci\Clock\FrozenClock;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Test\Stubs\WithRelativeDate;

beforeAll(fn() => ContainerRegistry::setContainer(ContainerRegistry::createContainer([
    'respect.validation.clock' => FrozenClock::class,
])));

afterAll(fn() => ContainerRegistry::setContainer(ContainerRegistry::createContainer()));

test('A relative input lands exactly on the boundary it names', function (): void {
    $outcomes = [];
    for ($i = 0; $i < 1000; $i++) {
        $outcomes[v::dateTimeDiff('years', v::equals(7))->isValid('7 years ago')] = true;
    }

    expect($outcomes)->toBe([true => true]);
});

test('Every validator of a chain compares against the same moment', function (): void {
    $validator = v::dateTimeDiff('microseconds', v::equals(0.0))
        ->dateTimeDiff('seconds', v::equals(0))
        ->dateTimeDiff('years', v::equals(0));

    expect($validator->isValid('now'))->toBeTrue();
});

test('A relative bound is measured from the same moment as the value', function (): void {
    $validator = v::lessThanOrEqual('18 years ago');

    expect($validator->isValid('18 years ago'))->toBeTrue();
});

test('Validators declared as attributes share the moment as well', function (): void {
    expect(v::attributes()->isValid(new WithRelativeDate('7 years ago')))->toBeTrue();
});

test('The moment is taken again on every run', function (): void {
    $validator = v::dateTimeDiff('microseconds', v::equals(0.0));

    expect($validator->isValid('now'))->toBeTrue();
    usleep(1000);
    expect($validator->isValid('now'))->toBeTrue();
});
