# Quick Start: Updating Documentation for v3.0

**Audience**: Contributors updating docs for v3.0 release  
**Estimated Time**: 15 minutes to understand workflow  
**Prerequisites**: Familiarity with Respect\Validation v2.x and v3.0 changes

## Overview

This guide walks through the documentation update process for v3.0 release readiness. Follow these steps to ensure consistency and completeness.

## Workflow Summary

```
1. Review breaking changes → 
2. Update migration guide → 
3. Update major sections → 
4. Update rule docs → 
5. Validate examples → 
6. Check links → 
7. Final review
```

## Step 1: Review Breaking Changes

**Action**: Read `research.md` to understand all v3.0 changes

**Key Changes to Internalize**:
- Validator construction pattern (no more `$rule->assert()`)
- Rule renames (`nullable` → `nullOr`, etc.)
- Removed rules (`age` → `dateTimeDiff`)
- New prefix rules (`keyEmail`, `propertyPositive`, etc.)
- Message customization (`setName` → `Named` rule)

**Output**: Mental model of v3.0 changes and migration paths

---

## Step 2: Update Migration Guide

**File**: `docs/11-migration-from-2x.md`

**Template**: `contracts/migration-guide-template.md`

**Tasks**:

1. Copy template to `docs/11-migration-from-2x.md`
2. Fill placeholders:
   - `[DATE]` → Current date
   - `[DATE + 6 months]` → Support end date
3. Review each breaking change section
4. Add side-by-side examples from `research.md`
5. Ensure all deprecated/removed rules have migration paths

**Validation**:
- [ ] All breaking changes from roadmap covered
- [ ] Every removed rule has replacement example
- [ ] Side-by-side examples compile for both v2.4 and v3.0
- [ ] Support timeline clearly stated

---

## Step 3: Update Major Documentation Sections

**Files**: `docs/01-installation.md` through `docs/09-list-of-rules-by-category.md`

### 3.1 Installation (`01-installation.md`)

**Changes**:
- Update minimum PHP version to 8.1+
- Update Composer require command to `^3.0`

**Example**:
```markdown
## Requirements

- PHP 8.1 or higher
- Composer

## Installation

```bash
composer require respect/validation:^3.0
```
```

### 3.2 Feature Guide (`02-feature-guide.md`)

**Changes**:
- Update all examples to use `v::` facade or `Validator` wrapper
- Add section on prefix rules
- Add section on attributes support
- Show new `assert()` overloads (templates, exceptions, callables)
- Remove `setName()`/`setTemplate()` examples; replace with `Named`/`Templated`

**New Sections to Add**:

```markdown
## Prefix Rules

Prefix rules simplify common validation patterns.

```php
// Traditional
v::key('email', v::email())

// Prefix (v3.0+)
v::keyEmail('email')
```

Available prefixes: `key`, `property`, `length`, `max`, `min`, `nullOr`, `undefOr`

## Using Rules as Attributes

```php
use Respect\Validation\Rules\{Email, Between};

class User
{
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
}

v::attributes()->assert($user);
```
```

### 3.3 Handling Exceptions (`03-handling-exceptions.md`)

**Changes**:
- Show new `Validator::assert()` patterns
- Document `Named` and `Templated` rules
- Update result tree examples with path semantics
- Show new `assert()` overloads

**Example to Add**:
```php
// Custom template string
v::email()->assert($input, 'Email is required');

// Per-rule templates
v::intVal()->positive()->lessThan(100)->assert($input, [
    'intVal' => 'Must be an integer',
    'positive' => 'Must be positive',
    'lessThan' => 'Must be under 100',
]);

// Custom exception
v::email()->assert($input, new DomainException('Invalid email'));

// Callable handler
v::email()->assert($input, fn($e) => logError($e));
```

### 3.4 Message Translation (`04-message-translation.md`)

**Changes**:
- Update examples to use `Named` rule instead of `setName()`
- Show `Templated` rule usage
- Verify translator examples work with v3.0

### 3.5 Placeholder Conversion (`05-message-placeholder-conversion.md`)

**Changes**:
- Document new `{{placeholder|quote}}` filter
- Update examples to v3.0 syntax
- Show filter usage in templates

### 3.6 Concrete API (`06-concrete-api.md`)

**Changes**:
- Add new methods on `Validator` class
- Document `assert()` overloads with signatures
- Remove deprecated methods (`setName`, `setTemplate` on rules)
- Show `Named` and `Templated` rules

### 3.7 Custom Rules (`07-custom-rules.md`)

**Changes**:
- Verify examples show correct v3.0 `Rule` interface implementation
- Ensure custom rule examples use `#[Template]` attributes
- Update test examples to match constitution's test-first approach

### 3.8 Comparable Values (`08-comparable-values.md`)

**Changes**:
- Verify examples run against v3.0
- Update to new rule names (`greaterThanOrEqual` vs `min`)

### 3.9 List of Rules by Category (`09-list-of-rules-by-category.md`)

