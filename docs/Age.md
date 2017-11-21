# Age

- `Age(int $minAge)`
- `Age(int $minAge, int $maxAge)`
- `Age(null, int $maxAge)`

Validates ranges of years.

The validated values can be any date value; internally they will be transformed
into [DateTime](http://php.net/manual/en/class.datetime.php) objects according
to the defined locale settings.

The examples below validate if the given dates are lower or equal to 18 years ago:
```php
v::age(18)->isValid('17 years ago'); // false
v::age(18)->isValid('18 years ago'); // true
v::age(18)->isValid('19 years ago'); // true
v::age(18)->isValid('1970-01-01'); // true
v::age(18)->isValid('today'); // false
```

The examples below validate if the given dates are between 10 and 50 years ago:
```php
v::age(10, 50)->isValid('9 years ago'); // false
v::age(10, 50)->isValid('10 years ago'); // true
v::age(10, 50)->isValid('30 years ago'); // true
v::age(10, 50)->isValid('50 years ago'); // true
v::age(10, 50)->isValid('51 years ago'); // false
```

The examples below validate if the given dates are greater than or equal to 70 years ago:
```php
v::age(null, 70)->isValid('today'); // true
v::age(null, 70)->isValid('70 years ago'); // true
v::age(null, 70)->isValid('71 years ago'); // false
```

Message template for this validator includes `{{minAge}}` and `{{maxAge}}`.

## Changelog

Version | Description
--------|-------------
  0.9.0 | Created based on deprecated `MinimumAge` rule

***
See also:

- [Between](Between.md)
- [DateTime](DateTime.md)
- [Max](Max.md)
- [Min](Min.md)
