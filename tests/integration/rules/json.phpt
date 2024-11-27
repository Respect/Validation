--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::json()->check(false));
exceptionMessage(static fn() => v::not(v::json())->check('{"foo": "bar", "number":1}'));
exceptionFullMessage(static fn() => v::json()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::json())->assert('{}'));
?>
--EXPECT--
`false` must be a valid JSON string
"{\"foo\": \"bar\", \"number\":1}" must not be a valid JSON string
- `stdClass {}` must be a valid JSON string
- "{}" must not be a valid JSON string
