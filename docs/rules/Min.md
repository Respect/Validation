# Min

- `v::min(mixed $minValue)`
- `v::min(mixed $minValue, boolean $inclusive = true)`

Validates if the input is greater than the minimum value.

```php
v::intVal()->min(15)->validate(5); // false
v::intVal()->min(5)->validate(5); // false
v::intVal()->min(5, true)->validate(5); // true
```

Also accepts dates:

```php
v::date()->min('2012-01-01')->validate('2015-01-01'); // true
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{minValue}}`.

***
See also:

  * [Age](Age.md)
  * [Between](Between.md)
  * [Max](Max.md)
