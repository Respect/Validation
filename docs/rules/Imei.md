# Imei

- `v::imei()`

Validates is the input is a valid [IMEI][].

```php
v::imei()->validate('35-209900-176148-1'); // true
v::imei()->validate('490154203237518'); // true
```

***
See also:

  * [Bsn](Bsn.md)
  * [Cnh](Cnh.md)
  * [Cnpj](Cnpj.md)
  * [Cpf](Cpf.md)

[IMEI]: https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity "International Mobile Station Equipment Identity"
