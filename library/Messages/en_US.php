<?php
namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Exceptions\AbstractGroupedException;
use Respect\Validation\Exceptions\AlphaException;
use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Exceptions\AttributeException;
use Respect\Validation\Exceptions\BetweenException;
use Respect\Validation\Exceptions\DateException;
use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\IpException;
use Respect\Validation\Exceptions\LengthException;
use Respect\Validation\Exceptions\MaxException;
use Respect\Validation\Exceptions\MinException;
use Respect\Validation\Exceptions\NotEmptyException;

$messages = array(
    'AbstractGroupedException' => array(
        ValidationException::MODE_DEFAULT => array(
            AbstractGroupedException::NONE => 'All of the required rules must pass for {{name}}',
            AbstractGroupedException::SOME => 'These rules must pass for {{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AbstractGroupedException::NONE => 'None of there rules must pass for {{name}}',
            AbstractGroupedException::SOME => 'These rules must not pass for {{name}}',
        ),
    ),

    'AllOfException' => array(
        ValidationException::MODE_DEFAULT => array(
            AbstractGroupedException::NONE => 'All of the required rules must pass for {{name}}',
            AbstractGroupedException::SOME => 'These rules must pass for {{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AbstractGroupedException::NONE => 'None of these rules must pass for {{name}}',
            AbstractGroupedException::SOME => 'These rules must not pass for {{name}}',
        ),
    ),

    'AlnumException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only letters (a-z) and digits (0-9)',
            AlphaException::EXTRA => '{{name}} must contain only letters (a-z), digits (0-9) and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain letters (a-z) or digits (0-9)',
            AlphaException::EXTRA => '{{name}} must not contain letters (a-z), digits (0-9) or "{{additionalChars}}"',
        ),
    ),

    'AlphaException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only letters (a-z)',
            AlphaException::EXTRA => '{{name}} must contain only letters (a-z) and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain letters (a-z)',
            AlphaException::EXTRA => '{{name}} must not contain letters (a-z) or "{{additionalChars}}"',
        ),
    ),

    'AlwaysInvalidException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is always invalid',
            AlwaysInvalidException::SIMPLE   => '{{name}} is not valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is always valid',
            AlwaysInvalidException::SIMPLE   => '{{name}} is valid',
        ),
    ),

    'AlwaysValidException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is always valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is always invalid',
        ),
    ),

    'ArrException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an array',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an array',
        ),
    ),

    'AtLeastException' => array(
        ValidationException::MODE_DEFAULT => array(
            AbstractGroupedException::NONE => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}',
            AbstractGroupedException::SOME => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}, only {{passed}} passed.',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AbstractGroupedException::NONE => 'At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}',
            AbstractGroupedException::SOME => 'At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}, only {{passed}} passed.',
        ),
    ),

    'AttributeException' => array(
        ValidationException::MODE_DEFAULT => array(
            AttributeException::NOT_PRESENT => 'Attribute {{name}} must be present',
            AttributeException::INVALID => 'Attribute {{name}} must be valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AttributeException::NOT_PRESENT => 'Attribute {{name}} must not be present',
            AttributeException::INVALID => 'Attribute {{name}} must not validate',
        ),
    ),

    'BankAccountException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a bank account',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a bank account',
        ),
    ),

    'BankException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a bank',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a bank',
        ),
    ),

    'BetweenException' => array(
        ValidationException::MODE_DEFAULT => array(
            BetweenException::BOTH      => '{{name}} must be between {{minValue}} and {{maxValue}}',
            BetweenException::LOWER     => '{{name}}  must be greater than {{minValue}}',
            BetweenException::GREATER   => '{{name}} must be lower than {{maxValue}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            BetweenException::BOTH      => '{{name}} must not be between {{minValue}} and {{maxValue}}',
            BetweenException::LOWER     => '{{name}}  must not be greater than {{minValue}}',
            BetweenException::GREATER   => '{{name}} must not be lower than {{maxValue}}',
        ),
    ),

    'BicException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a BIC',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a BIC',
        ),
    ),

    'BoolException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a boolean',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a boolean',
        ),
    ),

    'CallbackException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be valid',
        ),
    ),

    'CharsetException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be in the {{charset}} charset',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be in the {{charset}} charset',
        ),
    ),

    'CnhException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid CNH number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid CNH number',
        ),
    ),

    'CnpjException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid CNPJ number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid CNPJ number',
        ),
    ),

    'CntrlException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only control characters',
            AlphaException::EXTRA => '{{name}} must contain only control characters and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain control characters',
            AlphaException::EXTRA => '{{name}} must not contain control characters or "{{additionalChars}}"',
        ),
    ),

    'ConsonantException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only consonants',
            AlphaException::EXTRA => '{{name}} must contain only consonants and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain consonants',
            AlphaException::EXTRA => '{{name}} must not contain consonants or "{{additionalChars}}"',
        ),
    ),

    'ContainsException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain the value "{{containsValue}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain the value "{{containsValue}}"',
        ),
    ),

    'CountryCodeException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid country',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid country',
        ),
    ),

    'CpfException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid CPF number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid CPF number',
        ),
    ),

    'CreditCardException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid Credit Card number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid Credit Card number',
        ),
    ),

    'DateException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid date',
            DateException::FORMAT => '{{name}} must be a valid date. Sample format: {{format}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid date',
            DateException::FORMAT => '{{name}} must not be a valid date in the format {{format}}',
        ),
    ),

    'DigitException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only digits (0-9)',
            AlphaException::EXTRA => '{{name}} must contain only digits (0-9) and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain digits (0-9)',
            AlphaException::EXTRA => '{{name}} must not contain digits (0-9) or "{{additionalChars}}"',
        ),
    ),

    'DirectoryException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a directory',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a directory',
        ),
    ),

    'DomainException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid domain',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid domain',
        ),
    ),

    'EachException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'Each item in {{name}} must be valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'Each item in {{name}} must not validate',
        ),
    ),

    'EmailException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be valid email',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an email',
        ),
    ),

    'EndsWithException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must end with ({{endValue}})',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not end with ({{endValue}})',
        ),
    ),

    'EqualsException' => array(
        ValidationException::MODE_DEFAULT => array(
            EqualsException::EQUALS => '{{name}} must be equals {{compareTo}}',
            EqualsException::IDENTICAL => '{{name}} must be identical as {{compareTo}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            EqualsException::EQUALS => '{{name}} must not be equals {{compareTo}}',
            EqualsException::IDENTICAL => '{{name}} must not be identical as {{compareTo}}',
        ),
    ),

    'EvenException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an even number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an even number',
        ),
    ),

    'ExecutableException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an executable file',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an executable file',
        ),
    ),

    'ExistsException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must exists',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not exists',
        ),
    ),

    'FalseException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is not considered as "False"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is considered as "False"',
        ),
    ),

    'FileException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a file',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a file',
        ),
    ),

    'FilterVarException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be valid',
        ),
    ),

    'FloatException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a float number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a float number',
        ),
    ),

    'GraphException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only graphical characters',
            AlphaException::EXTRA => '{{name}} must contain only graphical characters and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain graphical characters',
            AlphaException::EXTRA => '{{name}} must not contain graphical characters or "{{additionalChars}}"',
        ),
    ),

    'HexaException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a hexadecimal number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a hexadecimal number',
        ),
    ),

    'HexRgbColorException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a hex RGB color',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a hex RGB color',
        ),
    ),

    'InException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be in ({{haystack}})',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be in ({{haystack}})',
        ),
    ),

    'InstanceException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an instance of {{instanceName}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an instance of {{instanceName}}',
        ),
    ),

    'IntException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an integer number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an integer number',
        ),
    ),

    'IpException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an IP address',
            IpException::NETWORK_RANGE => '{{name}} must be an IP address in the {{range}} range',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an IP address',
            IpException::NETWORK_RANGE => '{{name}} must not be an IP address in the {{range}} range',
        ),
    ),

    'JsonException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid JSON string',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid JSON string',
        ),
    ),

    'KeyException' => array(
        ValidationException::MODE_DEFAULT => array(
            AttributeException::NOT_PRESENT => 'Key {{name}} must be present',
            AttributeException::INVALID => 'Key {{name}} must be valid',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AttributeException::NOT_PRESENT => 'Key {{name}} must not be present',
            AttributeException::INVALID => 'Key {{name}} must not be valid',
        ),
    ),

    'LengthException' => array(
        ValidationException::MODE_DEFAULT => array(
            LengthException::BOTH       => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            LengthException::LOWER      => '{{name}} must have a length greater than {{minValue}}',
            LengthException::GREATER    => '{{name}} must have a length lower than {{maxValue}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            LengthException::BOTH       => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            LengthException::LOWER      => '{{name}} must not have a length greater than {{minValue}}',
            LengthException::GREATER    => '{{name}} must not have a length lower than {{maxValue}}',
        ),
    ),

    'LowercaseException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be lowercase',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be lowercase',
        ),
    ),

    'MacAddressException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid mac address',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid mac address',
        ),
    ),

    'MaxException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be lower than {{interval}}',
            MaxException::INCLUSIVE => '{{name}} must be lower than or equals {{interval}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be lower than {{interval}}',
            MaxException::INCLUSIVE => '{{name}} must not be lower than or equals {{interval}}',
        ),
    ),

    'MinException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be greater than {{interval}}',
            MinException::INCLUSIVE => '{{name}} must be greater than or equals {{interval}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be greater than {{interval}}',
            MinException::INCLUSIVE => '{{name}} must not be greater than or equals {{interval}}',
        ),
    ),

    'MinimumAgeException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'The age must be {{age}} years or more.',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'The age must not be {{age}} years or more.',
        ),
    ),

    'MultipleException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be multiple of {{multipleOf}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be multiple of {{multipleOf}}',
        ),
    ),

    'NegativeException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be negative',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be negative',
        ),
    ),

    'NfeAccessKeyException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid NFe access key',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid NFe access key',
        ),
    ),

    'NoException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is not considered as "No"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is considered as "No"',
        ),
    ),

    'NoneOfException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'None of these rules must pass for {{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'All of these rules must pass for {{name}}',
        ),
    ),

    'NotEmptyException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'The value must not be empty',
            NotEmptyException::NAMED => '{{name}} must not be empty',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'The value must be empty',
            NotEmptyException::NAMED => '{{name}} must be empty',
        ),
    ),

    'NoWhitespaceException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must not contain whitespace',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not not contain whitespace',
        ),
    ),

    'NullValueException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be null',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be null',
        ),
    ),

    'NumericException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be numeric',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be numeric',
        ),
    ),

    'ObjectException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an object',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an object',
        ),
    ),

    'OddException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an odd number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an odd number',
        ),
    ),

    'OneOfException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'At least one of these rules must pass for {{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'At least one of these rules must not pass for {{name}}',
        ),
    ),

    'PerfectSquareException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid perfect square',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid perfect square',
        ),
    ),

    'PhoneException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid telephone number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid telephone number',
        ),
    ),

    'PositiveException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be positive',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be positive',
        ),
    ),

    'PostalCodeException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid postal code',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid postal code',
        ),
    ),

    'PrimeNumberException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid prime number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid prime number',
        ),
    ),

    'PrntException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only printable characters',
            AlphaException::EXTRA => '{{name}} must contain only printable characters and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain printable characters',
            AlphaException::EXTRA => '{{name}} must not contain printable characters or "{{additionalChars}}"',
        ),
    ),

    'PunctException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only punctuation characters',
            AlphaException::EXTRA => '{{name}} must contain only punctuation characters and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain punctuation characters',
            AlphaException::EXTRA => '{{name}} must not contain punctuation characters or "{{additionalChars}}"',
        ),
    ),

    'ReadableException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be readable',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be readable',
        ),
    ),

    'RegexException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must validate against {{regex}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not validate against {{regex}}',
        ),
    ),

    'RomanException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid roman number',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid roman number',
        ),
    ),

    'SfException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}}',
        ),
    ),

    'SlugException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid slug',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid slug',
        ),
    ),

    'SpaceException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only space characters',
            AlphaException::EXTRA => '{{name}} must contain only space characters and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain space characters',
            AlphaException::EXTRA => '{{name}} must not contain space characters or "{{additionalChars}}"',
        ),
    ),

    'StartsWithException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must start with ({{startValue}})',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not start with ({{startValue}})',
        ),
    ),

    'StringException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a string',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be string',
        ),
    ),

    'SymbolicLinkException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a symbolic link',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a symbolic link',
        ),
    ),

    'TldException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a valid top-level domain name',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a valid top-level domain name',
        ),
    ),

    'TrueException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is not considered as "True"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is considered as "True"',
        ),
    ),

    'TypeException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be {{type}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be {{type}}',
        ),
    ),

    'UploadedException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an uploaded file',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an uploaded file',
        ),
    ),

    'UppercaseException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be uppercase',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be uppercase',
        ),
    ),

    'UrlException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be an URL',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be an URL',
        ),
    ),

    'ValidationException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => 'Data validation failed for %s',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'Data validation failed for %s',
        ),
    ),

    'VersionException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a version',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a version',
        ),
    ),

    'VowelException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must contain only vowels',
            AlphaException::EXTRA => '{{name}} must contain only vowels and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain vowels',
            AlphaException::EXTRA => '{{name}} must not contain vowels or "{{additionalChars}}"',
        ),
    ),

    'WritableException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be writable',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be writable',
        ),
    ),

    'XdigitException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} contain only hexadecimal digits',
            AlphaException::EXTRA => '{{name}} contain only hexadecimal digits and "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not contain hexadecimal digits',
            AlphaException::EXTRA => '{{name}} must not contain hexadecimal digits or "{{additionalChars}}"',
        ),
    ),

    'YesException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} is not considered as "Yes"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} is considered as "Yes"',
        ),
    ),

    'ZendException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}}',
        ),
    ),

    'GermanBankAccountException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a german bank account',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a german bank account',
        ),
    ),

    'GermanBankException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a german bank',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a german bank',
        ),
    ),

    'GermanBicException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} must be a german BIC',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} must not be a german BIC',
        ),
    ),
);
