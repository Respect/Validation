# IBAN ( International Bank Account Number )

- `v::IBAN()`

Validates if the input is a valid IBAN.

```php
v::IBAN()->validate('SE35 5000 0000 0549 1000 0003'); // true
v::IBAN()->validate('ch9300762011623852957'); // true

v::IBAN()->validate('ZZ32 5000 5880 7742'); // false
v::IBAN()->validate(123456789); // false
v::IBAN()->validate(''); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [CreditCard](CreditCard.md)
- [PostalCode](PostalCode.md)
- [MacAddress](MacAddress.md)
