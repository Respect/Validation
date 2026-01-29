<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Validators

In this page you will find a list of validators by their category.

**Arrays**: [ArrayType][] - [ArrayVal][] - [Contains][] - [ContainsAny][] - [ContainsCount][] - [Each][] - [EndsWith][] - [In][] - [Key][] - [KeyExists][] - [KeyOptional][] - [KeySet][] - [Sorted][] - [StartsWith][] - [Subset][] - [Unique][]

**Banking**: [CreditCard][] - [Iban][]

**Booleans**: [AlwaysInvalid][] - [AlwaysValid][] - [BoolType][] - [BoolVal][] - [FalseVal][] - [TrueVal][]

**Callables**: [After][] - [CallableType][] - [Factory][] - [Satisfies][]

**Comparisons**: [All][] - [Between][] - [BetweenExclusive][] - [Equals][] - [Equivalent][] - [GreaterThan][] - [GreaterThanOrEqual][] - [Identical][] - [In][] - [Length][] - [LessThan][] - [LessThanOrEqual][] - [Max][] - [Min][]

**Composite**: [AllOf][] - [AnyOf][] - [Circuit][] - [NoneOf][] - [OneOf][]

**Conditions**: [Circuit][] - [Not][] - [When][]

**Core**: [Named][] - [Not][] - [Templated][]

**Date and Time**: [Date][] - [DateTime][] - [DateTimeDiff][] - [LeapDate][] - [LeapYear][] - [Time][]

**Display**: [Masked][] - [Named][] - [Templated][]

**File system**: [Directory][] - [Executable][] - [Exists][] - [Extension][] - [File][] - [Image][] - [Mimetype][] - [Readable][] - [Size][] - [SymbolicLink][] - [Writable][]

**ISO codes**: [CountryCode][] - [CurrencyCode][] - [LanguageCode][] - [SubdivisionCode][]

**Identifications**: [Bsn][] - [Cnh][] - [Cnpj][] - [Cpf][] - [Hetu][] - [Imei][] - [Isbn][] - [Luhn][] - [MacAddress][] - [NfeAccessKey][] - [Nif][] - [Nip][] - [Pesel][] - [Pis][] - [PolishIdCard][] - [PortugueseNif][]

**Internet**: [Domain][] - [Email][] - [Ip][] - [PublicDomainSuffix][] - [Tld][] - [Url][]

**Localization**: [CountryCode][] - [CurrencyCode][] - [LanguageCode][] - [PostalCode][] - [SubdivisionCode][]

**Math**: [Factor][] - [Finite][] - [Infinite][] - [Multiple][] - [Negative][] - [Positive][]

**Miscellaneous**: [Blank][] - [Falsy][] - [Masked][] - [Named][] - [Templated][] - [Undef][]

**Nesting**: [After][] - [AllOf][] - [AnyOf][] - [Circuit][] - [Each][] - [Factory][] - [Key][] - [KeySet][] - [NoneOf][] - [Not][] - [NullOr][] - [OneOf][] - [Property][] - [PropertyOptional][] - [UndefOr][] - [When][]

**Numbers**: [Base][] - [Decimal][] - [Digit][] - [Even][] - [Factor][] - [Finite][] - [FloatType][] - [FloatVal][] - [Infinite][] - [IntType][] - [IntVal][] - [Multiple][] - [Negative][] - [Number][] - [NumericVal][] - [Odd][] - [Positive][] - [Roman][]

**Objects**: [Attributes][] - [Instance][] - [ObjectType][] - [Property][] - [PropertyExists][] - [PropertyOptional][]

**Strings**: [Alnum][] - [Alpha][] - [Base64][] - [Charset][] - [Consonant][] - [Contains][] - [ContainsAny][] - [ContainsCount][] - [Control][] - [Digit][] - [Emoji][] - [EndsWith][] - [Graph][] - [HexRgbColor][] - [In][] - [Json][] - [Lowercase][] - [Phone][] - [PostalCode][] - [Printable][] - [Punct][] - [Regex][] - [Slug][] - [Sorted][] - [Space][] - [Spaced][] - [StartsWith][] - [StringType][] - [StringVal][] - [Uppercase][] - [Uuid][] - [Version][] - [Vowel][] - [Xdigit][]

**Structures**: [Attributes][] - [Key][] - [KeyExists][] - [KeyOptional][] - [KeySet][] - [Property][] - [PropertyExists][] - [PropertyOptional][]

