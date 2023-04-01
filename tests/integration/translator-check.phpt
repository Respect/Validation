--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Factory;
use Respect\Validation\Validator;

Factory::setDefaultInstance(
    (new Factory())
        ->withTranslator(static function (string $message): string {
            return [
                '{{name}} must be of type string' => '{{name}} deve ser do tipo string',
            ][$message];
        })
);

exceptionMessage(static fn() => Validator::stringType()->length(2, 15)->check(0));
?>
--EXPECT--
0 deve ser do tipo string
