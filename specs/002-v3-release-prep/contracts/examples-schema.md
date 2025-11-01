# Schema: Code Examples in Documentation

**Purpose**: Standard format and validation rules for PHP code examples across all documentation

## Example Block Structure

````markdown
```php
{CODE_WITHOUT_PHP_TAG}
```
````

## Core Requirements

### 1. No PHP Opening Tag

**Rule**: Never include `<?php` in documentation examples

**Rationale**: 
- Reduces visual clutter
- Emphasizes actual validation code
- Consistent with modern framework docs (Laravel, Symfony)

**❌ Incorrect**:
```php
<?php
use Respect\Validation\Validator as v;

v::email()->assert($input);
```

**✅ Correct**:
```php
v::email()->assert($input);
```

### 2. Assumed Context

**Imports**: All examples assume this context is present:

```php
<?php
require 'vendor/autoload.php';
use Respect\Validation\Validator as v;
```

**Variables**: Examples may reference common variable names without declaration:
- `$input` - Value being validated
- `$data` - Array/object being validated
- `$user` - Example domain object
- `$validator` - Validator instance

**When Context Matters**: If example requires specific input state, show it:

```php
$input = ['email' => 'user@example.com'];
v::keyEmail('email')->assert($input); // passes
```

### 3. Inline Comments for Outcomes

**Rule**: Use inline comments to indicate expected validation results

**Standard Comments**:
- `// passes` - Validation succeeds
- `// throws ValidationException` - Validation fails with exception
- `// returns true` - `validate()` method returns true
- `// returns false` - `validate()` method returns false

**Example**:
```php
v::email()->assert('user@example.com'); // passes
v::email()->assert('invalid'); // throws ValidationException
```

**Multi-line Outcomes**: For complex results, use block comments:

```php
try {
    v::email()->assert('invalid');
} catch (ValidationException $e) {
    echo $e->getMessage();
    // Output: "input" must be a valid email address
}
```

### 4. Facade Usage

**Rule**: Always use `v::` facade unless demonstrating explicit `Validator` construction

**✅ Correct** (default pattern):
```php
v::email()->assert($input);
v::intVal()->positive()->assert($input);
```

**✅ Correct** (when showing construction):
```php
use Respect\Validation\Validator;

$validator = new Validator(new Email());
$validator->assert($input);
```

**❌ Incorrect** (inconsistent):
```php
use Respect\Validation\Rules\Email;

$email = new Email();
// ... missing Validator wrapper
```

## Example Categories

### Type 1: Basic Validation

**Purpose**: Show simplest usage of a rule

**Structure**:
```php
v::{rule}()->assert({validInput}); // passes
v::{rule}()->assert({invalidInput}); // throws ValidationException
```

**Example**:
```php
v::email()->assert('user@example.com'); // passes
v::email()->assert('not-an-email'); // throws ValidationException
```

### Type 2: Parameterized Rules

**Purpose**: Demonstrate rule with constructor arguments

**Structure**: Show parameter purpose with meaningful values

**Example**:
```php
v::between(18, 65)->assert(30); // passes
v::between(18, 65)->assert(70); // throws ValidationException
```

### Type 3: Chaining Rules

**Purpose**: Show rule composition

**Structure**: Combine 2-3 related rules

**Example**:
```php
v::intVal()->positive()->lessThan(100)->assert(50); // passes
v::intVal()->positive()->lessThan(100)->assert(-5); // throws ValidationException
```

### Type 4: Real-World Use Case

**Purpose**: Demonstrate practical application

**Structure**: Include context setup and validation

**Example**:
```php
// Validate user registration data
$userData = [
    'email' => 'user@example.com',
    'age' => 25,
];

$validator = v::keySet(
    v::keyEmail('email'),
    v::key('age', v::intVal()->between(18, 120))
);

$validator->assert($userData); // passes
```

### Type 5: Exception Handling

**Purpose**: Show error handling patterns

**Structure**: Use try-catch with message inspection

**Example**:
```php
try {
    v::email()->assert('invalid');
} catch (ValidationException $e) {
    echo $e->getMessage();
    // "input" must be a valid email address
}
```

### Type 6: Advanced Pattern

**Purpose**: Demonstrate complex scenarios

**Structure**: Multi-step validation with context

**Example**:
```php
// Conditional validation based on user type
$validator = v::when(
    v::key('type', v::equals('admin')),
    v::key('permissions', v::arrayType()->notEmpty()),
    v::key('permissions', v::optional(v::arrayType()))
);

$validator->assert($adminData); // passes if permissions present
$validator->assert($regularUserData); // passes without permissions
```

## Validation Rules

### Executability Test

**Process**:

