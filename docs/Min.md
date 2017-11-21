# Min

- `Min(mixed $minValue)`
- `Min(mixed $minValue, bool $inclusive)`

Validates if the input is greater than the minimum value.

```php
v::intVal()->min(15)->isValid(5); // false
v::intVal()->min(5)->isValid(5); // false
v::intVal()->min(5, true)->isValid(5); // true
```

Also accepts dates:

```php
v::dateTime()->min('2012-01-01')->isValid('2015-01-01'); // true
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{minValue}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [Max](Max.md)
- [Between](Between.md)
