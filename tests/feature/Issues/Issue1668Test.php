<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1668', catchAll(
    fn() => v::allOf(
        v::named('alpha', v::allOf(
            v::contains('quick'),
            v::contains('fox'),
        )),
        v::named('zeta', v::allOf(
            v::contains('lorem'),
            v::contains('ipsum'),
        )),
    )->assert('foo bar baz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('alpha must contain "quick"')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - "foo bar baz" must pass all the rules
              - alpha must pass all the rules
                - "foo bar baz" must contain "quick"
                - "foo bar baz" must contain "fox"
              - zeta must pass all the rules
                - "foo bar baz" must contain "lorem"
                - "foo bar baz" must contain "ipsum"
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"foo bar baz" must pass all the rules',
            0 => [
                '__root__' => 'alpha must pass all the rules',
                0 => '"foo bar baz" must contain "quick"',
                1 => '"foo bar baz" must contain "fox"',
            ],
            1 => [
                '__root__' => 'zeta must pass all the rules',
                0 => '"foo bar baz" must contain "lorem"',
                1 => '"foo bar baz" must contain "ipsum"',
            ],
        ]),
));

test('https://github.com/Respect/Validation/issues/1668 #2', catchAll(
    fn() => v::allOf(
        v::allOf(
            v::contains('quick'),
            v::contains('fox'),
        ),
        v::allOf(
            v::contains('lorem'),
            v::contains('ipsum'),
        ),
    )->assert('foo bar baz'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo bar baz" must contain "quick"')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - "foo bar baz" must pass all the rules
              - "foo bar baz" must pass all the rules
                - "foo bar baz" must contain "quick"
                - "foo bar baz" must contain "fox"
              - "foo bar baz" must pass all the rules
                - "foo bar baz" must contain "lorem"
                - "foo bar baz" must contain "ipsum"
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"foo bar baz" must pass all the rules',
            0 => [
                '__root__' => '"foo bar baz" must pass all the rules',
                0 => '"foo bar baz" must contain "quick"',
                1 => '"foo bar baz" must contain "fox"',
            ],
            1 => [
                '__root__' => '"foo bar baz" must pass all the rules',
                0 => '"foo bar baz" must contain "lorem"',
                1 => '"foo bar baz" must contain "ipsum"',
            ],
        ]),
));


test('https://github.com/Respect/Validation/issues/1668 #3', catchAll(
    fn() => v::named('match_making', v::allOf(
        v::key('couple', v::named('movies', v::allOf(
            v::key('she', v::named('vampire', v::contains('Twilight'))),
            v::key('he', v::named('heroes', v::contains('Avengers'))),
        ))),
        v::key('couple', v::named('food', v::allOf(
            v::key('she', v::named('comfort', v::contains('mac & cheese'))),
            v::key('he', v::named('junk', v::contains('nachos'))),
        ))),
    ))->assert(['couple' => ['she' => 'Gilmore Girls, soup', 'he' => 'Batman, pizza']], [
        'match_making' => 'Match Making',
        'movies' => 'Cinema',
        'food' => 'Cousine',
        'vampire' => 'She must like vampire movies',
        'heroes' => 'He must like hero movies',
        'comfort' => 'She must like comfort food',
        'junk' => 'He must like junk food',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('She must like vampire movies')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Match Making
              - Cinema
                - She must like vampire movies
                - He must like hero movies
              - Cousine
                - She must like comfort food
                - He must like junk food
            FULL_MESSAGE)
        ->and($messages)->toBe([
            'couple' => [
                0 => [
                    '__root__' => 'Cinema',
                    'she' => 'She must like vampire movies',
                    'he' => 'He must like hero movies',
                ],
                1 => [
                    '__root__' => 'Cousine',
                    'she' => 'She must like comfort food',
                    'he' => 'He must like junk food',
                ],
            ],
        ]),
));
