--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MinimumAgeException;
use Respect\Validation\Validator as v;

try {
    v::MinimumAge(12)->check(new DateTime('2010-10-12'));
} catch (MinimumAgeException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
The age must be 12 years or more.