--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LanguageCodeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::languageCode()->check(null);
} catch (LanguageCodeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::languageCode())->check('pt');
} catch (LanguageCodeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::languageCode()->assert('por');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::languageCode())->assert('en');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
`NULL` must be a valid ISO 639 "alpha-2" language code
"pt" must not be a valid ISO 639 "alpha-2" language code
- "por" must be a valid ISO 639 "alpha-2" language code
- "en" must not be a valid ISO 639 "alpha-2" language code
