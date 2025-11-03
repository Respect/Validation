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

// Complex validations
v::intVal()->positive()->lessThan(100)->assert($input);

// With custom messages
v::email()->assert($input, 'Email address is required');
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
v::min(10)  // Value comparison
v::max(100) // Value comparison

// v3.0
v::nullOr(v::email())
v::undefOr(v::intVal())
v::property('name', v::stringType())
v::greaterThanOrEqual(10)  // Value comparison (explicit)
v::lessThanOrEqual(100)    // Value comparison (explicit)
```

**Context-Dependent Min/Max Replacements**:

When `min()` and `max()` were used for value comparisons (not as prefix rules), replace them:

```php
// v2.x value comparison
v::intVal()->min(18)  // Age validation
v::floatVal()->max(100)  // Score validation

// v3.0 equivalent
v::intVal()->greaterThanOrEqual(18)
v::floatVal()->lessThanOrEqual(100)
```

When `min()` and `max()` should become prefix rules:

```php
// v2.x chained validation
v::min(10)->max(100)  // Length validation

// v3.0 prefix rule (more concise)
v::lengthBetween(10, 100)
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
v::dateTimeDiff('years')->equals(18)

// v2.x: Minimum age
v::minAge(18)

// v3.0: Minimum age (18 or older)
v::dateTimeDiff('years')->greaterThanOrEqual(18)

// v2.x: Maximum age
v::maxAge(65)

// v3.0: Maximum age (65 or younger)
v::dateTimeDiff('years')->lessThanOrEqual(65)

// v2.x: Age range
v::minAge(18)->maxAge(65)

// v3.0: Age range
v::dateTimeDiff('years')->between(18, 65)

// v2.x: Age with specific date
v::minAge(18, $referenceDate)

// v3.0: Age with specific date
v::dateTimeDiff('years', $referenceDate)->greaterThanOrEqual(18)
```

**KeyValue Migration**:

```php
// v2.x
v::keyValue('password', 'password_confirmation')

// v3.0: Explicit comparison
v::key('password_confirmation', v::equals($input['password']))

// v2.x: Multiple key comparisons
v::keyValue('start_date', 'end_date')

// v3.0: Multiple key comparisons
v::key('end_date', v::greaterThan(v::keyValue('start_date')))
```

**Consecutive Migration**:

```php
// v2.x: Sequential validation
v::consecutive(v::intVal(), v::positive(), v::lessThan(100))

// v3.0: Use lazy for sequential validation
v::lazy(v::intVal(), v::positive(), v::lessThan(100))

// v2.x: Complex consecutive validation
v::consecutive(
    v::key('email', v::email()),
    v::key('age', v::intVal()->min(18))
)

// v3.0: Complex validation with lazy
v::lazy(
    v::key('email', v::email()),
    v::key('age', v::intVal()->greaterThanOrEqual(18))
)
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

// v2.x: Property validation
v::attribute('age', v::intVal()->min(18))

// v3.0: Property validation (renamed)
v::property('age', v::intVal()->greaterThanOrEqual(18))

// v2.x: Property existence check
v::attribute('name')

// v3.0: Property existence check
v::propertyExists('name')

// v2.x: Optional property validation
// (v2.x required custom logic with optional()/nullable())

// v3.0: Built-in optional property validation
v::propertyOptional('middleName', v::stringType())
```

**Complex Usage Patterns**:

```php
// v2.x: Complex key validation with workarounds
v::keySet(
    v::key('email', v::email()),
    v::key('age', v::optional(v::intVal()->min(18)))
)

// v3.0: Clearer optional key validation
v::keySet(
    v::key('email', v::email()),
    v::keyOptional('age', v::intVal()->greaterThanOrEqual(18))
)

// v2.x: Property validation on objects
v::attribute('user', v::attribute('email', v::email()))

// v3.0: Property validation on objects (clearer naming)
v::property('user', v::property('email', v::email()))

// v2.x: Existence-only checks
v::key('requiredField')
    ->attribute('requiredProperty')

// v3.0: Explicit existence checks
v::keyExists('requiredField')
    ->propertyExists('requiredProperty')
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

