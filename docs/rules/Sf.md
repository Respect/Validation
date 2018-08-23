# Sf

- `Sf(Constraint $constraint)`
- `Sf(Constraint $constraint, ValidatorInterface $validator)`

Validate the input with a Symfony Validator (>=4.0 or >=3.0) Constraint.

```php
use Symfony\Component\Validator\Constraint\Iban;

v::sf(new Iban())->validate('NL39 RABO 0300 0652 64'); // true
```

This rule will keep all the messages returned from Symfony.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Do not create constraints anymore
  2.0.0 | Upgraded support to version >=4.0 or >=3.0 of Symfony Validator
  0.3.9 | Created

***
See also:

- [Zend](Zend.md)
