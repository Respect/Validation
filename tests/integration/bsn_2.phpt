--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BsnException;
use Respect\Validation\Validator as v;

try {
    v::bsn()->check('acb');
} catch (BsnException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"acb" must be a BSN
