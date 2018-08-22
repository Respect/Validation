# Between

- `v::between(mixed $start, mixed $end)`
- `v::between(mixed $start, mixed $end, boolean $inclusive = true)`

Validates ranges. Most simple example:

```php
v::intVal()->between(10, 20)->validate(15); // true
```

The type as the first validator in a chain is a good practice,
since between accepts many types:

```php
v::stringType()->between('a', 'f')->validate('c'); // true
```

Also very powerful with dates:

```php
v::date()->between('2009-01-01', '2013-01-01')->validate('2010-01-01'); // true
```

Date ranges accept strtotime values:

```php
v::date()->between('yesterday', 'tomorrow')->validate('now'); // true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::date()->between(10, 20, true)->validate(20); // true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

***
See also:

  * [Length](Length.md)
  * [Min](Min.md)
  * [Max](Max.md)
