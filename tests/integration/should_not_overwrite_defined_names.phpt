--FILE--
<?php

require 'vendor/autoload.php';

$input = ['email' => 'not an email'];

exceptionMessage(static fn() => v::key('email', v::email()->setName('Email'))->setName('Foo')->assert($input));

// This is a trick thing: the call to `setName()` here seems to be the one
// from the `Key` rule but it's actually from the `Validator`.
exceptionMessage(static fn() => v::key('email', v::email())->setName('Email')->assert($input));

exceptionMessage(static fn() => v::key('email', v::email())->assert($input));
?>
--EXPECT--
Email must be valid email
email must be valid email
email must be valid email
