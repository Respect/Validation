# Respect\Validation

[![Build Status](https://img.shields.io/github/actions/workflow/status/Respect/Validation/continuous-integration.yml?branch=master&style=flat-square)](https://github.com/Respect/Validation/actions/workflows/continuous-integration.yml)
[![Code Coverage](https://img.shields.io/codecov/c/github/Respect/Validation?style=flat-square)](https://codecov.io/gh/Respect/Validation)
[![Latest Stable Version](https://img.shields.io/packagist/v/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![License](https://img.shields.io/packagist/l/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)

The most awesome validation engine ever created for PHP.

- Complex rules made simple: `v::numericVal()->positive()->between(1, 255)->validate($input)`.
- [Granularity control](docs/02-feature-guide.md#validation-methods) for advanced reporting.
- [More than 150](docs/08-list-of-rules-by-category.md) (fully tested) validation rules.
- [A concrete API](docs/05-concrete-api.md) for non fluent usage.

Learn More:

* [Documentation](https://respect-validation.readthedocs.io)
* [How to contribute](CONTRIBUTING.md)
