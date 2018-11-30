--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Validator as v;

try {
    v::consonant()->check('top nos falsetes');
} catch (ConsonantException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"top nos falsetes" must contain only consonants