**Transformations**: [After][] - [All][] - [Each][] - [Length][] - [Max][] - [Min][] - [Size][]

**Types**: [ArrayType][] - [ArrayVal][] - [BoolType][] - [BoolVal][] - [CallableType][] - [Countable][] - [FloatType][] - [FloatVal][] - [IntType][] - [IntVal][] - [IterableType][] - [IterableVal][] - [NullType][] - [NumericVal][] - [ObjectType][] - [ResourceType][] - [ScalarVal][] - [StringType][] - [StringVal][]

## Alphabetically

- [After][] - `v::after(str_split(...), v::arrayType()->lengthEquals(5))->assert('world');`
- [All][] - `v::all(v::dateTime())->assert($releaseDates);`
- [AllOf][] - `v::allOf(v::intVal(), v::positive())->assert(15);`
- [Alnum][] - `v::alnum(' ')->assert('foo 123');`
- [Alpha][] - `v::alpha(' ')->assert('some name');`
- [AlwaysInvalid][] - `v::not(v::alwaysInvalid())->assert('whatever');`
- [AlwaysValid][] - `v::alwaysValid()->assert('whatever');`
- [AnyOf][] - `v::anyOf(v::intVal(), v::floatVal())->assert(15.5);`
- [ArrayType][] - `v::arrayType()->assert([]);`
- [ArrayVal][] - `v::arrayVal()->assert([]);`
- [Attributes][] - `v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com'));`
- [Base][] - `v::base(2)->assert('011010001');`
- [Base64][] - `v::base64()->assert('cmVzcGVjdCE=');`
- [Between][] - `v::intVal()->between(10, 20)->assert(10);`
- [BetweenExclusive][] - `v::betweenExclusive('a', 'e')->assert('c');`
- [Blank][] - `v::blank()->assert(' ');`
- [BoolType][] - `v::boolType()->assert(true);`
- [BoolVal][] - `v::boolVal()->assert('on');`
- [Bsn][] - `v::bsn()->assert('612890053');`
- [CallableType][] - `v::callableType()->assert(function () {});`
- [Charset][] - `v::charset('ASCII')->assert('sugar');`
- [Circuit][] - `v::circuit(v::intVal(), v::floatVal())->assert(15);`
- [Cnh][] - `v::cnh()->assert('02650306461');`
- [Cnpj][] - `v::cnpj()->assert('00394460005887');`
- [Consonant][] - `v::consonant()->assert('xkcd');`
- [Contains][] - `v::contains('ipsum')->assert('lorem ipsum');`
- [ContainsAny][] - `v::containsAny(['lorem', 'dolor'])->assert('lorem ipsum');`
- [ContainsCount][] - `v::containsCount('ipsum', 2)->assert('ipsum lorem ipsum');`
- [Control][] - `v::control()->assert("\n\r\t");`
- [Countable][] - `v::countable()->assert([]);`
- [CountryCode][] - `v::countryCode()->assert('BR');`
- [Cpf][] - `v::cpf()->assert('95574461102');`
- [CreditCard][] - `v::creditCard()->assert('5376 7473 9720 8720');`
- [CurrencyCode][] - `v::currencyCode()->assert('GBP');`
- [Date][] - `v::date()->assert('2017-12-31');`
- [DateTime][] - `v::dateTime()->assert('2009-01-01');`
- [DateTimeDiff][] - `v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->assert('09/12/1990');`
- [Decimal][] - `v::decimal(2)->assert('27990.50');`
- [Digit][] - `v::digit(' ')->assert('020 612 1851');`
- [Directory][] - `v::directory()->assert(__DIR__);`
- [Domain][] - `v::domain()->assert('google.com');`
- [Each][] - `v::each(v::dateTime())->assert($releaseDates);`
- [Email][] - `v::email()->assert('alganet@gmail.com');`
- [Emoji][] - `v::emoji()->assert('🍕');`
- [EndsWith][] - `v::endsWith('ipsum')->assert('lorem ipsum');`
- [Equals][] - `v::equals('alganet')->assert('alganet');`
- [Equivalent][] - `v::equivalent(1)->assert(true);`
- [Even][] - `v::intVal()->even()->assert(2);`
- [Executable][] - `v::executable()->assert('/path/to/executable');`
- [Exists][] - `v::exists()->assert(__FILE__);`
- [Extension][] - `v::extension('png')->assert('image.png');`
- [Factor][] - `v::factor(0)->assert(5);`
- [Factory][] - `v::factory(static fn($input) => v::boolVal())->assert(true);`
- [FalseVal][] - `v::falseVal()->assert(false);`
- [Falsy][] - `v::falsy()->assert('');`
- [File][] - `v::file()->assert(__FILE__);`
- [Finite][] - `v::finite()->assert('10');`
- [FloatType][] - `v::floatType()->assert(1.5);`
- [FloatVal][] - `v::floatVal()->assert(1.5);`
- [Graph][] - `v::graph()->assert('LKM@#$%4;');`
- [GreaterThan][] - `v::greaterThan(10)->assert(11);`
- [GreaterThanOrEqual][] - `v::intVal()->greaterThanOrEqual(10)->assert(10);`
- [Hetu][] - `v::hetu()->assert('010106A9012');`
- [HexRgbColor][] - `v::hexRgbColor()->assert('#FFFAAA');`
- [Iban][] - `v::iban()->assert('SE35 5000 0000 0549 1000 0003');`
- [Identical][] - `v::identical(42)->assert(42);`
- [Image][] - `v::image()->assert('/path/to/image.gif');`
- [Imei][] - `v::imei()->assert('35-209900-176148-1');`
- [In][] - `v::in('lorem ipsum')->assert('ipsum');`
- [Infinite][] - `v::infinite()->assert(INF);`
- [Instance][] - `v::instance('DateTime')->assert(new DateTime);`
- [IntType][] - `v::intType()->assert(42);`
- [IntVal][] - `v::intVal()->assert('10');`
- [Ip][] - `v::ip()->assert('127.0.0.1');`
- [Isbn][] - `v::isbn()->assert('ISBN-13: 978-0-596-52068-7');`
- [IterableType][] - `v::iterableType()->assert([]);`
- [IterableVal][] - `v::iterableVal()->assert([]);`
- [Json][] - `v::json()->assert('{"foo":"bar"}');`
- [Key][] - `v::key('name', v::stringType())->assert(['name' => 'The Respect Panda']);`
- [KeyExists][] - `v::keyExists('name')->assert(['name' => 'The Respect Panda']);`
- [KeyOptional][] - `v::keyOptional('name', v::stringType())->assert([]);`
- [KeySet][] - `v::keySet(v::key('foo', v::intVal()))->assert(['foo' => 42]);`
- [LanguageCode][] - `v::languageCode()->assert('pt');`
- [LeapDate][] - `v::leapDate('Y-m-d')->assert('1988-02-29');`
- [LeapYear][] - `v::leapYear()->assert('1988');`
- [Length][] - `v::length(v::between(1, 5))->assert('abc');`
- [LessThan][] - `v::lessThan(10)->assert(9);`
- [LessThanOrEqual][] - `v::lessThanOrEqual(10)->assert(9);`
- [Lowercase][] - `v::stringType()->lowercase()->assert('xkcd');`
- [Luhn][] - `v::luhn()->assert('2222400041240011');`
- [MacAddress][] - `v::macAddress()->assert('00:11:22:33:44:55');`
- [Masked][] - `v::masked('1-@', v::email())->assert('foo@example.com');`
- [Max][] - `v::max(v::equals(30))->assert([10, 20, 30]);`
- [Mimetype][] - `v::mimetype('image/png')->assert('/path/to/image.png');`
- [Min][] - `v::min(v::equals(10))->assert([10, 20, 30]);`
- [Multiple][] - `v::intVal()->multiple(3)->assert(9);`
- [Named][] - `v::named('Your email', v::email())->assert('foo@example.com');`
- [Negative][] - `v::numericVal()->negative()->assert(-15);`
- [NfeAccessKey][] - `v::nfeAccessKey()->assert('52060433009911002506550120000007800267301615');`
- [Nif][] - `v::nif()->assert('49294492H');`
- [Nip][] - `v::nip()->assert('1645865777');`
- [NoneOf][] - `v::noneOf(v::intVal(), v::floatVal())->assert('foo');`
- [Not][] - `v::not(v::ip())->assert('foo');`
- [NullOr][] - `v::nullOr(v::email())->assert(null);`
- [NullType][] - `v::nullType()->assert(null);`
- [Number][] - `v::number()->assert(42);`
- [NumericVal][] - `v::numericVal()->assert(-12);`
- [ObjectType][] - `v::objectType()->assert(new stdClass);`
- [Odd][] - `v::odd()->assert(3);`
- [OneOf][] - `v::oneOf(v::digit(), v::alpha())->assert('AB');`
- [Pesel][] - `v::pesel()->assert('21120209256');`
- [Phone][] - `v::phone()->assert('+1 650 253 00 00');`
- [Pis][] - `v::pis()->assert('120.0340.678-8');`
- [PolishIdCard][] - `v::polishIdCard()->assert('AYW036733');`
- [PortugueseNif][] - `v::portugueseNif()->assert('124885446');`
- [Positive][] - `v::positive()->assert(1);`
- [PostalCode][] - `v::postalCode('BR')->assert('02179000');`
- [Printable][] - `v::printable()->assert('LMKA0$% _123');`
- [Property][] - `v::property('name', v::equals('The Respect Panda'))->assert($object);`
- [PropertyExists][] - `v::propertyExists('name')->assert($object);`
- [PropertyOptional][] - `v::propertyOptional('name', v::notBlank())->assert($object);`
- [PublicDomainSuffix][] - `v::publicDomainSuffix()->assert('co.uk');`
- [Punct][] - `v::punct()->assert('&,.;[]');`
- [Readable][] - `v::readable()->assert('/path/to/file.txt');`
- [Regex][] - `v::regex('/[a-z]/')->assert('a');`
- [ResourceType][] - `v::resourceType()->assert(fopen('/path/to/file.txt', 'r'));`
- [Roman][] - `v::roman()->assert('IV');`
- [Satisfies][] - `v::satisfies(fn (int $input): bool => $input % 5 === 0,)->assert(10);`
- [ScalarVal][] - `v::scalarVal()->assert(135.0);`
- [Size][] - `v::size('KB', v::greaterThan(1))->assert('/path/to/file');`
- [Slug][] - `v::slug()->assert('my-wordpress-title');`
- [Sorted][] - `v::sorted('ASC')->assert([1, 2, 3]);`
- [Space][] - `v::space()->assert('    ');`
- [Spaced][] - `v::spaced()->assert('foo bar');`
- [StartsWith][] - `v::startsWith('lorem')->assert('lorem ipsum');`
- [StringType][] - `v::stringType()->assert('hi');`
- [StringVal][] - `v::stringVal()->assert('6');`
- [SubdivisionCode][] - `v::subdivisionCode('BR')->assert('SP');`
- [Subset][] - `v::subset([1, 2, 3])->assert([1, 2]);`
- [SymbolicLink][] - `v::symbolicLink()->assert('/path/to/symbolic-link');`
- [Templated][] - `v::templated('You must provide a valid email', v::email())->assert('foo@bar.com');`
- [Time][] - `v::time()->assert('00:00:00');`
- [Tld][] - `v::tld()->assert('com');`
- [TrueVal][] - `v::trueVal()->assert(true);`
- [Undef][] - `v::undef()->assert('');`
- [UndefOr][] - `v::undefOr(v::alpha())->assert('');`
- [Unique][] - `v::unique()->assert([]);`
- [Uppercase][] - `v::uppercase()->assert('W3C');`
- [Url][] - `v::url()->assert('http://example.com');`
- [Uuid][] - `v::uuid()->assert('eb3115e5-bd16-4939-ab12-2b95745a30f3');`
- [Version][] - `v::version()->assert('1.0.0');`
- [Vowel][] - `v::vowel()->assert('aei');`
- [When][] - `v::when(v::intVal(), v::positive(), v::notBlank())->assert(1);`
- [Writable][] - `v::writable()->assert('/path/to/file');`
- [Xdigit][] - `v::xdigit()->assert('abc123');`

