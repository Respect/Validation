--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\SlugException;
use Respect\Validation\Validator as v;

try {
    v::not(v::slug())->check('good-and-valid-slug');
} catch (SlugException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"good-and-valid-slug" must not be a valid slug
