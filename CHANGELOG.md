# Changes in Respect\Validation 1.0

All notable changes of the Respect\Validation releases are documented in this file.

## 1.0.0 - 2015-10-24

### Added

- Add "alpha-3" and "numeric" formats for "CountryCode" rule (#530)
- Add support for PHP 7 (#426)
- Create "Bsn" rule (#450)
- Create "CallableType" rule (#397)
- Create "Countable" rule (#566)
- Create "Extension" rule (#360)
- Create "Factor" rule (#405)
- Create "Finite" rule (#397)
- Create "Identical" rule (#442)
- Create "Infinite" rule (#397)
- Create "IntType" rule (#451)
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
- Remove `addOr()` shortcut (#444)
- Remove `not()` shortcut (#444)
- Remove identical checking from "Equals" rule (#442)
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

- Removed Deprecated Rules (#277)
- Validation rules do not accept an empty string by default (#422)

***
See also:

- [Contributing](CONTRIBUTING.md)
- [Feature Guide](docs/README.md)
- [Installation](docs/INSTALL.md)
- [License](LICENSE.md)
- [Validators](docs/VALIDATORS.md)
