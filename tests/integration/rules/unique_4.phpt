--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\UniqueException;
use Respect\Validation\Validator as v;

try {
    v::unique()->check([1, 2, 3, 1]);
} catch (UniqueException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
{ 1, 2, 3, 1 } must not contain duplicates
