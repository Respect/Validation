<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\SmokeTestProvider;

test('Can be serialized and unserialized', function ($validator, $input): void {
    set_mock_is_uploaded_file_return(true);
    expect(
        unserialize(serialize($validator))->validate($input)->isValid(),
    )->toBeTrue();
})->with(fn(): Generator => (new class {
    use SmokeTestProvider {
        provideValidatorInput as public __invoke;
    }
})());
