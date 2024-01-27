--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::json()->check(false));
exceptionMessage(static fn() => v::not(v::json())->check('{"foo": "bar", "number":1}'));
exceptionFullMessage(static fn() => v::json()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::json())->assert('{}'));
?>
--EXPECT--
`FALSE` must be a valid JSON string
"{\"foo\": \"bar\", \"number\":1}" must not be a valid JSON string
- `[object] (stdClass: { })` must be a valid JSON string
- "{}" must not be a valid JSON string
