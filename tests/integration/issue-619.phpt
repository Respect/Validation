--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Wojciech Frącz <fraczwojciech@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Rules\Instance;

exceptionMessage(static function () {
    (new Instance('stdClass'))->setTemplate('invalid object')->assert('test');
});
?>
--EXPECT--
invalid object
