--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\LanguageCodeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::languageCode()->check(null);
} catch (LanguageCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::languageCode()->assert('por');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::languageCode())->check('pt');
} catch (LanguageCodeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::languageCode())->assert('en');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::languageCode('alpha-4');
} catch (ComponentException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

?>
--EXPECTF--
`NULL` must be a valid language code set for ISO 639
- "por" must be a valid language code set for ISO 639
"pt" must not be a valid language code set for ISO 639
- "en" must not be a valid language code set for ISO 639
"alpha-4" is not a valid language set for ISO 639
