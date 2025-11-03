# Migration Guide: Upgrading from 2.x to 3.0

**Version**: 3.0.0  
**Last Updated**: 2025-11-03  
**Maintenance Policy**: Version 2.x receives critical security fixes only until 2026-05-03

## Overview

Version 3.0 streamlines Respect\Validation with a simpler validation engine, consistent naming, and modern PHP features. This guide helps you upgrade from 2.x with minimal disruption.

**Key Goals**:

- Simpler API surface (validation methods on `Validator` only)
- Consistent rule naming (clear semantics)
- Modern PHP idioms (attributes, strict types)
- Better error messaging (structured results with paths)

**Upgrade Effort**: Most projects require 1-4 hours for straightforward migrations. Complex validation logic may need additional review.

## Quick Start

### Minimum PHP Version

**v2.x**: PHP 8.0+  
**v3.0**: PHP 8.1+

Update `composer.json`:

```json
{
    "require": {
        "php": ">=8.1",
        "respect/validation": "^3.0"
    }
}
```

### Installation

```bash
composer require respect/validation:^3.0
```

## Breaking Changes

### 1. Validator Construction (HIGH IMPACT)

**What Changed**: `assert()` and `check()` removed from individual rule classes.

**v2.x Pattern**:
```php
use Respect\Validation\Rules\Email;

$email = new Email();
$email->assert($input); // No longer works in v3
```

**v3.0 Pattern**:
```php
use Respect\Validation\Validator as v;

v::email()->assert($input); // Use facade
// OR
$validator = new Validator(new Email());
$validator->assert($input); // Explicit wrapper
```

**Migration Strategy**:

- **Automated**: Find `new {Rule}(); $var->assert(` and replace with `v::{rule}()->assert(`
- **Manual review**: Complex rule compositions may need restructuring

**Why**: Centralizing validation methods simplifies exception handling and enables flexible error formatting.

---

### 2. Rule Renames (MEDIUM IMPACT)

**What Changed**: Several rules renamed for clarity and consistency.

| v2.x Name | v3.0 Name | Find/Replace Safe? |
|-----------|-----------|-------------------|
| `nullable()` | `nullOr()` | ✅ Yes |
| `optional()` | `undefOr()` | ✅ Yes |
| `min()` | `greaterThanOrEqual()` | ⚠️ Context-dependent* |
| `max()` | `lessThanOrEqual()` | ⚠️ Context-dependent* |
| `attribute()` | `property()` | ✅ Yes |
| `notOptional()` | `notUndef()` | ✅ Yes |

*New `min()` and `max()` exist as prefix rules with different semantics. Review usage before replacing.

**Migration Examples**:

```php
// v2.x
v::nullable(v::email())
v::optional(v::intVal())
v::attribute('name', v::stringType())

// v3.0
v::nullOr(v::email())
v::undefOr(v::intVal())
v::property('name', v::stringType())
```

**Migration Strategy**:

1. Run find/replace for safe renames (✅ marked)
2. Search for `->min(` and `->max(` calls
3. Determine if value comparison or prefix rule
4. Replace with `greaterThanOrEqual`/`lessThanOrEqual` or new prefix pattern

**Why**: `nullOr`/`undefOr` distinguish null vs undefined handling; `greaterThanOrEqual` is semantically explicit.

---

### 3. Removed Rules (HIGH IMPACT)

**What Changed**: Age-related and composite rules removed in favor of general-purpose alternatives.

| Removed Rule | v3.0 Replacement | Migration Path |
|--------------|------------------|----------------|
| `age($years)` | `dateTimeDiff('years', $years)` | [See example below] |
| `minAge($years)` | `dateTimeDiff()->greaterThanOrEqual()` | [See example below] |
| `maxAge($years)` | `dateTimeDiff()->lessThanOrEqual()` | [See example below] |
| `keyValue($key, $comparedKey)` | `key($key, v::equals($value))` | Use explicit chaining |
| `consecutive(...)` | `lazy(...)` | Replace with `lazy()` rule |

**Age Validation Migration**:

