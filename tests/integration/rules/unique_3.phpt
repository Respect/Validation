--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\UniqueException;
use Respect\Validation\Validator as v;

try {
    v::unique()->check('test');
} catch (UniqueException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"test" must not contain duplicates
