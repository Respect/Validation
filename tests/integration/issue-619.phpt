--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Rules\Instance;

exceptionMessage(static function (): void {
    (new Instance('stdClass'))->setTemplate('invalid object')->assert('test');
});
?>
--EXPECT--
invalid object
