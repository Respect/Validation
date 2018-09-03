# Imei

- `Imei()`

Validates is the input is a valid [IMEI][].

```php
v::imei()->isValid('35-209900-176148-1'); // true
v::imei()->isValid('490154203237518'); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)

[IMEI]: https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity "International Mobile Station Equipment Identity"
