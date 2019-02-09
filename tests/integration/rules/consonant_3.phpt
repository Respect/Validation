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
    v::not(v::consonant())->check('ddd');
} catch (ConsonantException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"ddd" must not contain consonants
