--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
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
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::yes()->assert('si');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>

--EXPECTF--
"Yes" is considered as "Yes"
"si" is not considered as "Yes"
- "Yes" is considered as "Yes"
- "si" is not considered as "Yes"