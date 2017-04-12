--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$input = [
    'organization' => [
        'name' => 'N',
        'address' => 'A',
    ],
    'contact' => [
        'name' => 'wd',
        'email' => 'ffesfewf2232313123212',
        'password' => ' ',
        'position' => 'wdwdwf',
        'number' => '£"!@£;21#£:"!:£~!":£\'21;',
    ],
];

try {
    v::create()
        ->key(
            'organization',
            v::create()
                ->key('name', v::length(2, 50)->notEmpty())
                ->key('address', v::length(2, 50)->notEmpty())
        )
        ->keyNested('contact.name', v::length(1, 50)->notEmpty())
        ->keyNested('contact.email', v::email()->notEmpty())
        ->keyNested('contact.password', v::length(3, 100)->notEmpty())
        ->keyNested('contact.position', v::length(1, 100)->notEmpty())
        ->keyNested('contact.number', v::phone()->notEmpty())
        ->assert($input);
} catch (NestedValidationException $exception) {
    print_r(array_filter($exception->findMessages([
        'organization.name' => 'Center name',
        'organization.address' => 'Center address',
        'contact.name' => 'Contact name',
        'contact.password' => 'Contact name',
        'contact.position' => 'Contact name',
        'contact.number' => 'Contact name',
        'contact.email' => 'Contact name',
    ])));
}
?>
--EXPECTF--
Array
(
    [organization_name] => Center name
    [organization_address] => Center address
    [contact_password] => Contact name
    [contact_number] => Contact name
    [contact_email] => Contact name
)
