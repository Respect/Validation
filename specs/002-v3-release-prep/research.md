# Research: Version 3.0 Breaking Changes and Documentation Requirements

**Date**: 2025-10-31  
**Feature**: Version 3.0 Release Readiness (Documentation)  
**Purpose**: Catalog all v3.0 breaking changes, deprecated features, and new capabilities to inform documentation updates

## Breaking Changes Inventory

### 1. Validator Construction and Assertion

**Decision**: `assert()` and `check()` methods removed from individual Rule classes; now only available on `Validator` wrapper.

**Rationale**: Simplifies validation engine, reduces exception-handling complexity, enables flexible error handling patterns (custom templates, exceptions, callables).

**v2.4 Pattern**:
```php
$email = new Email();
$email->assert($input);
```

**v3.0 Pattern**:
```php
$validator = new Validator(new Email());
$validator->assert($input);

// Or via facade
v::email()->assert($input);
```

**Documentation Impact**: 
- Update 02-feature-guide.md with new constructor pattern
- Update 03-handling-exceptions.md with new `Validator::assert()` signatures
- All rule examples must use `v::` facade or `Validator` wrapper

**Alternatives Considered**: Keep backward compatibility; rejected to simplify architecture per roadmap.

---

### 2. Rule Renames and Removals

**Decision**: Multiple rules renamed or removed with deprecation transformers providing compatibility.

**Breaking Renames**:

| v2.4 Name | v3.0 Name | Reason |
|-----------|-----------|--------|
| `Nullable` | `NullOr` | Clearer semantic meaning as prefix |
| `Optional` | `UndefOr` | Distinguishes null vs undefined handling |
| `Min` | `GreaterThanOrEqual` | Explicit comparison semantics |
| `Max` | `LessThanOrEqual` | Explicit comparison semantics |
| `Attribute` | `Property` | More accurate term for object properties |
| `NotOptional` | `NotUndef` | Consistency with `UndefOr` rename |

**Removed Rules** (with replacements):

| Removed | v3.0 Replacement | Migration Path |
|---------|------------------|----------------|
| `Age` | `DateTimeDiff` | Use `v::dateTimeDiff('years', 18)` |
| `MinAge` | `DateTimeDiff` with `GreaterThanOrEqual` | Chain: `v::dateTimeDiff('years')->greaterThanOrEqual(18)` |
| `MaxAge` | `DateTimeDiff` with `LessThanOrEqual` | Chain: `v::dateTimeDiff('years')->lessThanOrEqual(65)` |
| `KeyValue` | `Key` with chaining | Use `v::key('name', v::equals('value'))` |
| `Consecutive` | `Lazy` | Use `v::lazy()` for sequential validation |

**Split Rules** (single rule → multiple specialized rules):

| v2.4 Rule | v3.0 Rules | Use Cases |
|-----------|------------|-----------|
| `Key` | `Key`, `KeyExists`, `KeyOptional` | Different validation requirements |
| `Property` | `Property`, `PropertyExists`, `PropertyOptional` | Different validation requirements |

**Documentation Impact**:
- Create deprecation table in migration guide (11-migration-from-2x.md)
- Add "Deprecated in v2.4, removed in v3.0" notices to affected rule docs
- Update 09-list-of-rules-by-category.md with new rule names
- Document split rules with clear use-case guidance

**Rationale**: Improved semantic clarity; reduced ambiguity in rule behavior; better composability.

---

### 3. New Prefix Rules

**Decision**: Introduce six prefix rules for common validation patterns without method chaining verbosity.

**New Prefixes**:

| Prefix | Equivalent To | Example |
|--------|---------------|---------|
| `key` | `v::key('name', ...)` | `v::keyEmail('address')` → validates array key 'address' contains email |
| `property` | `v::property('name', ...)` | `v::propertyPositive('age')` → validates object property 'age' is positive |
| `length` | `v::length(...)` | `v::lengthBetween(5, 10)` → string/array length between 5-10 |
| `max` | `v::max(...)` | `v::maxEquals(100)` → maximum value equals 100 |
| `min` | `v::min(...)` | `v::minGreaterThan(0)` → minimum value greater than 0 |
| `nullOr` | `v::nullOr(...)` | `v::nullOrEmail()` → accepts null or valid email |
| `undefOr` | `v::undefOr(...)` | `v::undefOrPositive()` → accepts undefined or positive number |

**Documentation Impact**:
- Add new section "Prefix Rules" to 02-feature-guide.md
- Create dedicated docs page for each prefix pattern
- Update 09-list-of-rules-by-category.md with "Prefixes" category
- Show side-by-side comparisons with v2.4 chaining patterns

**Rationale**: Reduces boilerplate for common patterns; improves readability; encourages consistent validation idioms.

---

### 4. PHP Attributes Support

**Decision**: Rules can be used as PHP 8+ attributes for class property validation.

**Example**:
```php
use Respect\Validation\Rules\Email;
use Respect\Validation\Rules\Between;

class User {
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
}

// Validate with Attributes rule
v::attributes()->assert($user);
```

**Documentation Impact**:
- Add "Using Rules as Attributes" section to 02-feature-guide.md
- Document `Attributes` rule in docs/rules/Attributes.md
- Show practical examples with class validation

**Rationale**: Modern PHP idiom; declarative validation; reduces boilerplate in domain models.

---

### 5. Message System Changes

**Decision**: Template system updated with new placeholder behaviors; `setName()` and `setTemplate()` replaced by `Named` and `Templated` rules.

**Changes**:

- `setName()` → `Named` rule: `v::email()->setName('address')` becomes `v::named(v::email(), 'address')`
- `setTemplate()` → `Templated` rule: `v::email()->setTemplate('...')` becomes `v::templated(v::email(), '...')`
- New placeholder filter: `{{placeholder|quote}}` for quoted values
- `Result->isValid` potentially renamed to `Result->hasPassed` (check roadmap status)