```php
// v2.x: Exact age
v::age(18)

// v3.0: Exact age
v::dateTimeDiff('years', now())->equals(18)

// v2.x: Minimum age
v::minAge(18)

// v3.0: Minimum age (18 or older)
v::dateTimeDiff('years', now())->greaterThanOrEqual(18)

// v2.x: Maximum age
v::maxAge(65)

// v3.0: Maximum age (65 or younger)
v::dateTimeDiff('years', now())->lessThanOrEqual(65)

// v2.x: Age range
v::minAge(18)->maxAge(65)

// v3.0: Age range
v::dateTimeDiff('years', now())->between(18, 65)
```

**KeyValue Migration**:

```php
// v2.x
v::keyValue('password', 'password_confirmation')

// v3.0: Explicit comparison
v::key('password_confirmation', v::equals($input['password']))
```

**Migration Strategy**: Search codebase for removed rule names; apply patterns above.

**Why**: `DateTimeDiff` is general-purpose and composable; age rules were too specific.

---

### 4. Split Rules (MEDIUM IMPACT)

**What Changed**: `Key` and `Attribute` (now `Property`) split into specialized variants.

| v2.x | v3.0 Options | Use Case |
|------|--------------|----------|
| `key($name, $rule)` | `key($name, $rule)` | Validate key value (key must exist) |
| `key($name, $rule)` | `keyExists($name)` | Check key exists (any value) |
| `key($name, $rule)` | `keyOptional($name, $rule)` | Validate if key present; pass if absent |
| `attribute($name, $rule)` | `property($name, $rule)` | Validate property value (property must exist) |
| `attribute($name, $rule)` | `propertyExists($name)` | Check property exists (any value) |
| `attribute($name, $rule)` | `propertyOptional($name, $rule)` | Validate if property present; pass if absent |

**Migration Examples**:

```php
// v2.x: Key must exist with valid value
v::key('email', v::email())

// v3.0: Same behavior
v::key('email', v::email())

// v2.x: Key must exist (no value validation)
v::key('email')

// v3.0: Explicit existence check
v::keyExists('email')

// v2.x: Validate key if present
// (v2.x required custom logic)

// v3.0: Built-in optional validation
v::keyOptional('referral_code', v::uuid())
```

**Migration Strategy**: Review all `key()` and `attribute()` calls; determine if existence check or optional validation applies; use appropriate v3 variant.

**Why**: Explicit variants reduce ambiguity and eliminate need for nullable/optional workarounds.

---

### 5. Message Customization (MEDIUM IMPACT)

**What Changed**: `setName()` and `setTemplate()` replaced by `Named` and `Templated` rules.

**v2.x Pattern**:
```php
v::email()
    ->setName('Email Address')
    ->setTemplate('{{name}} is invalid');
```

**v3.0 Pattern**:
```php
v::named(v::email(), 'Email Address');
v::templated(v::email(), '{{name}} is invalid');

// Or combined
v::templated(
    v::named(v::email(), 'Email Address'),
    '{{name}} is invalid'
);
```

**Enhanced `assert()` Overloads** (v3.0 only):

```php
// Template string
v::email()->assert($input, 'Must be a valid email');

// Template array (per rule)
v::intVal()->positive()->lessThan(100)->assert($input, [
    'intVal' => 'Must be an integer',
    'positive' => 'Must be positive',
    'lessThan' => 'Must be under 100',
]);

// Custom exception
v::email()->assert($input, new DomainException('Invalid email'));

// Callable handler
v::email()->assert($input, fn($ex) => logError($ex));
```

**Migration Strategy**:

1. Search for `->setName(` and replace with `named()` wrapper
2. Search for `->setTemplate(` and replace with `templated()` wrapper or `assert()` overload
3. Prefer `assert()` overloads for simple cases

**Why**: Eliminates stateful mutation; rules remain immutable and composable.

---

### 6. KeySet Negation (LOW IMPACT)

**What Changed**: `Not` can no longer wrap `KeySet`.

**v2.x** (allowed but unclear semantics):
```php
v::not(v::keySet(v::key('a'), v::key('b')))
```

**v3.0** (throws exception):
```php
// Use explicit logic instead
v::each(v::not(v::in(['a', 'b'])))
```

**Migration Strategy**: Search for `not(.*keySet`; replace with explicit validation logic.

