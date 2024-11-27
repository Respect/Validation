--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::languageCode()->check(null));
exceptionMessage(static fn() => v::not(v::languageCode())->check('pt'));
exceptionFullMessage(static fn() => v::languageCode()->assert('por'));
exceptionFullMessage(static fn() => v::not(v::languageCode())->assert('en'));
?>
--EXPECT--
`null` must be a valid language code
"pt" must not be a valid language code
- "por" must be a valid language code
- "en" must not be a valid language code