**Documentation Impact**:
- Update 03-handling-exceptions.md with `Named` and `Templated` examples
- Update 04-message-translation.md with new approach
- Update 05-message-placeholder-conversion.md with `|quote` filter examples
- Document new `Validator::assert()` overloads accepting templates/exceptions/callables

**Rationale**: Consistent rule-based API; eliminates stateful mutation methods; enables functional composition.

---

### 6. KeySet Changes

**Decision**: `KeySet` can no longer be wrapped in `Not`; now reports which extra keys cause failures.

**v2.4**: `v::not(v::keySet(...))` was allowed (but semantically unclear)

**v3.0**: `v::not(v::keySet(...))` throws exception; use explicit logic instead

**Documentation Impact**:
- Update KeySet.md rule documentation with "Cannot be negated" note
- Show alternative patterns for "reject these keys" use cases

**Rationale**: Negating a structural rule is semantically ambiguous; explicit patterns are clearer.

---

### 7. Result System Enhancements

**Decision**: Results now support nested subsequents for structured validation feedback.

**Features**:
- Subsequents in `UndefOr`, `NullOr`, `DateTimeDiff`, `Max`, `Min`, `Length`
- Path-based error identification for nested structures
- `__self__` in `getMessages()` for result's own message

**Documentation Impact**:
- Update 03-handling-exceptions.md with result tree navigation examples
- Show how to extract specific errors from nested structures
- Document path semantics for arrays/objects

**Rationale**: Enables precise error identification in complex nested validations (e.g., Issue 796 use case).

---

## Documentation Structure Decisions

### Migration Guide Structure

**Decision**: Create comprehensive migration guide (11-migration-from-2x.md) organized by impact level.

**Template Structure**:

1. **Overview**: Quick summary of v3.0 goals (simplicity, consistency, modern PHP)
2. **Breaking Changes**: High-impact changes requiring code updates
   - Validator construction pattern
   - Rule renames with find/replace guidance
   - Removed rules with migration paths
3. **New Features**: Opt-in improvements
   - Prefix rules
   - Attributes support
   - Enhanced error handling
4. **Deprecated Features**: What still works but should be avoided
   - Deprecation transformers (temporary compatibility)
5. **PHP Version**: Minimum PHP 8.1+
6. **Support Policy**: 2.x critical fixes for 6 months

**Rationale**: Priority-based organization helps users assess upgrade effort; side-by-side examples reduce cognitive load.

---

### MkDocs Style Guidelines

**Decision**: Apply consistent formatting across all docs for MkDocs ReadTheDocs theme compatibility.

**Standards**:

- **Headings**: Use ATX style (`#`, `##`, `###`) with space after hash
- **Code blocks**: Fenced with triple backticks; PHP examples omit `<?php` tag
- **Imports**: Assume `use Respect\Validation\Validator as v;` in all examples
- **Tables**: Use GFM tables with alignment pipes
- **Admonitions**: Use standard MkDocs admonitions (`!!! note`, `!!! warning`)
- **Links**: Relative links for cross-references (`[rule](./rules/Email.md)`)
- **Line length**: Aim for 100-120 chars for readability; hard wrap paragraphs
- **Lists**: Use `-` for unordered; `1.` for ordered; consistent indentation

**Example Format**:
````markdown
## Email Validation

Validates that input is a valid email address.

```php
v::email()->assert('user@example.com'); // passes
v::email()->assert('invalid'); // throws ValidationException
```

**Parameters**: None

**Template Message**: `{{name}} must be a valid email address`

**Categories**: String Validation, Internet

**Since**: 1.0.0
````

**Rationale**: Consistency improves navigation and readability; MkDocs compatibility ensures correct rendering; concise style matches user request.

---

### Example Validation Strategy

**Decision**: Implement automated example extraction and validation against v3.0 library.

**Approach**:

1. Extract PHP code blocks from markdown files
2. Wrap in test harness with `v` alias
3. Execute via PHPUnit/Pest
4. Report files with failing examples

**Tooling**: Create `bin/validate-doc-examples` script (not part of this feature but noted for follow-up)

**Manual Process** (this feature):
- Review each code example manually
- Test against v3.0 behavior
- Update examples that fail or use deprecated patterns

**Rationale**: Constitution's quality standards require working examples; automated validation prevents regressions.

---

## Best Practices Summary

### Writing Documentation

1. **Be direct**: Avoid "you can" phrasing; use imperative mood ("Use `v::email()` to validate...")
2. **Show, don't tell**: Lead with examples before explanations
3. **One concept per section**: Keep sections focused on single topics
4. **Progressive disclosure**: Simple examples first, advanced patterns later
5. **Cross-reference**: Link related rules and concepts consistently

### Migration Guide Writing

1. **Start with impact**: High-impact changes first
2. **Provide escape hatches**: Show workarounds for removed features
3. **Side-by-side examples**: v2.4 → v3.0 comparisons
4. **Highlight benefits**: Explain *why* changes improve the library
5. **Timeline clarity**: State 2.x support window explicitly

### Handling Ambiguity

- When exact v2.4 behavior is unclear, note in migration guide with "verify your specific use case"
- For complex migrations, provide multiple alternative patterns
- Link to GitHub issues for edge cases requiring maintainer guidance

---

## Follow-up Research (Out of Scope)

- **Blog post content**: Announcement narrative (per roadmap item)
- **Deprecation warnings**: Runtime warnings for v2.4 compatibility layer (if applicable)
- **Version switcher**: Hosting infrastructure for parallel v2/v3 docs (if versioned docs adopted later)

