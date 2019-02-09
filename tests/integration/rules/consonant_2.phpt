--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Validator as v;

try {
    v::consonant()->check('top nos falsetes');
} catch (ConsonantException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"top nos falsetes" must contain only consonants
