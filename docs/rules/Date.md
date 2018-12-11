# Date

- `v::date()`
- `v::date(string $format)`

Validates if input is a date:

```php
v::date()->validate('2009-01-01'); // true
```

Also accepts strtotime values:

```php
v::date()->validate('now'); // true
```

And DateTime instances:

```php
v::date()->validate(new DateTime); // true
```

You can pass a format when validating strings:

```php
v::date('Y-m-d')->validate('01-01-2009'); // false
```

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{format}}`.

***
See also:

  * [Age](Age.md)
  * [Between](Between.md)
  * [LeapDate](LeapDate.md)
  * [LeapYear](LeapYear.md)
  * [MinimumAge](MinimumAge.md)
