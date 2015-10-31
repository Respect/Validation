--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validator as v;

try {
    v::MinimumAge('L12')->check(new DateTime('2002-10-12'));
} catch (ComponentException $e) {
    echo $e->getMessage();
}

?>
--EXPECTF--
The age must be a numeric value.
