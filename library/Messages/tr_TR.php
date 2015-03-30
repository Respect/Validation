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
            AbstractGroupedException::NONE => '{{name}} tüm zorunlu kurallara uymalıdır',
            AbstractGroupedException::SOME => '{{name}} şu kurallara uymalıdır',
        ),
        ValidationException::MODE_NEGATIVE => array(
            AbstractGroupedException::NONE => '{{name}} bu kuralların hiçbirine uymamalıdır',
            AbstractGroupedException::SOME => '{{name}} şu kurallara uymamalıdır',
        ),
    ),

    'AlnumException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} sadece harf (a-z) ve rakamlardan (0-9) oluşmalı',
            AlphaException::EXTRA => '{{name}} sadece harflerden (a-z), rakamlardan (0-9) ve şunlardan oluşmalı: "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen harf (a-z) ve rakamlardan (0-9) oluşmamalı',
            AlphaException::EXTRA => '{{name}} tamamen harflerden (a-z), rakamlardan (0-9) ve şunlardan oluşmamalı: "{{additionalChars}}"',
        ),
    ),

    'AlphaException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} sadece harflerden oluşmalı (a-z)',
            AlphaException::EXTRA => '{{name}} sadece harflerden (a-z) ve şunlardan oluşmalı: "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen harflerden oluşmamalı (a-z)',
            AlphaException::EXTRA => '{{name}} tamamen harflerden (a-z) ve şunlardan oluşmamalı: "{{additionalChars}}"',
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
            ValidationException::STANDARD => '{{name}} bir dizi olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} dizi olmamalı',
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
            BetweenException::BOTH      => '{{name}} şu aralıkta olmalı: {{minValue}} - {{maxValue}}',
            BetweenException::LOWER     => '{{name}} en az {{minValue}} olabilir',
            BetweenException::GREATER   => '{{name}} en fazla {{maxValue}} olabilir',
        ),
        ValidationException::MODE_NEGATIVE => array(
            BetweenException::BOTH      => '{{name}} şu aralıkta olmamalı: {{minValue}} - {{maxValue}}',
            BetweenException::LOWER     => '{{name}} şundan küçük olmalı: {{minValue}}',
            BetweenException::GREATER   => '{{name}} şundan büyük olmalı: {{maxValue}}',
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
            ValidationException::STANDARD => '{{name}} bir boolean olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} boolean olmamalı',
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
            ValidationException::STANDARD => '{{name}} şunu içermeli: "{{containsValue}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şunu içermemeli: "{{containsValue}}"',
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
            ValidationException::STANDARD => '{{name}} geçersiz',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} geçerli bir numara olmamalı',
        ),
    ),

    'DateException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} geçerli bir tarih olmalı',
            DateException::FORMAT => '{{name}} geçerli bir tarih olmalı. Örnek format: {{format}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} geçerli bir tarih olmamalı',
            DateException::FORMAT => '{{name}} şu tarih formatında olmamalı: {{format}}',
        ),
    ),

    'DigitException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} sadece rakamlardan oluşmalı (0-9)',
            AlphaException::EXTRA => '{{name}} sadece rakamlardan (0-9) ve şunlardan oluşmalı: "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen rakamlardan (0-9) oluşmamalı',
            AlphaException::EXTRA => '{{name}} tamamen rakamlardan (0-9) ve şunlardan oluşmamalı: "{{additionalChars}}"',
        ),
    ),

    'DirectoryException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} var olan bir klasör olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} var olan bir klasör olmamalı',
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
            ValidationException::STANDARD => '{{name}} geçerli bir eposta olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} geçerli bir eposta olmamalı',
        ),
    ),

    'EndsWithException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} şununla bitmeli: "{{endValue}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şununla bitmemeli: "{{endValue}}"',
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
            ValidationException::STANDARD => '{{name}} çift sayı olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} çift sayı olmamalı',
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
            ValidationException::STANDARD => '{{name}} var olan bir dosya olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} var olan bir dosya olmamalı',
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
            ValidationException::STANDARD => '{{name}} bir float olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} float olmamalı',
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
            ValidationException::STANDARD => '{{name}} bir sayı olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} bir sayı olmamalı',
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
            LengthException::BOTH       => '{{name}} şu aralıkta bir uzunluğa sahip olmalı: {{minValue}} - {{maxValue}}',
            LengthException::LOWER      => '{{name}} en az şu uzunlukta olmalı: {{minValue}}',
            LengthException::GREATER    => '{{name}} en fazla şu uzunlukta olmalı: {{maxValue}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            LengthException::BOTH       => '{{name}} şu aralıkta bir uzunluğa sahip olmamalı: {{minValue}} - {{maxValue}}',
            LengthException::LOWER      => '{{name}} şundan daha kısa olmalı: {{minValue}}',
            LengthException::GREATER    => '{{name}} şundan daha uzun olmalı: {{maxValue}}',
        ),
    ),

    'LowercaseException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} yalnızca küçük harflerden oluşmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen küçük harflerden oluşmamalı',
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
            ValidationException::STANDARD => '{{name}} şundan küçük olmalı: {{interval}}',
            MaxException::INCLUSIVE => '{{name}} en fazla {{interval}} olabilir',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şundan küçük olmamalı: {{interval}}',
            MaxException::INCLUSIVE => '{{name}} şundan büyük olmalı: {{interval}}',
        ),
    ),

    'MinException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} şundan büyük olmalı: {{interval}}',
            MinException::INCLUSIVE => '{{name}} en az {{interval}} olabilir',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şundan büyük olmamalı: {{interval}}',
            MinException::INCLUSIVE => '{{name}} şundan küçük olmalı: {{interval}}',
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
            ValidationException::STANDARD => '{{name}} sıfırdan küçük olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} sıfırdan küçük olmamalı',
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
            ValidationException::STANDARD => 'Değer boş bırakılamaz',
            NotEmptyException::NAMED => '{{name}} boş bırakılamaz',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => 'Değer boş olmalı',
            NotEmptyException::NAMED => '{{name}} boş olmalı',
        ),
    ),

    'NoWhitespaceException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} boşluk karakterleri içermemeli',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} boşluk karakterleri içermeli',
        ),
    ),

    'NullValueException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} null olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} null olmamalı',
        ),
    ),

    'NumericException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} sayısal bir ifade olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} sayısal bir ifade olmamalı',
        ),
    ),

    'ObjectException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} bir nesne olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} bir nesne olmamalı',
        ),
    ),

    'OddException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} tek sayı olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tek sayı olmamalı',
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
            ValidationException::STANDARD => '{{name}} sıfırdan büyük olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} sıfırdan büyük olmamalı',
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
            ValidationException::STANDARD => '{{name}} şu düzenli ifadeyle eşleşmeli: {{regex}}',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şu düzenli ifadeyle eşleşmemeli: {{regex}}',
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
            ValidationException::STANDARD => '{{name}} sadece boşluk karakterleri içermeli',
            AlphaException::EXTRA => '{{name}} sadece boşluk karakterleri ve şunları içermeli: "{{additionalChars}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen boşluk karakterlerinden oluşmamalı',
            AlphaException::EXTRA => '{{name}} tamamen boşluk karakterlerinden ve şunlardan oluşmamalı: "{{additionalChars}}"',
        ),
    ),

    'StartsWithException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} şununla başlamalı: "{{startValue}}"',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} şununla başlamamalı: "{{startValue}}"',
        ),
    ),

    'StringException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} bir metin olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} bir metin olmamalı',
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
            ValidationException::STANDARD => '{{name}}, yüklenmiş bir dosya olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}}, yüklenmiş bir dosya olmamalı',
        ),
    ),

    'UppercaseException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} yalnızca büyük harflerden oluşmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} tamamen büyük harflerden oluşmamalı',
        ),
    ),

    'UrlException' => array(
        ValidationException::MODE_DEFAULT => array(
            ValidationException::STANDARD => '{{name}} geçerli bir URL olmalı',
        ),
        ValidationException::MODE_NEGATIVE => array(
            ValidationException::STANDARD => '{{name}} geçerli bir URL olmamalı',
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
