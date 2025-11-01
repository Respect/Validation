# Data Model: Documentation Entities

**Feature**: Version 3.0 Release Readiness (Documentation)  
**Date**: 2025-10-31  
**Purpose**: Define the logical structure of documentation entities, their relationships, and validation rules

## Core Entities

### DocumentationSection

Represents a major documentation page or section.

**Attributes**:
- `filename`: String - File path relative to `docs/` (e.g., `02-feature-guide.md`)
- `title`: String - Human-readable section title
- `order`: Integer - Display order in navigation (01-11)
- `mkdocs_nav_title`: String - Title as shown in MkDocs navigation
- `needs_v3_update`: Boolean - Whether section requires v3 content changes
- `examples_count`: Integer - Number of PHP code examples in section
- `internal_links`: Array<String> - Relative links to other sections
- `external_links`: Array<String> - Links to external resources

**Relationships**:
- Has many `CodeExample`
- References many other `DocumentationSection` (via internal links)

**Validation Rules**:
- `filename` must exist in `docs/` directory
- `title` must be non-empty
- `order` must be unique within major sections
- All `internal_links` must resolve to existing files
- All `examples_count` must match actual code blocks in file

**State Transitions**:
- Draft → In Review → Updated → Validated → Published

---

### Rule

Represents a validation rule with its dedicated documentation page.

**Attributes**:
- `class_name`: String - PHP class name (e.g., `Email`, `Between`)
- `fluent_name`: String - camelCase method name (e.g., `email`, `between`)
- `filename`: String - Docs file path (e.g., `docs/rules/Email.md`)
- `category`: Array<String> - Categories rule belongs to (e.g., ["String", "Internet"])
- `parameters`: Array<Parameter> - Rule constructor parameters
- `since_version`: String - First version where rule appeared (e.g., "1.0.0")
- `deprecated_in`: String|null - Version where deprecated (e.g., "2.4.0")
- `removed_in`: String|null - Version where removed (e.g., "3.0.0")
- `replacement`: String|null - Recommended v3 replacement if deprecated/removed
- `template_message`: String - Default validation failure message
- `examples`: Array<CodeExample> - Usage examples

**Relationships**:
- Has many `CodeExample`
- May have one `DeprecationNote`
- May have one `MigrationPath` (if removed/renamed)
- Belongs to many `Category`

**Validation Rules**:
- `class_name` must match actual class in `library/Rules/`
- `fluent_name` must be camelCase version of `class_name`
- `filename` must match pattern `docs/rules/{class_name}.md`
- `category` must reference valid categories from categories list
- If `removed_in` is "3.0.0", `replacement` must be specified
- All `examples` must execute successfully against v3.0

**Special Cases**:
- **Prefix rules**: Have both standalone and prefix usage patterns
- **Split rules**: Reference multiple replacement rules (e.g., Key → Key/KeyExists/KeyOptional)

---

### CodeExample

Represents a PHP code snippet demonstrating rule usage.

**Attributes**:
- `source_file`: String - Documentation file containing example
- `line_number`: Integer - Starting line in source file
- `code`: String - PHP code (without `<?php` tag)
- `context`: String - Surrounding explanatory text
- `expected_outcome`: Enum - "pass" | "fail" | "throws"
- `requires_setup`: Boolean - Whether example needs additional context
- `v3_compatible`: Boolean - Whether example works with v3 syntax

**Relationships**:
- Belongs to one `DocumentationSection` or `Rule`
- May reference one or more `Rule`

**Validation Rules**:
- `code` must be valid PHP when wrapped with `<?php` and `use Respect\Validation\Validator as v;`
- `code` must not include `<?php` tag (per style guidelines)
- `expected_outcome` must match actual execution result
- `v3_compatible` must be true for all examples in v3 docs

**Execution Template**:
```php
<?php
require 'vendor/autoload.php';
use Respect\Validation\Validator as v;

{CODE}
```

---

### MigrationPath

Represents the upgrade path from v2.4 to v3.0 for a specific change.

**Attributes**:
- `change_type`: Enum - "rename" | "removal" | "split" | "signature_change" | "behavior_change"
- `v2_pattern`: String - v2.4 code pattern (PHP code or description)
- `v3_pattern`: String - v3.0 replacement pattern (PHP code or description)
- `impact_level`: Enum - "breaking" | "deprecation" | "enhancement"
- `automated_migration`: Boolean - Whether find/replace is safe
- `manual_review_required`: Boolean - Whether manual verification needed
- `rationale`: String - Why the change was made
- `additional_notes`: String|null - Edge cases or gotchas

**Relationships**:
- May reference one or more `Rule`
- Included in `MigrationGuide`

**Validation Rules**:
- Both `v2_pattern` and `v3_pattern` must be non-empty
- `impact_level` must be "breaking" or "deprecation" for removed/renamed rules
- If `automated_migration` is true, `v2_pattern` must be exact code match
- `rationale` must be non-empty for breaking changes