1. Extract code block from markdown
2. Wrap with standard context:
   ```php
   <?php
   require 'vendor/autoload.php';
   use Respect\Validation\Validator as v;
   
   {EXTRACTED_CODE}
   ```
3. Execute via PHP CLI
4. Verify:
   - No parse errors
   - No unexpected exceptions
   - Outcomes match inline comments

**Automated Tool** (future enhancement):
```bash
bin/validate-doc-examples docs/rules/Email.md
```

### Style Consistency

**Indentation**: 4 spaces (match PHP-FIG standards)

**Line Length**: Aim for <100 characters; hard wrap at 120

**Variable Naming**: Use descriptive names in real-world examples:
```php
// ✅ Good
$userEmail = 'user@example.com';
v::email()->assert($userEmail);

// ❌ Avoid
$x = 'user@example.com';
v::email()->assert($x);
```

**String Quotes**: Use single quotes for string literals unless interpolation needed:
```php
v::email()->assert('user@example.com'); // ✅
v::email()->assert("user@example.com"); // ❌ unnecessary double quotes
```

### Exception Types

**Import When Needed**: If example references specific exception classes:

```php
use Respect\Validation\Exceptions\ValidationException;

try {
    v::email()->assert($input);
} catch (ValidationException $e) {
    // Handle validation error
}
```

**Don't Import for Comments**: Inline comment `// throws ValidationException` doesn't require import

## Special Cases

### Prefix Rules

**Pattern**: Show both traditional and prefix syntax

```php
// Traditional syntax
v::key('email', v::email())

// Prefix syntax (v3.0+)
v::keyEmail('email')
```

### Attributes

**Pattern**: Include class declaration and validation

```php
use Respect\Validation\Rules\Email;

class User
{
    #[Email]
    public string $email;
}

v::attributes()->assert($user);
```

### Deprecated Features

**Pattern**: Mark clearly with version context

```php
// v2.x (deprecated)
v::nullable(v::email())

// v3.0 (current)
v::nullOr(v::email())
```

### Output Examples

**Pattern**: Show actual messages/output when relevant

```php
$result = v::email()->validate('invalid');
var_dump($result); // bool(false)

try {
    v::email()->assert('invalid');
} catch (ValidationException $e) {
    echo $e->getMessage();
    // "input" must be a valid email address
}
```

## Anti-Patterns

### ❌ Don't: Show Incomplete Code

```php
// Missing validation method
$validator = v::email();
```

**Fix**: Always show complete validation flow:
```php
$validator = v::email();
$validator->assert($input);
```

### ❌ Don't: Use Magic Values Without Context

```php
v::between(5, 10)->assert($value);
```

**Fix**: Add context or show concrete values:
```php
// Validate age range
v::between(18, 65)->assert(30); // passes

// Or show setup
$minLength = 5;
$maxLength = 10;
v::between($minLength, $maxLength)->assert(strlen($password));
```

### ❌ Don't: Mix v2.x and v3.0 Syntax

```php
// Don't mix versions
$email = new Email();
$email->assert($input); // v2.x pattern (invalid in v3.0)
```

**Fix**: Use consistent v3.0 patterns:
```php
v::email()->assert($input);
```

### ❌ Don't: Omit Expected Outcome

```php
v::email()->assert($input);
```

**Fix**: Always indicate expected result:
```php
v::email()->assert('user@example.com'); // passes
v::email()->assert('invalid'); // throws ValidationException
```

## Documentation-Specific Examples

### Migration Guide

**Pattern**: Side-by-side version comparisons

```php
// v2.x
v::nullable(v::email())->assert($input);

// v3.0
v::nullOr(v::email())->assert($input);
```

### Feature Guide

**Pattern**: Progressive complexity (simple → advanced)

```php
// Basic validation
v::email()->assert($input);

// With custom message
v::email()->assert($input, 'Email address is invalid');

// With exception handling
try {
    v::email()->assert($input);
} catch (ValidationException $e) {
    logError($e);
}
```

### Rule Documentation

**Pattern**: Show rule in isolation, then composed

```php
// Standalone
v::between(1, 10)->assert(5); // passes

// Composed with type check
v::intVal()->between(1, 10)->assert(5); // passes
```

## Checklist for New Examples

- [ ] No `<?php` tag
- [ ] Uses `v::` facade (unless showing constructor)
- [ ] Inline comments indicate outcomes
- [ ] Variable names are descriptive
- [ ] Code is complete (includes validation method call)
- [ ] Single quotes for string literals
- [ ] Proper indentation (4 spaces)
- [ ] Example is executable with standard context
- [ ] Outcome matches actual v3.0 behavior
- [ ] Context is provided for non-obvious setups

