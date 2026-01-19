<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::videoUrl()->assert('example.com'),
    fn(string $message) => expect($message)->toBe('"example.com" must be a valid video URL'),
));

test('Scenario #2', catchMessage(
    fn() => v::videoUrl('YouTube')->assert('example.com'),
    fn(string $message) => expect($message)->toBe('"example.com" must be a valid YouTube video URL'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::videoUrl())->assert('https://player.vimeo.com/video/7178746722'),
    fn(string $message) => expect($message)->toBe('"https://player.vimeo.com/video/7178746722" must not be a valid video URL'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::videoUrl('YouTube'))->assert('https://www.youtube.com/embed/netHLn9TScY'),
    fn(string $message) => expect($message)->toBe('"https://www.youtube.com/embed/netHLn9TScY" must not be a valid YouTube video URL'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::videoUrl()->assert('example.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "example.com" must be a valid video URL'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::videoUrl('Vimeo')->assert('example.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "example.com" must be a valid Vimeo video URL'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::videoUrl())->assert('https://youtu.be/netHLn9TScY'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "https://youtu.be/netHLn9TScY" must not be a valid video URL'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::videoUrl('Vimeo'))->assert('https://vimeo.com/71787467'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "https://vimeo.com/71787467" must not be a valid Vimeo video URL'),
));
