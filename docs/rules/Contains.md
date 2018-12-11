# Contains

- `v::contains(mixed $value)`
- `v::contains(mixed $value, boolean $identical = false)`

For strings:

```php
v::contains('ipsum')->validate('lorem ipsum'); // true
```

For arrays:

```php
v::contains('ipsum')->validate(['ipsum', 'lorem']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{containsValue}}`.

***
See also:

  * [EndsWith](EndsWith.md)
  * [Equals](Equals.md)
  * [Identical](Identical.md)
  * [In](In.md)
  * [Regex](Regex.md)
  * [StartsWith](StartsWith.md)