**Changes**:
- Update rule names (all renames from research.md)
- Remove deleted rules (`Age`, `MinAge`, `MaxAge`, `KeyValue`, `Consecutive`)
- Add new rules (`KeyExists`, `KeyOptional`, `PropertyExists`, `PropertyOptional`, `BetweenExclusive`, `Lazy`, `DateTimeDiff`)
- Add "Prefixes" category with `key`, `property`, `length`, `max`, `min`, `nullOr`, `undefOr`
- Mark deprecated rules with note

**Template for Deprecated Rule**:
```markdown
- ~~Nullable~~ → **NullOr** (renamed in v3.0)
```

---

## Step 4: Update Rule Documentation

**Files**: `docs/rules/*.md` (162 files)

**Schema**: `contracts/rule-doc-schema.md`

**Process**:

### 4.1 Identify Rules Needing Updates

**Categories**:

1. **Renamed rules**: `Nullable`, `Optional`, `Min`, `Max`, `Attribute`, `NotOptional`
2. **Removed rules**: `Age`, `MinAge`, `MaxAge`, `KeyValue`, `Consecutive`
3. **Split rules**: `Key`, `Property` (now have `*Exists` and `*Optional` variants)
4. **New rules**: `KeyExists`, `KeyOptional`, `PropertyExists`, `PropertyOptional`, `BetweenExclusive`, `Lazy`, `DateTimeDiff`, prefix variants
5. **All other rules**: Update examples to v3.0 syntax

### 4.2 Update Renamed Rules

**Pattern**: Add deprecation notice at top

```markdown
# NullOr

!!! note "Renamed in v3.0"
    This rule was called `Nullable` in v2.x. The old name is deprecated.
    See [Migration Guide](../11-migration-from-2x.md#rule-renames) for details.

Validates that input is null or passes the wrapped rule.

{Continue with standard doc structure}
```

### 4.3 Update Removed Rules

**Pattern**: Add removal notice with replacement

```markdown
# Age

!!! warning "Removed in v3.0"
    This rule was removed. Use [DateTimeDiff](./DateTimeDiff.md) instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::age(18)

// v3.0
v::dateTimeDiff('years', now())->equals(18)
```

{Include v2.x documentation for reference}
```

### 4.4 Create New Rule Docs

**Template**: Use `contracts/rule-doc-schema.md`

**For Prefix Rules**: Include prefix usage section

**For Split Rules**: Document relationship to original rule

**Example** (`KeyExists.md`):
```markdown
# KeyExists

!!! note "New in v3.0"
    This rule was split from `Key` in v3.0 to provide clearer semantics.

Validates that a specific key exists in an array.

## Usage

```php
v::keyExists('email')->assert(['email' => '']); // passes (key exists)
v::keyExists('email')->assert(['name' => 'John']); // throws (key missing)
```

{Continue with standard sections}

## See Also

- [Key](./Key.md) - Validate key value
- [KeyOptional](./KeyOptional.md) - Validate optional key
```

### 4.5 Update All Examples

**For Every Rule Doc**:

1. Open file
2. Find PHP code blocks
3. Verify each uses `v::` facade
4. Remove any `<?php` tags
5. Add inline comments (`// passes`, `// throws ValidationException`)
6. Test example compiles (mentally or with script)
7. Save

**Batch Find/Replace** (safe operations):
- Find: `<?php\n` → Replace: `` (empty)
- Find: `->nullable(` → Replace: `->nullOr(`
- Find: `->optional(` → Replace: `->undefOr(`

---

## Step 5: Validate Examples

**Manual Process** (for this feature):

1. Open each updated file
2. Copy code example
3. Wrap with context:
   ```php
   <?php
   require 'vendor/autoload.php';
   use Respect\Validation\Validator as v;
   
   {PASTE_EXAMPLE}
   ```
4. Run via `php -r "{CODE}"`
5. Verify output matches expectation
6. Fix any failing examples

**Automated Process** (future enhancement):
```bash
bin/validate-doc-examples docs/rules/Email.md
bin/validate-doc-examples docs/ # All files
```

---

## Step 6: Check Links

**Tool**: Use link checker (e.g., `markdown-link-check`)

**Manual Process**:

1. List all internal links: `grep -r "\[.*\](.*/.*\.md" docs/`
2. For each link, verify target file exists
3. For anchor links (`#section`), verify heading exists in target
4. Fix broken links

**Common Link Issues**:
- Renamed rule links (update to new names)
- Removed rule links (redirect to migration guide)
- Category page links (update for new/removed rules)

---

## Step 7: Final Review

### 7.1 Content Checklist

- [ ] Migration guide complete with all breaking changes
- [ ] All major sections updated with v3.0 examples
- [ ] All rule docs updated (renamed, removed, new, existing)
- [ ] PHP version requirements updated (8.1+)
- [ ] Composer commands show `^3.0`
- [ ] No `<?php` tags in examples
- [ ] All examples use `v::` facade or explicit `Validator` wrapper
- [ ] Deprecation/removal notices on affected rules
- [ ] Cross-links between related rules and sections

### 7.2 Style Checklist

