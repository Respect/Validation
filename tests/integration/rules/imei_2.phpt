--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ImeiException;
use Respect\Validation\Validator as v;

try {
    v::imei()->check('497511659092062');
} catch (ImeiException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::imei()->assert([]);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"497511659092062" must be a valid IMEI
- `{ }` must be a valid IMEI