**Examples**:

```yaml
# Rename Migration
change_type: rename
v2_pattern: "v::nullable(v::email())"
v3_pattern: "v::nullOr(v::email())"
impact_level: breaking
automated_migration: true
manual_review_required: false
rationale: "Clearer semantic meaning; consistent with UndefOr naming"

# Removal Migration
change_type: removal
v2_pattern: "v::age(18)"
v3_pattern: "v::dateTimeDiff('years', now())->greaterThanOrEqual(18)"
impact_level: breaking
automated_migration: false
manual_review_required: true
rationale: "Age rule was too specific; DateTimeDiff provides general solution"
additional_notes: "Verify date input format matches your use case"
```

---

### MessageTemplate

Represents a validation failure message with placeholders.

**Attributes**:
- `rule_name`: String - Rule class name
- `mode`: Enum - "positive" | "negative"
- `template`: String - Message with placeholders (e.g., `{{name}} must be valid`)
- `placeholders`: Array<String> - List of available placeholders
- `supports_filters`: Boolean - Whether placeholders support filters (e.g., `|quote`)
- `translatable`: Boolean - Whether message participates in i18n

**Relationships**:
- Belongs to one `Rule`

**Validation Rules**:
- `template` must contain at least one placeholder
- All placeholders in `template` must be documented in `placeholders` array
- Standard placeholders: `{{name}}`, `{{input}}`, rule-specific placeholders
- Filter syntax `{{placeholder|filter}}` valid only if `supports_filters` is true

**Example**:
```yaml
rule_name: "Between"
mode: positive
template: "{{name}} must be between {{minValue}} and {{maxValue}}"
placeholders: ["name", "input", "minValue", "maxValue"]
supports_filters: true
translatable: true
```

---

### Category

Represents a logical grouping of rules in the documentation catalog.

**Attributes**:
- `name`: String - Category name (e.g., "String Validation", "Numeric")
- `description`: String - Brief description of category purpose
- `display_order`: Integer - Order in rule catalog listing

**Relationships**:
- Has many `Rule`

**Validation Rules**:
- `name` must be unique
- `display_order` must be unique

**Standard Categories** (from existing docs):
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

---

## Relationships Diagram

```
DocumentationSection
  │
  ├─── has many ───> CodeExample
  │
  └─── links to ───> DocumentationSection (cross-references)

Rule
  │
  ├─── has many ───> CodeExample
  ├─── belongs to many ───> Category
  ├─── has one ───> MessageTemplate (positive)
  ├─── has one ───> MessageTemplate (negative)
  └─── may have one ───> MigrationPath

MigrationGuide (composite)
  │
  └─── contains many ───> MigrationPath
```

## Validation Workflow

### Phase 1: Structure Validation

For each `DocumentationSection`:
1. Verify file exists at `filename` path
2. Check `title` appears in file frontmatter or first heading
3. Validate all `internal_links` resolve
4. Count code blocks; compare to `examples_count`

### Phase 2: Content Validation

For each `CodeExample`:
1. Extract code from documentation
2. Wrap with execution template
3. Execute via PHP CLI
4. Compare actual outcome to `expected_outcome`
5. Flag mismatches for manual review

### Phase 3: Cross-Reference Validation

For each `Rule`:
1. Verify `class_name` exists in `library/Rules/`
2. Check rule appears in category listing (09-list-of-rules-by-category.md)
3. Verify links from category page to rule page
4. If deprecated/removed, verify `MigrationPath` exists in migration guide

### Phase 4: Migration Completeness

1. Enumerate all breaking changes from roadmap and research
2. Verify each has corresponding `MigrationPath` in migration guide
3. Check all deprecated rules have clear replacement guidance
4. Validate side-by-side examples compile for both v2.4 and v3.0

## Data Integrity Constraints

### Cross-File Consistency

- Rule list in `09-list-of-rules-by-category.md` MUST match files in `docs/rules/`
- Removed rules in migration guide MUST NOT have active doc pages (or must be marked "Removed in v3")
- All `KeySet`, `KeyExists`, `KeyOptional` docs must reference split from original `Key` rule
- PHP version requirement in `01-installation.md` MUST state "PHP 8.1+"

### Example Correctness

- No example may use `$email->assert()` pattern (v2 only)
- All examples must use `v::` facade or `new Validator()` wrapper
- Deprecated patterns may appear in migration guide with clear "v2.4 only" labels
- All v3 examples must execute without errors

### Message Consistency

- Template messages in rule docs must match `#[Template]` attribute in source code
- Placeholder documentation must match actual available placeholders
- Examples showing error messages must reflect actual v3 outputs

## Out of Scope

- **Translation files**: Not part of this feature (English docs only)
- **API reference generation**: Manual docs maintenance (no automation planned)
- **Versioned docs infrastructure**: Single live v3 docs (per spec decision)
- **Example automation**: Manual validation this phase; tooling is future enhancement