- [ ] Direct, concise language ("Use X" not "You can use X")
- [ ] Inline comments on examples (`// passes`, `// throws`)
- [ ] Consistent heading levels (ATX style with space)
- [ ] Relative links for internal references
- [ ] MkDocs-compatible admonitions (`!!! note`, `!!! warning`)

### 7.3 Validation Checklist

- [ ] No broken internal links
- [ ] All code examples compile
- [ ] Category list matches rule files
- [ ] Migration guide covers all roadmap items
- [ ] Success criteria met (from spec.md):
  - [ ] 0 broken links (automated check passes)
  - [ ] 100% of changed pages have v3.0 note
  - [ ] 95% of examples run successfully

---

## Step 8: Update Metadata Files

### 8.1 MkDocs Config (`mkdocs.yml`)

**Changes**:
- Add migration guide to navigation
- Verify all section titles match file names

**Example**:
```yaml
site_name: Respect\Validation
theme: readthedocs
nav:
  - Home: index.md
  - Installation: 01-installation.md
  - Feature Guide: 02-feature-guide.md
  - Handling Exceptions: 03-handling-exceptions.md
  - Message Translation: 04-message-translation.md
  - Message Placeholder Conversion: 05-message-placeholder-conversion.md
  - Concrete API: 06-concrete-api.md
  - Custom Rules: 07-custom-rules.md
  - Comparable Values: 08-comparable-values.md
  - Rules by Category: 09-list-of-rules-by-category.md
  - License: 10-license.md
  - Migration from 2.x: 11-migration-from-2x.md
  - Rules:
    - Email: rules/Email.md
    - Between: rules/Between.md
    # ... (all rule pages)
```

### 8.2 Changelog (`CHANGELOG.md`)

**Changes**:
- Add v3.0 section at top
- Summarize breaking changes
- Link to migration guide

**Template**:
```markdown
# Changes in Respect\Validation 3.x

## 3.0.0 - [RELEASE_DATE]

Version 3.0 introduces significant improvements to validation architecture, naming consistency, and modern PHP support.

**Breaking Changes**:

- Validation methods (`assert`, `check`) now only available on `Validator` class
- Multiple rule renames for semantic clarity (see migration guide)
- Removed age-specific rules in favor of general `DateTimeDiff`
- Minimum PHP version: 8.1

**New Features**:

- Prefix rules for concise validation patterns
- PHP 8 attributes support for declarative validation
- Enhanced error paths for nested structures
- Flexible `assert()` overloads (templates, exceptions, callables)

**See Also**: [Migration Guide](docs/11-migration-from-2x.md)

**Support**: Version 2.x receives critical security fixes until [DATE + 6 months].

---

{Keep existing 2.x and 1.x sections below}
```

### 8.3 README (`README.md`)

**Changes**:
- Update examples to v3.0 syntax
- Add note about v2.x support timeline
- Link to migration guide

**Example Section to Update**:
```markdown
## Quick Example

```php
use Respect\Validation\Validator as v;

// Simple validation
v::email()->assert('user@example.com');

// Chained rules
v::intVal()->positive()->between(1, 100)->assert(50);

// Complex structures
v::keySet(
    v::keyEmail('email'),
    v::key('age', v::intVal()->between(18, 120))
)->assert($userData);
```

## Version Support

- **v3.x**: Current stable version (PHP 8.1+)
- **v2.x**: Critical security fixes until [DATE] ([Migration Guide](docs/11-migration-from-2x.md))
- **v1.x**: No longer supported
```

---

## Common Pitfalls

### ❌ Forgetting to Update Examples

**Issue**: Examples still show v2.x patterns

**Fix**: Search for `->assert(` calls; verify they use `v::` or `Validator` wrapper

### ❌ Broken Links After Renames

**Issue**: Links to `Nullable.md` break (file renamed to `NullOr.md`)

**Fix**: Run link checker; update all references to renamed files

### ❌ Inconsistent Terminology

**Issue**: Mixing "nullable", "NullOr", and "null or valid"

**Fix**: Use official v3.0 names consistently; mention old names only in migration context

### ❌ Missing Migration Paths

**Issue**: Removed rule documented but no replacement shown

**Fix**: Every removed rule must have clear v3.0 alternative in migration guide

---

## Time Estimates

| Task | Estimated Time |
|------|----------------|
| Review breaking changes | 30 minutes |
| Update migration guide | 2 hours |
| Update major sections (1-10) | 4 hours |
| Update rule docs (162 files) | 8-12 hours |
| Validate examples | 2-4 hours |
| Check links | 1 hour |
| Final review | 2 hours |
| **Total** | **20-25 hours** |

**Parallelization**: Rule docs can be updated in parallel by multiple contributors.

---

## Getting Help

- **Spec**: `spec.md` - Feature requirements and success criteria
- **Research**: `research.md` - Breaking changes catalog
- **Data Model**: `data-model.md` - Documentation entity structure
- **Schemas**: `contracts/` - Templates for migration guide, rule docs, examples
- **Constitution**: `.specify/memory/constitution.md` - Quality standards

**Questions**: Open discussion in feature branch PR or project issue tracker.

