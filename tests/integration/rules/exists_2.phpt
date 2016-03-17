--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ExistsException;
use Respect\Validation\Validator as v;

try {
    v::exists()->check('/path/of/a/non-existent/file');
} catch (ExistsException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"/path/of/a/non-existent/file" must exists

