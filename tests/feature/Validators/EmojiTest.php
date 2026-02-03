<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::emoji()->assert('☎︎'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"☎︎" must be an emoji')
        ->and($fullMessage)->toBe('- "☎︎" must be an emoji')
        ->and($messages)->toBe(['emoji' => '"☎︎" must be an emoji']),
));

test('inverted template', catchAll(
    fn() => v::not(v::emoji())->assert('🐼'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"🐼" must not be an emoji')
        ->and($fullMessage)->toBe('- "🐼" must not be an emoji')
        ->and($messages)->toBe(['notEmoji' => '"🐼" must not be an emoji']),
));