**Why**: Negating structural validation is semantically ambiguous.

---

## New Features (Opt-In)

### 1. Prefix Rules

Concise syntax for common patterns without verbose chaining.

**Available Prefixes**: `key`, `property`, `length`, `max`, `min`, `nullOr`, `undefOr`

**Examples**:

```php
// Traditional v2.x chaining
v::key('email', v::email())
v::property('age', v::positive())
v::length(v::between(5, 10))

// v3.0 prefix syntax
v::keyEmail('email')          // key 'email' must be valid email
v::propertyPositive('age')    // property 'age' must be positive
v::lengthBetween(5, 10)       // length between 5 and 10
v::maxLessThan(100)           // maximum value less than 100
v::minGreaterThan(0)          // minimum value greater than 0
v::nullOrEmail()              // null or valid email
v::undefOrPositive()          // undefined or positive number
```

**When to Use**: Prefix rules reduce boilerplate for single-rule validations; use traditional chaining for complex compositions.

---

### 2. Attributes Support

Use rules as PHP 8+ attributes for declarative validation.

**Example**:

```php
use Respect\Validation\Rules\{Email, Between, NotBlank};

class User
{
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
    
    #[NotBlank]
    public string $name;
}

// Validate all attributed properties
v::attributes()->assert($user);
```

**When to Use**: Domain models with static validation rules benefit from attribute declarations; dynamic validation still requires fluent API.

---

### 3. Enhanced Error Handling

Structured result tree with path-based error identification.

**Example**:

```php
$validator = v::keySet(
    v::key('user', v::keySet(
        v::key('email', v::email())
    ))
);

try {
    $validator->assert($input);
} catch (ValidationException $e) {
    // v3.0: Paths identify nested failures
    // "user.email must be a valid email"
    // (v2.x would only say "email must be valid" - ambiguous)
}
```

**Why Useful**: Eliminates ambiguity in nested structures (e.g., which "email" failed in multi-user validation).

---

## Deprecation Warnings

### Temporary Compatibility

v3.0 includes deprecation transformers for renamed rules. Code using old names will work but may emit warnings.

**Recommended**: Update to new names immediately; transformers may be removed in future minor versions.

### Facades and Helpers

No changes to `Validator` facade (`v::`) usage patterns. Continue using `v::` for all rules.

---

## Testing Your Migration

### Step-by-Step Validation

1. **Update Composer**: `composer require respect/validation:^3.0`
2. **Run tests**: Identify failures
3. **Apply renames**: Use find/replace for safe renames
4. **Fix removed rules**: Apply migration patterns from section 3
5. **Update messages**: Replace `setName`/`setTemplate` with new patterns
6. **Verify examples**: Ensure custom validation logic matches v3 semantics
7. **Re-run tests**: Confirm all validations pass

### Common Gotchas

- **Min/Max confusion**: New prefix rules vs. comparison rules; check context
- **Age validation**: Requires `now()` or reference date in `dateTimeDiff`
- **KeyOptional**: Passes validation if key is absent; use `key()` if key is mandatory
- **Assertion location**: `assert()` only available on `Validator`, not individual rules

---

## Support and Resources

- **Documentation**: [respect-validation.readthedocs.io](https://respect-validation.readthedocs.io)
- **GitHub Issues**: [github.com/Respect/Validation/issues](https://github.com/Respect/Validation/issues)
- **Changelog**: [CHANGELOG.md](../CHANGELOG.md)
- **v2.x Maintenance**: Critical security fixes until [DATE + 6 months]; no new features

---

## Summary Checklist

- [ ] PHP version updated to 8.1+
- [ ] Composer dependencies updated
- [ ] Rule renames applied (`nullable` → `nullOr`, etc.)
- [ ] Removed rules replaced (`age` → `dateTimeDiff`, etc.)
- [ ] `setName`/`setTemplate` replaced with `Named`/`Templated` or `assert()` overloads
- [ ] Split rules reviewed (`Key`/`Property` → specialized variants)
- [ ] `assert()` calls use `Validator` wrapper or `v::` facade
- [ ] Tests pass
- [ ] Documentation updated (if applicable)

**Estimated Time**: 1-4 hours for typical projects; additional time for complex validation logic.