[After]: validators/After.md "Validates the input after applying a callable to it."
[All]: validators/All.md "Validates all items of the input against a given validator."
[AllOf]: validators/AllOf.md "Will validate if all inner validators validates."
[Alnum]: validators/Alnum.md "Validates whether the input is alphanumeric or not."
[Alpha]: validators/Alpha.md "Validates whether the input contains only alphabetic characters. This is similar"
[AlwaysInvalid]: validators/AlwaysInvalid.md "Validates any input as invalid."
[AlwaysValid]: validators/AlwaysValid.md "Validates any input as valid."
[AnyOf]: validators/AnyOf.md "This is a group validator that acts as an OR operator."
[ArrayType]: validators/ArrayType.md "Validates whether the type of an input is array."
[ArrayVal]: validators/ArrayVal.md "Validates if the input is an array or if the input can be used as an array"
[Attributes]: validators/Attributes.md "Validates the PHP attributes defined in the properties of the input."
[Base]: validators/Base.md "Validate numbers in any base, even with non regular bases."
[Base64]: validators/Base64.md "Validate if a string is Base64-encoded."
[Between]: validators/Between.md "Validates whether the input is between two other values."
[BetweenExclusive]: validators/BetweenExclusive.md "Validates whether the input is between two other values, exclusively."
[Blank]: validators/Blank.md "Validates if the given input is a blank value (`null`, zeros, empty strings or empty arrays, recursively)."
[BoolType]: validators/BoolType.md "Validates whether the type of the input is boolean."
[BoolVal]: validators/BoolVal.md "Validates if the input results in a boolean value:"
[Bsn]: validators/Bsn.md "Validates a Dutch citizen service number (BSN)."
[CallableType]: validators/CallableType.md "Validates whether the pseudo-type of the input is callable."
[Charset]: validators/Charset.md "Validates if a string is in a specific charset."
[Circuit]: validators/Circuit.md "Validates the input against a series of validators until the first fails."
[Cnh]: validators/Cnh.md "Validates a Brazilian driver's license."
[Cnpj]: validators/Cnpj.md "Validates the structure and mathematical integrity of Brazilian CNPJ identifiers."
[Consonant]: validators/Consonant.md "Validates if the input contains only consonants."
[Contains]: validators/Contains.md "Validates if the input contains some value."
[ContainsAny]: validators/ContainsAny.md "Validates if the input contains at least one of defined values"
[ContainsCount]: validators/ContainsCount.md "Validates if the input contains a value a specific number of times."
[Control]: validators/Control.md "Validates if all of the characters in the provided string, are control"
[Countable]: validators/Countable.md "Validates if the input is countable, in other words, if you're allowed to use"
[CountryCode]: validators/CountryCode.md "Validates whether the input is a country code in ISO 3166-1 standard."
[Cpf]: validators/Cpf.md "Validates a Brazillian CPF number."
[CreditCard]: validators/CreditCard.md "Validates a credit card number."
[CurrencyCode]: validators/CurrencyCode.md "Validates an ISO 4217 currency code."
[Date]: validators/Date.md "Validates if input is a date. The `$format` argument should be in accordance to"
[DateTime]: validators/DateTime.md "Validates whether an input is a date/time or not."
[DateTimeDiff]: validators/DateTimeDiff.md "Validates the difference of date/time against a specific validator."
[Decimal]: validators/Decimal.md "Validates whether the input matches the expected number of decimals."
[Digit]: validators/Digit.md "Validates whether the input contains only digits."
[Directory]: validators/Directory.md "Validates if the given path is a directory."
[Domain]: validators/Domain.md "Validates whether the input is a valid domain name or not."
[Each]: validators/Each.md "Validates whether each value in the input is valid according to another validator."
[Email]: validators/Email.md "Validates an email address."
[Emoji]: validators/Emoji.md "Validates if the input is an emoji or a sequence of emojis."
[EndsWith]: validators/EndsWith.md "This validator is similar to `Contains()`, but validates"
[Equals]: validators/Equals.md "Validates if the input is equal to some value."
[Equivalent]: validators/Equivalent.md "Validates if the input is equivalent to some value."
[Even]: validators/Even.md "Validates whether the input is an even number or not."
[Executable]: validators/Executable.md "Validates if a file is an executable."
[Exists]: validators/Exists.md "Validates files or directories."
[Extension]: validators/Extension.md "Validates if the file extension matches the expected one:"
[Factor]: validators/Factor.md "Validates if the input is a factor of the defined dividend."
[Factory]: validators/Factory.md "Validates the input using a validator that is created from a callback."
[FalseVal]: validators/FalseVal.md "Validates if a value is considered as `false`."
[Falsy]: validators/Falsy.md "Validates whether the given input is considered empty or falsy, similar to PHP's `empty()` function."
[File]: validators/File.md "Validates whether file input is as a regular filename."
[Finite]: validators/Finite.md "Validates if the input is a finite number."
[FloatType]: validators/FloatType.md "Validates whether the type of the input is float."
[FloatVal]: validators/FloatVal.md "Validate whether the input value is float."
[Graph]: validators/Graph.md "Validates if all characters in the input are printable and actually creates"
[GreaterThan]: validators/GreaterThan.md "Validates whether the input is greater than a value."
[GreaterThanOrEqual]: validators/GreaterThanOrEqual.md "Validates whether the input is greater than or equal to a value."
[Hetu]: validators/Hetu.md "Validates a Finnish personal identity code (HETU)."
[HexRgbColor]: validators/HexRgbColor.md "Validates weather the input is a hex RGB color or not."
[Iban]: validators/Iban.md "Validates whether the input is a valid IBAN (International Bank Account"
[Identical]: validators/Identical.md "Validates if the input is identical to some value."
[Image]: validators/Image.md "Validates if the file is a valid image by checking its MIME type."
[Imei]: validators/Imei.md "Validates is the input is a valid IMEI."
[In]: validators/In.md "Validates if the input is contained in a specific haystack."
[Infinite]: validators/Infinite.md "Validates if the input is an infinite number."
[Instance]: validators/Instance.md "Validates if the input is an instance of the given class or interface."
[IntType]: validators/IntType.md "Validates whether the type of the input is integer."
[IntVal]: validators/IntVal.md "Validates if the input is an integer, allowing leading zeros and other number bases."
[Ip]: validators/Ip.md "Validates whether the input is a valid IP address."
[Isbn]: validators/Isbn.md "Validates whether the input is a valid ISBN or not."
[IterableType]: validators/IterableType.md "Validates whether the input is iterable, meaning that it matches the built-in compile time type alias `iterable`."
[IterableVal]: validators/IterableVal.md "Validates whether the input is an iterable value, in other words, if you can iterate over it with the foreach language construct."
[Json]: validators/Json.md "Validates if the given input is a valid JSON."
[Key]: validators/Key.md "Validates the value of an array against a given validator."
[KeyExists]: validators/KeyExists.md "Validates if the given key exists in an array."
[KeyOptional]: validators/KeyOptional.md "Validates the value of an array against a given validator when the key exists."
[KeySet]: validators/KeySet.md "Validates a keys in a defined structure."
[LanguageCode]: validators/LanguageCode.md "Validates whether the input is language code based on ISO 639."
[LeapDate]: validators/LeapDate.md "Validates if a date is leap."
[LeapYear]: validators/LeapYear.md "Validates if a year is leap."
[Length]: validators/Length.md "Validates the length of the given input against a given validator."
[LessThan]: validators/LessThan.md "Validates whether the input is less than a value."
[LessThanOrEqual]: validators/LessThanOrEqual.md "Validates whether the input is less than or equal to a value."
[Lowercase]: validators/Lowercase.md "Validates whether the characters in the input are lowercase."
[Luhn]: validators/Luhn.md "Validate whether a given input is a Luhn number."
[MacAddress]: validators/MacAddress.md "Validates whether the input is a valid MAC address."
[Masked]: validators/Masked.md "Decorates a validator to mask input values in error messages while still validating the original unmasked input."
[Max]: validators/Max.md "Validates the maximum value of the input against a given validator."
[Mimetype]: validators/Mimetype.md "Validates if the input is a file and if its MIME type matches the expected one."
[Min]: validators/Min.md "Validates the minimum value of the input against a given validator."
[Multiple]: validators/Multiple.md "Validates if the input is a multiple of the given parameter"
[Named]: validators/Named.md "Validates the input with the given validator, and uses the custom name in the error message."
[Negative]: validators/Negative.md "Validates whether the input is a negative number."
[NfeAccessKey]: validators/NfeAccessKey.md "Validates the access key of the Brazilian electronic invoice (NFe)."
[Nif]: validators/Nif.md "Validates Spain's fiscal identification number (NIF)."
[Nip]: validators/Nip.md "Validates whether the input is a Polish VAT identification number (NIP)."
[NoneOf]: validators/NoneOf.md "Validates if NONE of the given validators validate:"
[Not]: validators/Not.md "Negates any validator."
[NullOr]: validators/NullOr.md "Validates the input using a defined validator when the input is not `null`."
[NullType]: validators/NullType.md "Validates whether the input is null."
[Number]: validators/Number.md "Validates if the input is a number."
[NumericVal]: validators/NumericVal.md "Validates whether the input is numeric."
[ObjectType]: validators/ObjectType.md "Validates whether the input is an object."
[Odd]: validators/Odd.md "Validates whether the input is an odd number or not."
[OneOf]: validators/OneOf.md "Will validate if exactly one inner validator passes."
[Pesel]: validators/Pesel.md "Validates PESEL (Polish human identification number)."
[Phone]: validators/Phone.md "Validates whether the input is a valid phone number. This validator requires"
[Pis]: validators/Pis.md "Validates a Brazilian PIS/NIS number ignoring any non-digit char."
[PolishIdCard]: validators/PolishIdCard.md "Validates whether the input is a Polish identity card (Dowód Osobisty)."
[PortugueseNif]: validators/PortugueseNif.md "Validates Portugal's fiscal identification number (NIF)."
[Positive]: validators/Positive.md "Validates whether the input is a positive number."
[PostalCode]: validators/PostalCode.md "Validates whether the input is a valid postal code or not."
[Printable]: validators/Printable.md "Similar to `Graph` but accepts whitespace."
[Property]: validators/Property.md "Validates an object property against a given validator."
[PropertyExists]: validators/PropertyExists.md "Validates if an object property exists."
[PropertyOptional]: validators/PropertyOptional.md "Validates an object property against a given validator only if the property exists."
[PublicDomainSuffix]: validators/PublicDomainSuffix.md "Validates whether the input is a public ICANN domain suffix."
[Punct]: validators/Punct.md "Validates whether the input composed by only punctuation characters."
[Readable]: validators/Readable.md "Validates if the given data is a file exists and is readable."
[Regex]: validators/Regex.md "Validates whether the input matches a defined regular expression."
[ResourceType]: validators/ResourceType.md "Validates whether the input is a resource."
[Roman]: validators/Roman.md "Validates if the input is a Roman numeral."
[Satisfies]: validators/Satisfies.md "Validates the input using the return of a given callable."
[ScalarVal]: validators/ScalarVal.md "Validates whether the input is a scalar value or not."
[Size]: validators/Size.md "Validates whether the input is a file that is of a certain size or not."
[Slug]: validators/Slug.md "Validates whether the input is a valid slug."
[Sorted]: validators/Sorted.md "Validates whether the input is sorted in a certain order or not."
[Space]: validators/Space.md "Validates whether the input contains only whitespaces characters."
[Spaced]: validators/Spaced.md "Validates if a string contains at least one whitespace (spaces, tabs, or line breaks);"
[StartsWith]: validators/StartsWith.md "Validates whether the input starts with a given value."
[StringType]: validators/StringType.md "Validates whether the type of an input is string or not."
[StringVal]: validators/StringVal.md "Validates whether the input can be used as a string."
[SubdivisionCode]: validators/SubdivisionCode.md "Validates subdivision country codes according to ISO 3166-2."
[Subset]: validators/Subset.md "Validates whether the input is a subset of a given value."
[SymbolicLink]: validators/SymbolicLink.md "Validates if the given input is a symbolic link."
[Templated]: validators/Templated.md "Defines a validator with a custom message template."
[Time]: validators/Time.md "Validates whether an input is a time or not. The `$format` argument should be in"
[Tld]: validators/Tld.md "Validates whether the input is a top-level domain."
[TrueVal]: validators/TrueVal.md "Validates if a value is considered as `true`."
[Undef]: validators/Undef.md "Validates if the given input is undefined. By _undefined_ we consider `null` or an empty string (`''`)."
[UndefOr]: validators/UndefOr.md "Validates the input using a defined validator when the input is not `null` or an empty string (`''`)."
[Unique]: validators/Unique.md "Validates whether the input array contains only unique values."
[Uppercase]: validators/Uppercase.md "Validates whether the characters in the input are uppercase."
[Url]: validators/Url.md "Validates whether the input is a valid URL in a popular internet format."
[Uuid]: validators/Uuid.md "Validates whether the input is a valid UUID. It also supports validation of"
[Version]: validators/Version.md "Validates version numbers using Semantic Versioning."
[Vowel]: validators/Vowel.md "Validates whether the input contains only vowels."
[When]: validators/When.md "A ternary validator that accepts three parameters."
[Writable]: validators/Writable.md "Validates if the given input is writable file."
[Xdigit]: validators/Xdigit.md "Validates whether the input is an hexadecimal number or not."
