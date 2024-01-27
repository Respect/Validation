--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::languageCode()->check(null));
exceptionMessage(static fn() => v::not(v::languageCode())->check('pt'));
exceptionFullMessage(static fn() => v::languageCode()->assert('por'));
exceptionFullMessage(static fn() => v::not(v::languageCode())->assert('en'));
?>
--EXPECT--
`NULL` must be a valid ISO 639 "alpha-2" language code
"pt" must not be a valid ISO 639 "alpha-2" language code
- "por" must be a valid ISO 639 "alpha-2" language code
- "en" must not be a valid ISO 639 "alpha-2" language code
