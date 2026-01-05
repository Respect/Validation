# Comparing empty values

The [Undef](rules/Undef.md), [Blank](rules/Blank.md), and [Falsy](rules/Falsy.md) validators all validate "empty-like" values, but they differ in strictness and use cases. This guide helps you understand when to use each one.

## Quick Comparison

| Input            | Undef | Falsy | Blank |
| ---------------- | :---: | :---: | :---: |
| `null`           |  ✅   |  ✅   |  ✅   |
| `''`             |  ✅   |  ✅   |  ✅   |
| `' '`            |  ❌   |  ❌   |  ✅   |
| `0`              |  ❌   |  ✅   |  ✅   |
| `0.0`            |  ❌   |  ✅   |  ✅   |
| `'0'`            |  ❌   |  ✅   |  ✅   |
| `'0.0'`          |  ❌   |  ❌   |  ✅   |
| `false`          |  ❌   |  ✅   |  ✅   |
| `[]`             |  ❌   |  ✅   |  ✅   |
| `['']`           |  ❌   |  ❌   |  ✅   |
| `[0]`            |  ❌   |  ❌   |  ✅   |
| `[' ']`          |  ❌   |  ❌   |  ✅   |
| `new stdClass()` |  ❌   |  ❌   |  ✅   |

Legend: ✅ = valid (passes the validation), ❌ = invalid (does not pass the validation)

## Understanding Each Validator

### Undef (Most Restrictive)

The `Undef` validator is the most restrictive. It only considers two values as "undefined":

- `null`
- `''` (empty string)

This validator is ideal when you want to check if a value was explicitly not provided, such as an optional form field that was left empty or a missing API parameter.

```php
v::undef()->isValid(null); // true
v::undef()->isValid('');   // true
v::undef()->isValid(0);    // false - 0 is a defined value
v::undef()->isValid(' ');  // false - whitespace is defined
```

**Use when:** You need to distinguish between "no value provided" and "any value provided" (including zeros, whitespace, and empty arrays).

### Falsy (Moderate)

The `Falsy` validator uses PHP's native `empty()` function behavior. It considers values that PHP treats as "empty" in boolean contexts:

- `null`
- `''` (empty string)
- `0`, `0.0` (zero numbers)
- `'0'` (string zero)
- `false`
- `[]` (empty array)

```php
v::falsy()->isValid(null);  // true
v::falsy()->isValid('');    // true
v::falsy()->isValid(0);     // true
v::falsy()->isValid('0');   // true
v::falsy()->isValid(false); // true
v::falsy()->isValid([]);    // true
v::falsy()->isValid(' ');   // false - whitespace is not empty()
```

**Use when:** You want to match PHP's native "truthiness" behavior, such as validating values that would fail an `if ($value)` check.

### Blank (Most Permissive)

The `Blank` validator is the most permissive. It considers a value blank if it contains no meaningful content:

- Everything that `Falsy` considers falsy
- Whitespace-only strings (` `, `\t`, `\n`)
- Numeric strings representing zero (`'0.0'`, `'0.00'`)
- Arrays containing only blank values (recursively)
- Empty `stdClass` objects

```php
v::blank()->isValid(null);           // true
v::blank()->isValid('');             // true
v::blank()->isValid('   ');          // true - whitespace only
v::blank()->isValid('0.0');          // true - numeric zero string
v::blank()->isValid(['']);           // true - array with blank value
v::blank()->isValid([[''], [0]]);    // true - nested blanks
v::blank()->isValid(new stdClass()); // true - empty object
```

**Use when:** You want to check if a value has any meaningful content at all, ignoring whitespace, zeros, and empty nested structures.

## Common Scenarios

### Form Validation

```php
// Accept field only if user typed something meaningful
v::not(v::blank())->isValid($userInput);

// Check if optional field was provided at all
v::not(v::undef())->isValid($optionalField);
```

### API Validation

```php
// Parameter must be defined (null and empty string are not acceptable)
v::not(v::undef())->isValid($requiredParam);

// Parameter can be zero but not empty
v::not(v::undef())->isValid(0); // passes - 0 is defined
```

### Conditional Logic

```php
// Match PHP's if() behavior
v::falsy()->isValid($value); // same as: !$value

// Check for truly empty values beyond PHP's empty()
v::blank()->isValid($value);
```

## Decision Guide

Choose the validator based on what you consider "empty":

1. **Use `Undef`** when only `null` and `''` should be considered empty. Zero, false, and empty arrays are valid values.

2. **Use `Falsy`** when you want to match PHP's `empty()` behavior. Good for boolean-like checks.

3. **Use `Blank`** when whitespace-only strings, nested empty arrays, and empty objects should also be considered empty.

---

See also:

- [Undef](rules/Undef.md)
- [Blank](rules/Blank.md)
- [Falsy](rules/Falsy.md)
- [NullType](rules/NullType.md)
