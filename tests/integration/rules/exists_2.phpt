--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ExistsException;

try {
    v::exists()->check('/path/of/a/non-existent/file');
} catch (ExistsException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"/path/of/a/non-existent/file" must exists

