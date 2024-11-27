--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::charset('ASCII')->check('açaí'));
exceptionMessage(static fn() => v::not(v::charset('UTF-8'))->check('açaí'));
exceptionFullMessage(static fn() => v::charset('ASCII')->assert('açaí'));
exceptionFullMessage(static fn() => v::not(v::charset('UTF-8'))->assert('açaí'));
?>
--EXPECT--
"açaí" must be in the `["ASCII"]` charset
"açaí" must not be in the `["UTF-8"]` charset
- "açaí" must be in the `["ASCII"]` charset
- "açaí" must not be in the `["UTF-8"]` charset
