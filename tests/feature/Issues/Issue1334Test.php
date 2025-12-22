<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1334', catchAll(
    function (): void {
        v::notEmpty()->iterableType()->each(
            v::key('street', v::stringType()->notEmpty())
                ->key('region', v::stringType()->notEmpty())
                ->key('country', v::stringType()->notEmpty())
                ->keyOptional('other', v::nullOr(v::notEmpty()->stringType())),
        )->assert(
            [
                ['region' => 'Oregon', 'country' => 'USA', 'other' => 123],
                ['street' => '', 'region' => 'Oregon', 'country' => 'USA'],
                ['street' => 123, 'region' => 'Oregon', 'country' => 'USA'],
            ],
        );
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0.street` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Each item in `[["region": "Oregon", "country": "USA", "other": 123], ["street": "", "region": "Oregon", "country": "USA"], ["s ... ]` must be valid
              - `.0` must pass the rules
                - `.0.street` must be present
                - `.0.other` must pass the rules
                  - `.0.other` must be a string or must be null
              - `.1` must pass the rules
                - `.1.street` must not be empty
              - `.2` must pass the rules
                - `.2.street` must be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            'each' => [
                '__root__' => 'Each item in `[["region": "Oregon", "country": "USA", "other": 123], ["street": "", "region": "Oregon", "country": "USA"], ["s ... ]` must be valid',
                0 => [
                    '__root__' => '`.0` must pass the rules',
                    'street' => '`.0.street` must be present',
                    'other' => '`.0.other` must be a string or must be null',
                ],
                1 => '`.1.street` must not be empty',
                2 => '`.2.street` must be a string',
            ],
        ]),
));
