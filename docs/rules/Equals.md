# Equals

- `v::equals(mixed $value)`

Validates if the input is equal to some value.

```php
v::equals('alganet')->validate('alganet'); // true
```

Message template for this validator includes `{{compareTo}}`.

***
See also:

  * [Contains](Contains.md)
  * [Identical](Identical.md)
  * [KeyValue](KeyValue.md)
  * [Version](Version.md)
