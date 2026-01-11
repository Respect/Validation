# Respect\Validation

[![Build Status](https://img.shields.io/github/actions/workflow/status/Respect/Validation/continuous-integration.yml?branch=main&style=flat-square)](https://github.com/Respect/Validation/actions/workflows/continuous-integration.yml)
[![Code Coverage](https://img.shields.io/codecov/c/github/Respect/Validation?style=flat-square)](https://codecov.io/gh/Respect/Validation)
[![Latest Stable Version](https://img.shields.io/packagist/v/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![License](https://img.shields.io/packagist/l/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)

The most awesome validation engine ever created for PHP.

- Complex validation made simple: `v::numericVal()->positive()->between(1, 255)->isValid($input)`.
- [Granularity control](docs/handling-exceptions.md) for advanced reporting.
- [More than 150](docs/validators/index.md) (fully tested) validators.
- [A concrete API](docs/concrete-api.md) for non fluent usage.

Learn More:

* [Documentation](https://respect-validation.readthedocs.io)
* [How to contribute](CONTRIBUTING.md)
