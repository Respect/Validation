--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\LanguageCodeException;
use Respect\Validation\Validator as v;

try {
    v::languageCode('alpha-3')->check('pt');
} catch (LanguageCodeException $e) {
    echo $e->getMainMessage() . PHP_EOL;
}

try {
    v::languageCode()->assert('eng');
} catch (AllOfException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::languageCode())->assert('en');
} catch (AllOfException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::languageCode())->check('pt');
} catch (LanguageCodeException $e) {
    echo $e->getMainMessage() . PHP_EOL;
}

?>
--EXPECTF--
"pt" must be a valid language
- "eng" must be a valid language
- "en" must not be a valid language
"pt" must not be a valid language
