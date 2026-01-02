<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchFullMessage(
    fn() => v::templated(v::callback('is_string')->between(1, 2), '{{subject}} is not tasty')->assert('something'),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "something" is not tasty
          - "something" must be between 1 and 2
        FULL_MESSAGE),
));
