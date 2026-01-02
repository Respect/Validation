# KeySet

- `KeySet(KeyRelated $rule, KeyRelated ...$rules)`

Validates a keys in a defined structure.

```php
v::keySet(
    v::keyExists('foo'),
    v::keyExists('bar')
)->isValid(['foo' => 'whatever', 'bar' => 'something']); // true
```

It will validate the keys in the array with the rules passed in the constructor.

```php
v::keySet(
    v::key('foo', v::intVal())
)->isValid(['foo' => 42]); // true

v::keySet(
    v::key('foo', v::intVal())
)->isValid(['foo' => 'string']); // false
```

Extra keys are not allowed:

```php
v::keySet(
    v::key('foo', v::intVal())
)->isValid(['foo' => 42, 'bar' => 'String']); // false
```

Missing required keys are not allowed:

```php
v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::key('baz', v::boolType())
)->isValid(['foo' => 42, 'bar' => 'String']); // false
```

Missing non-required keys are allowed:

```php
v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::keyOptional('baz', v::boolType())
)->isValid(['foo' => 42, 'bar' => 'String']); // true
```

Alternatively, you can pass a chain of key-related rules to `keySet()`:

```php
v::keySet(
    v::init()
        ->key('foo', v::intVal())
        ->key('bar', v::stringType())
        ->keyOptional('baz', v::boolType())
)->isValid(['foo' => 42, 'bar' => 'String']); // true
```

It is not possible to negate `keySet()` rules with `not()`.

The keys' order is not considered in the validation.

## Templates

### `KeySet::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} validation failed |
| `inverted` | {{subject}} validation passed |

### `KeySet::TEMPLATE_BOTH`

| Mode       | Template                                         |
| ---------- | ------------------------------------------------ |
| `default`  | {{subject}} contains both missing and extra keys |
| `inverted` | {{subject}} contains no missing or extra keys.   |

### `KeySet::TEMPLATE_EXTRA_KEYS`

| Mode       | Template                           |
| ---------- | ---------------------------------- |
| `default`  | {{subject}} contains extra keys    |
| `inverted` | {{subject}} contains no extra keys |

### `KeySet::TEMPLATE_MISSING_KEYS`

| Mode       | Template                             |
| ---------- | ------------------------------------ |
| `default`  | {{subject}} contains missing keys    |
| `inverted` | {{subject}} contains no missing keys |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Nesting
- Structures

## Changelog

| Version | Description                                           |
| ------: | ----------------------------------------------------- |
|   3.0.0 | Requires at least one key-related rule                |
|   2.3.0 | KeySet is NonNegatable, fixed message with extra keys |
|   1.0.0 | Created                                               |

---

See also:

- [ArrayVal](ArrayVal.md)
- [Key](Key.md)
