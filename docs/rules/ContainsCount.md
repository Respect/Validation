# ContainsCount

- `ContainsCount(mixed $expectedValue, int $count)`

Validates if the input contains a value a certain number of times.

For strings, it counts how many times the value appears as a substring:

```php
v::containsCount('a', 3)->isValid('banana'); // true
```

For arrays, it counts how many items are identical to the value:

```php
v::containsCount('foo', 2)->isValid(['foo', 'bar', 'foo']); // true
```

Message template for this validator includes `{{containsValue}}` and `{{count}}`.

## Categorization

- Arrays
- Strings

## Changelog

Version | Description
--------|-------------
  2.5.0 | Created

***
See also:

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [In](In.md)
- [Unique](Unique.md)
