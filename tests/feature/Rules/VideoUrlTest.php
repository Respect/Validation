<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::videoUrl()->assert('example.com'),
    '"example.com" must be a valid video URL',
));

test('Scenario #2', expectMessage(
    fn() => v::videoUrl('YouTube')->assert('example.com'),
    '"example.com" must be a valid YouTube video URL',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::videoUrl())->assert('https://player.vimeo.com/video/7178746722'),
    '"https://player.vimeo.com/video/7178746722" must not be a valid video URL',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::videoUrl('YouTube'))->assert('https://www.youtube.com/embed/netHLn9TScY'),
    '"https://www.youtube.com/embed/netHLn9TScY" must not be a valid YouTube video URL',
));

test('Scenario #5', expectFullMessage(
    fn() => v::videoUrl()->assert('example.com'),
    '- "example.com" must be a valid video URL',
));

test('Scenario #6', expectFullMessage(
    fn() => v::videoUrl('Vimeo')->assert('example.com'),
    '- "example.com" must be a valid Vimeo video URL',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::videoUrl())->assert('https://youtu.be/netHLn9TScY'),
    '- "https://youtu.be/netHLn9TScY" must not be a valid video URL',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::videoUrl('Vimeo'))->assert('https://vimeo.com/71787467'),
    '- "https://vimeo.com/71787467" must not be a valid Vimeo video URL',
));
