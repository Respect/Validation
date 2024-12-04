--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::charset('ASCII')->assert('açaí'));
exceptionMessage(static fn() => v::not(v::charset('UTF-8'))->assert('açaí'));
exceptionFullMessage(static fn() => v::charset('ASCII')->assert('açaí'));
exceptionFullMessage(static fn() => v::not(v::charset('UTF-8'))->assert('açaí'));
?>
--EXPECT--
"açaí" must only contain characters from the `["ASCII"]` charset
"açaí" must not contain any characters from the `["UTF-8"]` charset
- "açaí" must only contain characters from the `["ASCII"]` charset
- "açaí" must not contain any characters from the `["UTF-8"]` charset