// With complex rules
v::templated(
    v::named(
        v::intVal()->greaterThanOrEqual(18),
        'Age'
    ),
    '{{name}} must be 18 or older'
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

// With Named and Templated rules
v::named(v::email(), 'Email Address')
    ->assert($input, '{{name}} must be a valid email address');

// Complex validation with custom messages
v::keySet(
    v::key('name', v::named(v::stringType(), 'Name')),
    v::key('age', v::named(v::intVal(), 'Age'))
)->assert($userData, [
    'name' => 'Please provide a valid name',
    'age' => 'Age must be a number',
    '__self__' => 'Please check your user data'
]);
```

**Migration Examples**:

```php
// v2.x: Simple name and template
v::email()
    ->setName('Email')
    ->setTemplate('{{name}} is not valid');

// v3.0: Using Named and Templated rules
v::templated(
    v::named(v::email(), 'Email'),
    '{{name}} is not valid'
);

// v2.x: Complex chained rule with messages
v::key('user', 
    v::attribute('email', v::email())
        ->setName('User Email')
        ->setTemplate('Email is invalid')
);

// v3.0: Clear separation of concerns
v::key('user',
    v::named(
        v::property('email', v::email()),
        'User Email'
    )
)->setTemplate('{{name}} is invalid');
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

// Reject specific keys
v::not(v::keySet(
    v::key('admin_only'),
    v::key('debug_flag')
))
```

**v3.0** (throws exception):
```php
// Use explicit logic instead
v::each(v::not(v::in(['a', 'b'])))

// Reject specific keys - more explicit approach
v::keySet(
    v::key('allowed_key', v::stringType()),
    // Add validation for other allowed keys
)->setTemplate('Invalid keys found in input')
```

**Workaround Examples**:

```php
// v2.x: Reject arrays containing specific keys
v::not(v::keySet(v::key('forbidden1'), v::key('forbidden2')))

// v3.0: Check that forbidden keys don't exist
v::noneOf(
    v::keyExists('forbidden1'),
    v::keyExists('forbidden2')
)

// v2.x: Inverse key validation (no specific keys allowed)
v::not(v::keySet(v::key('email'), v::key('password')))

// v3.0: Explicit validation of allowed structure
v::keySet(
    v::keyOptional('email', v::email()),
    v::keyOptional('password', v::stringType()->lengthBetween(8, 100))
    // Only allow these specific keys
)

// v2.x: Complex negation
v::not(v::keySet(
    v::key('user', v::keySet(
        v::key('admin', v::trueVal())
    ))
))

// v3.0: Direct validation approach
v::keySet(
    v::keyOptional('user', v::keySet(
        v::keyOptional('admin', v::not(v::trueVal()))
    ))
)
```

**Advanced Workarounds**:

For complex scenarios, you might need custom validation logic:

```php
// Custom rule to validate that only allowed keys exist
class AllowedKeysOnly extends AbstractRule
{
    public function __construct(private array $allowedKeys)
    {
    }

    public function validate(mixed $input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return empty(array_diff(array_keys($input), $this->allowedKeys));
    }
}

// Usage
v::keySet(
    new AllowedKeysOnly(['name', 'email', 'age']),
    v::key('name', v::stringType()),
    v::key('email', v::email()),
    v::key('age', v::intVal()->greaterThanOrEqual(18))
);
```

**Migration Strategy**: Search for `not(.*keySet`; replace with explicit validation logic using:
- `noneOf()` for rejecting specific keys
- Direct `keySet()` validation for allowed structures
- Custom rules for complex scenarios

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

// More complex prefix examples
v::keyLengthBetween('username', 3, 20)  // key 'username' with length 3-20
v::propertyNullOrEmail('email')         // property 'email' that is null or valid email
v::keyUndefOrPositive('score')          // key 'score' that is undefined or positive
```

**Advanced Prefix Usage**:

```php
// Combine prefix rules with other rules
v::keySet(
    v::keyEmail('email'),
    v::keyLengthBetween('username', 3, 20),
    v::keyNullOrBetween('age', 18, 120)
)

// Nested prefix rules
$addressValidator = v::keySet(
    v::keyLengthBetween('street', 5, 100),
    v::keyNullOrLengthBetween('apartment', 1, 10),
    v::keyLengthBetween('city', 2, 50),
    v::keyLengthEqual('zip', 5)  // New in v3.0
)
```

**When to Use**: Prefix rules reduce boilerplate for single-rule validations; use traditional chaining for complex compositions.

**Performance Benefits**: Prefix rules are slightly more performant as they avoid intermediate rule creation.

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

**Advanced Attributes Usage**:

```php
use Respect\Validation\Rules\{Email, Between, NotBlank, KeySet, Key, StringVal, IntVal};

class User
{
    #[NotBlank]
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
    
    #[NotBlank]
    #[StringVal]
    public string $name;
    
    #[Key('street')]  // Nested validation
    public array $address;
}

// Validate with nested structure
v::attributes(
    v::key('address', v::keySet(
        v::key('street', v::stringType()->lengthBetween(5, 100)),
        v::keyOptional('apartment', v::stringType()->lengthBetween(1, 10))
    ))
)->assert($user);
```

**When to Use**: Domain models with static validation rules benefit from attribute declarations; dynamic validation still requires fluent API.

**Benefits**:
- Validation rules are co-located with properties
- IDE support for rule discovery
- Self-documenting code
- Compile-time validation rule definition

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

**Advanced Error Handling**:

```php
// Get detailed error information
try {
    $validator->assert($input);
} catch (ValidationException $e) {
    // Get all messages with paths
    $messages = $e->getMessages();
    
    // Get specific error by path
    $emailError = $e->getMessage('user.email');
    
    // Get full result tree
    $result = $e->getResult();
    
    // Navigate result tree
    $userResult = $result->getSubsequent('user');
    $emailResult = $userResult->getSubsequent('email');
}
```

**Why Useful**: Eliminates ambiguity in nested structures (e.g., which "email" failed in multi-user validation).

**Enhanced Results**: Results now support nested subsequents for structured validation feedback, with path-based error identification for nested structures in rules like `UndefOr`, `NullOr`, `DateTimeDiff`, `Max`, `Min`, and `Length`.

**Migration Benefit**: Easier debugging and error reporting in complex validation scenarios.

---

## Deprecation Warnings

### Temporary Compatibility

v3.0 includes deprecation transformers for renamed rules. Code using old names will work but may emit warnings.

**Recommended**: Update to new names immediately; transformers may be removed in future minor versions.

**Deprecation Warning Examples**:

```php
// This will work but emit a deprecation warning
v::nullable(v::email());  // Deprecated: nullable is deprecated

// Recommended replacement
v::nullOr(v::email());    // No warning

// Multiple deprecated rules
v::nullable(v::optional(v::min(10)));  // Multiple warnings

// Recommended replacement
v::nullOr(v::undefOr(v::greaterThanOrEqual(10)));  // No warnings
```

**Controlling Deprecation Warnings**:

```php
// Suppress deprecation warnings (not recommended for production)
error_reporting(E_ALL & ~E_DEPRECATED);

// Or set a custom error handler
set_error_handler(function($errno, $errstr) {
    if (strpos($errstr, 'deprecated') !== false) {
        // Log or handle deprecation warnings
        error_log("Deprecation: $errstr");
        return true; // Don't execute PHP internal error handler
    }
    return false; // Execute PHP internal error handler
}, E_DEPRECATED);
```

**Migration Strategy for Deprecation Warnings**:

1. **Development Phase**: Keep warnings enabled to identify deprecated usage
2. **Testing Phase**: Run test suite with error reporting enabled
3. **Production Phase**: Consider suppressing warnings if immediate migration isn't possible
4. **Long-term**: Remove all deprecated rule usage

### Facades and Helpers

No changes to `Validator` facade (`v::`) usage patterns. Continue using `v::` for all rules.

**Backward Compatibility**:
- All existing `v::{rule}()` patterns continue to work
- Rule parameter signatures remain the same where possible
- Custom rules implementing the Rule interface continue to work

**Potential Breaking Changes**:
- Rules that relied on `setName()`/`setTemplate()` chaining will need refactoring
- Rules that expected `assert()`/`check()` on individual rule instances will break
- Rules that wrapped `KeySet` with `Not` will throw exceptions

### Version Migration Timeline

**v3.0 (Current)**:
- Deprecation transformers included
- Warnings emitted for deprecated usage
- Full backward compatibility for non-deprecated features

**v3.x (Future minors)**:
- Deprecation transformers may be removed
- Deprecated rule names may stop working
- New features added without breaking changes

**v4.0 (Future major)**:
- All deprecated features removed
- Only current v3.0+ patterns supported
- New breaking changes may be introduced

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

