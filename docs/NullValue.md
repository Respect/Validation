# NullValue

- `v::nullValue()`

Validates if the input is null. This rule does not allow empty strings to avoid ambiguity.

```php
v::nullValue()->validate(null); //true
```

See also:

  * [NotEmpty](NotEmpty.md)
