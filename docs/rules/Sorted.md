# Sorted

- `Sorted(string $direction)`

Validates whether the input is sorted in a certain order or not.

```php
v::sorted('ASC')->isValid([1, 2, 3]); // true
v::sorted('ASC')->isValid('ABC'); // true
v::sorted('DESC')->isValid([3, 2, 1]); // true
v::sorted('ASC')->isValid([]); // true
v::sorted('ASC')->isValid([1]); // true
```

You can also combine [Call](Call.md) to create custom validations:

```php
v::call(
        static function (array $input): array {
            return array_column($input, 'key');
        },
        v::sorted('ASC')
    )->isValid([
        ['key' => 1],
        ['key' => 5],
        ['key' => 9],
    ]); // true

v::call('strval', v::sorted('DESC'))->isValid(4321); // true

v::call('iterator_to_array', v::sorted())->isValid(new ArrayIterator([1, 7, 4])); // false
```

## Categorization

- Arrays
- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Add support for strings
  2.0.0 | Do not use array keys to sort
  2.0.0 | Use sorting direction instead of boolean value
  2.0.0 | Do not accept callback in the constructor
  1.1.1 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [Call](Call.md)
