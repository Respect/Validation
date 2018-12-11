# Pesel

- `v::pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->validate('21120209256'); // true
v::pesel()->validate('97072704800'); // true
v::pesel()->validate('97072704801'); // false
v::pesel()->validate('PESEL123456'); // false
```
See also:

  * [IdentityCard](IdentityCard.md)
