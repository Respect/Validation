# Max

- `Max(mixed $maxValue)`
- `Max(mixed $maxValue, bool $inclusive)`

Validates if the input doesn't exceed the maximum value.

```php
v::intVal()->max(15)->isValid(20); // false
v::intVal()->max(20)->isValid(20); // false
v::intVal()->max(20, true)->isValid(20); // true
```

Also accepts dates:

```php
v::dateTime()->max('2012-01-01')->isValid('2010-01-01'); // true
```

Also date intervals:

```php
// Same of minimum age validation
v::dateTime()->max('-18 years')->isValid('1988-09-09'); // true
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{maxValue}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [Min](Min.md)
- [Between](Between.md)
