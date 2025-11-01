# Schema: Rule Documentation Page

**Purpose**: Standard structure for individual rule documentation pages in `docs/rules/`

## Template Structure

```markdown
# {RuleName}

{Brief one-sentence description of what the rule validates}

## Usage

```php
v::{ruleName}()->assert($input);
v::{ruleName}({param1}, {param2})->assert($input);
```

## Parameters

{If rule accepts parameters, list them here}

- `$param1` (type): Description of parameter
- `$param2` (type): Description of parameter

{If rule has no parameters:}

This rule has no parameters.

## Examples

### Basic Usage

```php
v::{ruleName}()->assert('valid input'); // passes
v::{ruleName}()->assert('invalid input'); // throws ValidationException
```

### {Additional Example Scenario}

{Context or explanation}

```php
v::{ruleName}(...)->assert(...);
```

## Message Template

**Default**: `{{name}} must {validation requirement}`

**Negative**: `{{name}} must not {validation requirement}`

**Placeholders**:

- `{{name}}`: Input name (defaults to "input")
- `{{input}}`: The value being validated
- `{{{ruleSpecificPlaceholder}}}`: {Description}

## Categorization

- {Category 1}
- {Category 2}

## Notes

{Optional section for edge cases, gotchas, or additional context}

## See Also

- [{RelatedRule}](./{RelatedRule}.md)
- [Documentation Section](../{section}.md#{anchor})

## Changelog

**Since**: {version} - {Description of when rule was introduced}

{If deprecated:}
**Deprecated**: {version} - {Reason for deprecation}
**Removed**: {version} - {Replacement guidance}

---

**Version**: 3.0 | **Category**: {Primary Category}
```

## Field Specifications

### Title

- **Format**: H1 heading matching rule class name (PascalCase)
- **Examples**: `Email`, `Between`, `KeySet`

### Brief Description

- **Length**: 1-2 sentences maximum
- **Tone**: Direct, imperative
- **Focus**: What the rule validates, not how it works
- **Example**: "Validates email addresses according to RFC specifications."

### Usage Section

- **Required**: Always include at least one basic usage example
- **Format**: Fenced PHP code block without `<?php` tag
- **Assumption**: `v` alias for `Respect\Validation\Validator` is imported
- **Pattern**: Show both passing and failing examples when helpful

### Parameters Section

- **Required if**: Rule accepts constructor parameters
- **Format**: Bullet list with type annotations
- **Details**: Include default values if applicable
- **Example**:
  ```markdown
  - `$min` (int|float): Minimum value (inclusive)
  - `$max` (int|float): Maximum value (inclusive)
  ```

### Examples Section

- **Minimum**: At least one basic usage example showing pass and fail
- **Recommended**: 2-3 examples covering common use cases
- **Structure**: Use H3 headings for each example scenario
- **Context**: Provide brief explanatory text before code blocks when needed
- **Executability**: All examples must run successfully against v3.0

**Example Scenarios to Cover**:
- Basic usage (always)
- Common real-world use case
- Chaining with other rules
- Negation (if applicable)
- Edge cases (if noteworthy)

### Message Template Section

- **Required**: Always document default templates
- **Format**: Show both positive and negative modes
- **Placeholders**: List all available placeholders with descriptions
- **Standard Placeholders**: `{{name}}`, `{{input}}` (always available)
- **Rule-Specific**: Document custom placeholders (e.g., `{{minValue}}` for `Between`)

### Categorization Section

- **Required**: List all categories from 09-list-of-rules-by-category.md
- **Format**: Bullet list
- **Validation**: Categories must match master category list

**Valid Categories**:
- String Validation
- Numeric
- Dates and Times
- Array and Iterable
- Object
- Type Checking
- Comparison
- File System
- Internet and Networking
- Regional (IDs, Postal Codes, etc.)
- Banking
- Miscellaneous

### Notes Section

- **Optional**: Include only if there are edge cases or gotchas
- **Content**: Technical details, performance considerations, common mistakes
- **Example Topics**:
  - PHP version-specific behavior
  - Dependencies (e.g., "Requires `giggsey/libphonenumber-for-php` package")
  - Locale considerations
  - Known limitations

### See Also Section

- **Optional**: Include if rule relates to other rules or doc sections
- **Format**: Bullet list of markdown links
- **Target**: Related rules or feature guide sections

### Changelog Section

- **Required**: Document when rule was introduced
- **Format**: Bold labels with version numbers
- **Include**: Deprecation/removal notices if applicable
- **Example**:
  ```markdown
  **Since**: 1.0.0 - Initial release
  **Deprecated**: 2.4.0 - Use `PropertyExists` instead
  **Removed**: 3.0.0 - Replaced by `Property`, `PropertyExists`, and `PropertyOptional`
  ```

## Style Guidelines

### Code Examples

- **No PHP tags**: Never include `<?php` opening tag
- **Imports**: Assume `use Respect\Validation\Validator as v;` is present
- **Syntax**: Use `v::` facade for all examples
- **Comments**: Inline comments showing expected outcomes (`// passes`, `// throws ValidationException`)

