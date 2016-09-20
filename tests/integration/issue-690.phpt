--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$input = [
    'contact1' => [
        'daymark' => 'ffesfewf2232313123212',
        'building' => [
            'enable' => 'd',
            'blank' => 'ffesfewf2232313123212',
            'powerdown' => '5',
            'powerup' => 'wdwdwf',
        ],
    ],
    'contact2' => [
        'name' => 'wd',
        'daymark' => 'ffesfewf2232313123212',
        'building' => [
            'enable' => '1',
            'blank' => '1',
            'powerdown' => '1',
            'powerup' => '1',
        ],
    ],
];

try {
    v::create()
        ->each(
            v::create()
                ->key('name', v::length(1, 50))
                ->key('daymark', v::length(1, 50))
                ->key(
                    'building',
                    v::create()
                        ->key('enable', v::length(2, 50))
                        ->key('time', v::length(2, 50))
                        ->key('powerdown', v::length(2, 50))
                        ->key('powerup', v::length(2, 50))
                )
        )
        ->assert($input);
} catch (NestedValidationException $exception) {
    print_r(array_filter($exception->findMessages([
        'each.name' => 'Center name',
        'each.building.enable' => 'Center time',
        'each.building.powerdown' => 'Center time',
    ])));
}
?>
--EXPECTF--
Array
(
    [each_name] => Center name
    [each_building_enable] => Center time
    [each_building_powerdown] => Center time
)
