# Comparable values

For certain types you can't make comparisons out of the box in PHP but
Validation brings support to a few of them.

You can make comparison with the following data types:

- Countable: any object that implements `Countable` interface
- DateTimeInterface
- Numeric types
- Single character string
- Primitive types in general: normal operation comparison made by PHP
- Time string: [date and time format](http://php.net/datetime.formats) 
that can be parsed by PHP

Below you can see some examples:

```php
v::min(100)->validate($collection); // true if it has at least 100 items

v::dateTime()
    ->between(new DateTime('yesterday'), new DateTime('tomorrow'))
    ->validate(new DateTime('now')); // true

v::numericVal()->max(10)->validate(5); // true

v::stringVal()->between('a', 'f')->validate('d'); // true

v::dateTime()->between('yesterday', 'tomorrow')->validate('now'); // true
```