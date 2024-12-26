<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Message\StandardStringifier;

test('Should return `unknown` when cannot stringify value', function (): void {
    $resource = tmpfile();
    fclose($resource);

    $stringifier = new StandardStringifier();

    expect($stringifier->stringify($resource, 0))->toBe('`unknown`');
});
