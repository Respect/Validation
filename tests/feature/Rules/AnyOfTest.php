<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default: fail, fail', expectAll(
    fn() => v::anyOf(v::intType(), v::negative())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass at least one of the rules
      - "string" must be an integer
      - "string" must be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass at least one of the rules',
        'intType' => '"string" must be an integer',
        'negative' => '"string" must be a negative number',
    ],
));

test('Inverted: pass, pass', expectAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative()))->assert(-1),
    '-1 must not be an integer',
    <<<'FULL_MESSAGE'
    - -1 must pass at least one of the rules
      - -1 must not be an integer
      - -1 must not be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '-1 must pass at least one of the rules',
        'intType' => '-1 must not be an integer',
        'negative' => '-1 must not be a negative number',
    ],
));

test('Inverted: pass, pass, fail', expectAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative(), v::stringType()))->assert(-1),
    '-1 must not be an integer',
    <<<'FULL_MESSAGE'
    - -1 must pass at least one of the rules
      - -1 must not be an integer
      - -1 must not be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '-1 must pass at least one of the rules',
        'intType' => '-1 must not be an integer',
        'negative' => '-1 must not be a negative number',
    ],
));
