--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::regex('/^w+$/')->assert('w poiur'));
exceptionMessage(static fn() => v::not(v::regex('/^[a-z]+$/'))->assert('wpoiur'));
exceptionFullMessage(static fn() => v::regex('/^w+$/')->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur'));
?>
--EXPECT--
"w poiur" must match the pattern `/^w+$/`
"wpoiur" must not match the pattern `/^[a-z]+$/`
- `stdClass {}` must match the pattern `/^w+$/`
- "wPoiur" must not match the pattern `/^[a-z]+$/i`