### Language

- **Tone**: Direct, concise, imperative
- **Avoid**: "You can", "It is possible to", "This allows you to"
- **Prefer**: "Use", "Validates", "Checks", "Ensures"
- **Example**: 
  - ❌ "You can use this rule to validate email addresses"
  - ✅ "Validates email addresses according to RFC specifications"

### Headings

- **Format**: ATX-style (`##`, `###`) with space after hash
- **Capitalization**: Title case for H2, sentence case for H3+
- **Consistency**: Use standard section headings from template

### Links

- **Internal**: Use relative paths (`./OtherRule.md`, `../02-feature-guide.md`)
- **Anchors**: Use lowercase with hyphens (`#basic-usage`)
- **External**: Full URLs with descriptive link text

## Validation Rules

### Pre-Commit Checks

1. **File naming**: `docs/rules/{RuleName}.md` matches class name exactly
2. **Required sections**: Title, Description, Usage, Examples, Message Template, Categorization, Changelog
3. **Example executability**: All code examples run without errors when wrapped with standard imports
4. **Link validity**: All internal links resolve to existing files/anchors
5. **Category validity**: All categories match master list in 09-list-of-rules-by-category.md
6. **Placeholder accuracy**: Documented placeholders match actual template strings in rule source

### Example Execution Template

To validate examples, wrap them with:

```php
<?php
require 'vendor/autoload.php';
use Respect\Validation\Validator as v;

try {
    {EXAMPLE_CODE}
    echo "✓ Example passed\n";
} catch (\Respect\Validation\Exceptions\ValidationException $e) {
    echo "✓ Example threw expected exception\n";
} catch (\Throwable $e) {
    echo "✗ Example failed: " . $e->getMessage() . "\n";
    exit(1);
}
```

## Deprecated/Removed Rules

For rules removed in v3.0, include deprecation notice at top of page:

```markdown
# {RuleName}

!!! warning "Deprecated in v2.4, Removed in v3.0"
    This rule has been removed. Use [{Replacement}](./{Replacement}.md) instead.
    See the [Migration Guide](../11-migration-from-2x.md#{anchor}) for upgrade instructions.

{Original documentation for v2.x reference, marked clearly as historical}
```

## Prefix Rules

For rules that support prefix syntax (e.g., `key`, `property`, `length`), include dedicated section:

```markdown
## Prefix Usage

This rule can be used as a prefix to simplify common patterns.

### Traditional Syntax

```php
v::key('email', v::email())
```

### Prefix Syntax

```php
v::keyEmail('email')
```

Both forms are equivalent. Use prefix syntax for single-rule validations; use traditional syntax for complex compositions.
```

## New in v3.0 Rules

For rules introduced in v3.0, highlight the version prominently:

```markdown
# {RuleName}

!!! note "New in v3.0"
    This rule was introduced in version 3.0. For v2.x projects, see [alternatives](../11-migration-from-2x.md#{anchor}).

{Standard documentation follows}
```

## Complete Example

```markdown
# Between

Validates that input is between two values (inclusive).

## Usage

```php
v::between(10, 20)->assert(15); // passes
v::between(10, 20)->assert(5); // throws ValidationException
```

## Parameters

- `$minimum` (int|float|DateTimeInterface): Minimum value (inclusive)
- `$maximum` (int|float|DateTimeInterface): Maximum value (inclusive)

Both parameters support numeric values and comparable objects implementing `DateTimeInterface`.

## Examples

### Numeric Range

```php
v::between(1, 100)->assert(50); // passes
v::between(1, 100)->assert(101); // throws ValidationException
```

### Date Range

```php
$start = new DateTime('2024-01-01');
$end = new DateTime('2024-12-31');

v::between($start, $end)->assert(new DateTime('2024-06-15')); // passes
v::between($start, $end)->assert(new DateTime('2025-01-01')); // throws ValidationException
```

### Chaining with Type Validation

```php
v::intVal()->between(18, 65)->assert(30); // passes
v::intVal()->between(18, 65)->assert(70); // throws ValidationException
```

## Message Template

**Default**: `{{name}} must be between {{minValue}} and {{maxValue}}`

**Negative**: `{{name}} must not be between {{minValue}} and {{maxValue}}`

**Placeholders**:

- `{{name}}`: Input name (defaults to "input")
- `{{input}}`: The value being validated
- `{{minValue}}`: The minimum boundary
- `{{maxValue}}`: The maximum boundary

## Categorization

- Comparison
- Numeric

## Notes

Both boundaries are inclusive. For exclusive boundaries, use `BetweenExclusive`.

Values must be comparable. Mixing numeric and date types will result in a comparison exception.

## See Also

- [BetweenExclusive](./BetweenExclusive.md) - Exclusive boundary alternative
- [GreaterThan](./GreaterThan.md) - Lower bound only
- [LessThan](./LessThan.md) - Upper bound only

## Changelog

**Since**: 1.0.0 - Initial release

---

**Version**: 3.0 | **Category**: Comparison
```

