# Changes in Respect\Validation 1.0

All notable changes of the Respect\Validation releases are documented in this file.

## 1.0.0 - 2015-10-24

### Added

- Create "CallableType" rule (#397)
- Create "Extension" rule (#360)
- Create "Factor" rule (#405)
- Create "Finite" rule (#397)
- Create "Infinite" rule (#397)
- Create "KeySet" rule (#374)
- Create "Mimetype" rule (#361)
- Create "Optional" rule (#423)
- Create "Resource" rule (#397)
- Create "Scalar" rule (#397)
- Create "Size" rule (#359)
- Create "SubdivisionCode" rule for 252 countries (#411)
- Create "VideoUrl" rule (#410)
- Create method `getMessages()` for nested exceptions (#406)

### Changed

- `AbstractRelated` (`Attribute`, `Call` and `Key`) define names for child rules (#365)
- Add country code to the message of "PostalCode" exception rule (#413)
- New generic top-level domains (#368)
- On exceptions, convert `Array` to string (#387)
- On exceptions, convert `Exception` to string (#399)
- On exceptions, convert `Traversable` to string (#399)
- On exceptions, convert resources to string (#399)
- On exceptions, do not display parent message then rule has only one child (#407)
- On exceptions, improve `Object` conversion to string (#399)
- On exceptions, improve conversion of all values by using JSON (#399)
- Use `filter_var()` on "True" and "FalseVal" rules (#409)

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
