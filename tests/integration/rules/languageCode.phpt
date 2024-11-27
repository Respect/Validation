--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::languageCode()->assert(null));
exceptionMessage(static fn() => v::not(v::languageCode())->assert('pt'));
exceptionFullMessage(static fn() => v::languageCode()->assert('por'));
exceptionFullMessage(static fn() => v::not(v::languageCode())->assert('en'));
?>
--EXPECT--
`null` must be a valid language code
"pt" must not be a valid language code
- "por" must be a valid language code
- "en" must not be a valid language code
