--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EachException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::each(v::dateTime())->check(null);
} catch (EachException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::each(v::dateTime()))->check(['2018-10-10']);
} catch (EachException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::each(v::dateTime())->assert(null);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::each(v::dateTime()))->assert(['2018-10-10']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
Each item in `NULL` must be valid
Each item in `{ "2018-10-10" }` must not validate
- Each item in `NULL` must be valid
- Each item in `{ "2018-10-10" }` must not validate
