<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Stringifier\Quoters\StandardQuoter;
use Respect\Validation\Message\ValidationStringifier;

test('Should return `unknown` when cannot stringify value', function (): void {
    $resource = tmpfile();
    fclose($resource);

    $stringifier = new ValidationStringifier(new StandardQuoter(ValidationStringifier::MAXIMUM_LENGTH));

    expect($stringifier->stringify($resource, 0))->toBe('`unknown`');
});
