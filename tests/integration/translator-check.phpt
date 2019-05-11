--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
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

try {
    Validator::stringType()->length(2, 15)->check(0);
} catch (ValidationException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECT--
0 deve ser do tipo string
