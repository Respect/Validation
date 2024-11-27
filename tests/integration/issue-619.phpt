--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::instance(stdClass::class)->setTemplate('invalid object')->assert('test'));
?>
--EXPECT--
invalid object
