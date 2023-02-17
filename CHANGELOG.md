# Changes in Respect\Validation 2.x

## 2.3

Versioning Changes:

 - Dropped support for PHP 8.0 and below.
 - Updated dev dependencies

Deprecations:

 - Symfony façade validators are no longer supported and were
   removed.

Fixes:

 - `KeySet` now reports which extra keys are causing the rule to fail.
 - Ensure empty strings are never a valid currency code
 - Do not hide messages on EachException
 - Dot not throw exception when validating an uninitialized property

Changes:

 - You can no longer wrap `KeySet` in `Not`.
 - `Phone` now uses `giggsey/libphonenumber-for-php`, this package needs
   to be installed if you want to use this validator.
 - `Phone` now supports the parameter `$countryCode` to validate phones
   of a specific country.

## 2.2.4

Meta:

 - CHANGELOG.md is being written once again to provide an overview
   of active changes to the API and codebase.

Versioning Changes:

 - Dropped PHP 7.3 support. 
 - Added support for PHP 8.0 and PHP 8.1. This will be the
   last release with PHP 7.4 support. Support for PHP 8.2 is considered
   experimental, local development should be done at 8.1.

Deprecations:

 - Zend Framework façade validators are no longer supported and were
   removed.
 - Symfony façade validators are no longer suggested, and will be
   removed in release 2.3.
 - v::dateTime('z') is not supported anymore in PHP8, and should not be relied upon

Fixes:
 - Updated bin/update-currency-codes to fetch XML from another source.
 - Updated bin/update-iso-codes to new file format.
 - Updated regionals (CountryCode.php, CurrencyCode.php, Tld.php) (2023-02-13).
 - Added RuPay card validation (thanks @rakshit087)
 - Fixed `v::decimal()` for float values (thanks @scruwi)
 - Added `v::portugueseNif()` to validate _Número de Identificação Fiscal_ in Portugal (thanks @goncalo-andrade).
 - Allow 5-digit and 6-digit postal codes for Cambodia (thanks @omega3000)
 - `v::intval()` now handles negative values with trailing zeroes better (thanks @l-x)

## 2.2.x

Changelogs between 1.1.0 and 2.2.4 are available only through `git log` and GitHub Releases.

# Changes in Respect\Validation 1.x

All notable changes of the Respect\Validation releases are documented in this file.

## 1.1.0 - 2016-04-24

### Added

- Create "Fibonacci" rule (#637)
- Create "IdentityCard" rule (#632)
- Create "Image" rule (#621)
- Create "LanguageCode" rule (#597)
- Create "Pesel" rule (#616)
- Create "PhpLabel" rule (#652)

### Changed

- Allow the define brands for credit card validation (#661)
- Define names for the child of Not rule (#641)
- Ensure namespace separator on appended prefixes (#666)
- Length gets length of integers (#643)
- Set template for the only rule in the chain (#663)
- Throw an exception when age is not an integer (#667)
- Use "{less/greater} than or equal to" phrasing (#604)

## 1.0.0 - 2015-10-24

### Added

- Add "alpha-3" and "numeric" formats for "CountryCode" rule (#530)
- Add support for PHP 7 (#426)
- Create "BoolVal" rule (#583)
- Create "Bsn" rule (#450)
- Create "CallableType" rule (#397)
- Create "Countable" rule (#566)
- Create "CurrencyCode" rule (#567)
- Create "Extension" rule (#360)
- Create "Factor" rule (#405)
- Create "Finite" rule (#397)
- Create "FloatType" rule (#565)
- Create "Identical" rule (#442)
- Create "Imei" rule (#590)
- Create "Infinite" rule (#397)
- Create "IntType" rule (#451)
- Create "Iterable" rule (#570)
- Create "KeyNested" rule (#429)
- Create "KeySet" rule (#374)
- Create "KeyValue" rule (#441)
- Create "Mimetype" rule (#361)
- Create "NotBlank" rule (#443)
- Create "NotOptional" rule (#448)
- Create "Optional" rule (#423)
- Create "ResourceType" rule (#397)
- Create "ScalarVal" rule (#397)
- Create "Size" rule (#359)
- Create "SubdivisionCode" rule for 252 countries (#411)
- Create "VideoUrl" rule (#410)
- Create method `getMessages()` for nested exceptions (#406)

### Changed

- Add country code to the message of "PostalCode" exception rule (#413)
- Make "ArrayVal" validate only if the input can be used as an array (#574)
- Make "Between" rule inclusive (#445)
- Make "Max" rule inclusive (#445)
- Make "Min" rule inclusive (#445)
- New generic top-level domains (#368)
- On `AbstractRelated` (`Attribute`, `Call` and `Key`) define names for child rules (#365)
- On exceptions, convert `Array` to string (#387)
- On exceptions, convert `Exception` to string (#399)
- On exceptions, convert `Traversable` to string (#399)
- On exceptions, convert resources to string (#399)
- On exceptions, do not display parent message then rule has only one child (#407)
- On exceptions, improve `Object` conversion to string (#399)
- On exceptions, improve conversion of all values by using JSON (#399)
- On exceptions, nested messages are displayed in a Markdown list (#588)
- Rename exception class "AbstractGroupedException" to "GroupedValidationException" (#591)
- Rename exception class "AbstractNestedException" to "NestedValidationException" (#591)
- Rename rule "Arr" to "ArrayVal"
- Rename rule "Bool" to "BoolType" (#426)
- Rename rule "False" to "FalseVal" (#426)
- Rename rule "Float" to "FloatVal" (#426)
- Rename rule "Int" to "IntVal" (#426)
- Rename rule "NullValue" to "NullType"
- Rename rule "Object" to "ObjectType"
- Rename rule "String" to "StringType" (#426)
- Rename rule "True" to "TrueVal" (#426)
- Use `filter_var()` on "TrueVal" and "FalseVal" rules (#409)

### Removed

- Drop support for PHP 5.3 (#466)
- Remove `addOr()` shortcut (#444)
- Remove `NestedValidationExceptionInterface` interface (#591)
- Remove `not()` shortcut (#444)
- Remove `ValidationExceptionInterface` interface (#591)
- Remove identical checking from "Equals" rule (#442)
- Removed Deprecated Rules (#277)
- Validation rules do not accept an empty string by default (#422)
