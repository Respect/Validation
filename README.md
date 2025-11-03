# Respect\Validation

[![Build Status](https://img.shields.io/github/actions/workflow/status/Respect/Validation/continuous-integration.yml?branch=main&style=flat-square)](https://github.com/Respect/Validation/actions/workflows/continuous-integration.yml)
[![Code Coverage](https://img.shields.io/codecov/c/github/Respect/Validation?style=flat-square)](https://codecov.io/gh/Respect/Validation)
[![Latest Stable Version](https://img.shields.io/packagist/v/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![License](https://img.shields.io/packagist/l/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)

The most awesome validation engine ever created for PHP.

## Quick Example

```php
use Respect\Validation\Validator as v;

// Simple validation
v::email()->assert('user@example.com');

// Chained rules
v::intVal()->positive()->between(1, 100)->assert(50);

// Complex structures with prefix rules
v::keySet(
    v::keyEmail('email'),
    v::key('age', v::intVal()->between(18, 120))
)->assert($userData);

// PHP 8 attributes support
#[Attribute]
class User {
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
}

v::attributes()->assert($user);
```

- Complex rules made simple: `v::numericVal()->positive()->between(1, 255)->isValid($input)`.
- [Granularity control](docs/03-handling-exceptions.md) for advanced reporting.
- [More than 150](docs/09-list-of-rules-by-category.md) (fully tested) validation rules.
- [A concrete API](docs/06-concrete-api.md) for non fluent usage.
- [Prefix rules](docs/12-prefix-rules.md) for concise validation patterns.
- [PHP 8 attributes](docs/02-feature-guide.md#using-rules-as-attributes) support.

## Version 3.0

Version 3.0 introduces significant improvements to validation architecture, naming consistency, and modern PHP support:

- **Breaking Changes**:
  - Validation methods (`assert`, `check`) now only available on `Validator` class
  - Multiple rule renames for semantic clarity (e.g., `nullable` → `nullOr`)
  - Removed age-specific rules in favor of general `DateTimeDiff`
  - Minimum PHP version: 8.1

- **New Features**:
  - Prefix rules for concise validation patterns (e.g., `v::keyEmail('field')`)
  - PHP 8 attributes support for declarative validation
  - Enhanced error paths for nested structures
  - Flexible `assert()` overloads (templates, exceptions, callables)

**See Also**: [Migration Guide](docs/11-migration-from-2x.md)

**Support**: Version 2.x receives critical security fixes until 2026-05-03.

Learn More:

* [Documentation](https://respect-validation.readthedocs.io)
* [How to contribute](CONTRIBUTING.md)
* [Migration from 2.x](docs/11-migration-from-2x.md)
