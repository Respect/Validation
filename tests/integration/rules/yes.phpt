--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\YesException;
use Respect\Validation\Validator as v;

try {
    v::not(v::yes())->check('Yes');
} catch (YesException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::yes()->check('si');
} catch (YesException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::yes())->assert('Yes');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::yes()->assert('si');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"Yes" is considered as "Yes"
"si" is not considered as "Yes"
- "Yes" is considered as "Yes"
- "si" is not considered as "Yes"
