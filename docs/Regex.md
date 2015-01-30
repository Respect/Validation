# Regex

- `v::regex(string $regex)`

Evaluates a regex on the input and validates if matches

```php
v::regex('/[a-z]/')->validate('a'); //true
```

Message template for this validator includes `{{regex}}`
