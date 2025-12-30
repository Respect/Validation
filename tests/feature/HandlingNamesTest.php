<?php

declare(strict_types=1);

$input = ['email' => 'not an email'];

test('Results with a defined name cannot be overwritten by another name', catchMessage(
    fn() => v::key('email', v::email()->setName('Email'))->setName('Foo')->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address'),
));

test('Defining a name to a result with a path will add the path to the name', catchMessage(
    fn() => v::key('email', v::email())->setName('Email')->assert($input),
    fn(string $message) => expect($message)->toBe('`.email` (<- Email) must be a valid email address'),
));

test('Results with a defined name will not be affected by a path', catchMessage(
    fn() => v::key('email', v::email()->setName('Email'))->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address'),
));

test('Not defining a name to a result with a path will display the path', catchMessage(
    fn() => v::key('email', v::email())->assert($input),
    fn(string $message) => expect($message)->toBe('`.email` must be a valid email address'),
));
