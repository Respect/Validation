<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1033', expectAll(
    fn() => v::each(v::equals(1))->assert(['A', 'B', 'B']),
    '"A" must be equal to 1',
    <<<'FULL_MESSAGE'
    - Each item in `["A", "B", "B"]` must be valid
      - "A" must be equal to 1
      - "B" must be equal to 1
      - "B" must be equal to 1
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `["A", "B", "B"]` must be valid',
        0 => '"A" must be equal to 1',
        1 => '"B" must be equal to 1',
        2 => '"B" must be equal to 1',
    ],
));
