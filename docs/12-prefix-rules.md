# Prefix Rules

Prefix rules provide a concise syntax for common validation patterns that would otherwise require verbose chaining.

## Available Prefixes

- `key` - For array key validation
- `property` - For object property validation
- `length` - For length-based validations
- `max` - For maximum value validations
- `min` - For minimum value validations
- `nullOr` - For null or valid value validations
- `undefOr` - For undefined or valid value validations

## Usage

Prefix rules follow the pattern `{prefix}{RuleName}` where the prefix is combined with any existing rule name.

### Key Prefix

```php
// Traditional chaining
v::key('email', v::email())
v::key('age', v::intVal()->positive())

// Prefix syntax
v::keyEmail('email')
v::keyPositive('age')
v::keyBetween('score', 0, 100)
```

### Property Prefix

```php
// Traditional chaining
v::property('email', v::email())
v::property('age', v::intVal()->positive())

// Prefix syntax
v::propertyEmail('email')
v::propertyPositive('age')
v::propertyBetween('score', 0, 100)
```

### Length Prefix

```php
// Traditional chaining
v::length(v::between(5, 20))

// Prefix syntax
v::lengthBetween(5, 20)
v::lengthEqual(10)
v::lengthMin(5)
v::lengthMax(20)
```

### Max Prefix

```php
// Traditional chaining
v::max(v::lessThan(100))

// Prefix syntax
v::maxLessThan(100)
v::maxEquals(50)
```

### Min Prefix

```php
// Traditional chaining
v::min(v::greaterThan(0))

// Prefix syntax
v::minGreaterThan(0)
v::minEquals(10)
```

### NullOr Prefix

```php
// Traditional chaining
v::nullOr(v::email())
v::nullOr(v::intVal()->positive())

// Prefix syntax
v::nullOrEmail()
v::nullOrPositive()
v::nullOrBetween(1, 100)
```

### UndefOr Prefix

```php
// Traditional chaining
v::undefOr(v::email())
v::undefOr(v::intVal()->positive())

// Prefix syntax
v::undefOrEmail()
v::undefOrPositive()
v::undefOrBetween(1, 100)
```

## Benefits

1. **Conciseness**: Reduce boilerplate for single-rule validations
2. **Readability**: More natural language for common patterns
3. **Performance**: Slightly more performant as they avoid intermediate rule creation

## When to Use

Use prefix rules for simple, single-rule validations. For complex compositions, continue using traditional chaining:

```php
// Good use of prefix rules
v::keyEmail('email')
v::propertyPositive('age')
v::nullOrBetween('score', 0, 100)

// Complex validations still use chaining
v::keySet(
    v::key('user', v::keySet(
        v::keyEmail('email'),
        v::keyLengthBetween('username', 3, 20)
    )),
    v::keyOptional('profile', v::propertyExists('bio'))
)
```

## See Also

- [Key](rules/Key.md)
- [Property](rules/Property.md)
- [Length](rules/Length.md)
- [Max](rules/Max.md)
- [Min](rules/Min.md)
- [NullOr](rules/NullOr.md)
- [UndefOr](rules/UndefOr.md)