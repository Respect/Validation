# Implementation Plan: Version 3.0 Release Readiness (Documentation)

**Branch**: `002-v3-release-prep` | **Date**: 2025-10-31 | **Spec**: [spec.md](./spec.md)
**Input**: Feature specification from `/specs/002-v3-release-prep/spec.md`

## Summary

Update all documentation to reflect v3.0 changes, provide migration guide from v2.4, and ensure examples align with v3.0 behavior. Focus on breaking changes (validator construction, rule renames, message system updates), new prefix rules, attribute support, and simplified validation engine. Docs will use MkDocs-compatible Markdown with direct, concise language. PHP examples omit `<?php` tags and assume `v` alias for `Respect\Validation\Validator`.

## Technical Context

**Language/Version**: PHP 8.1+ (v3.0 drops support for PHP 8.0 and below)  
**Primary Dependencies**: MkDocs (ReadTheDocs theme), Composer, PHPUnit/Pest for example validation  
**Storage**: Markdown files in `docs/` directory, structured by topic and rule reference  
**Testing**: Manual example validation against v3.0 library, automated link checking  
**Target Platform**: Web documentation hosted at respect-validation.readthedocs.io  
**Project Type**: PHP validation library documentation (single project, docs-focused feature)  
**Performance Goals**: All code examples must execute successfully; link check passes in <30 seconds  
**Constraints**: Maintain existing URL structure where possible; minimize doc redirects  
**Scale/Scope**: 11 major doc sections + 162 rule reference pages + 1 new migration guide

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

### Quality Gates

- **Documentation Obligation** (✓): Migration guide and updated rule docs satisfy IV.Documentation Obligation
- **Simplicity & Clarity** (✓): Direct language requirement aligns with V.Simplicity & Clarity
- **No implementation required** (✓): Documentation-only feature; no code changes to validate against test-first mandate

### Potential Risks

- **Example validation**: Examples must run against v3.0 to satisfy constitution's quality standards
  - **Mitigation**: Create automated example extraction/validation script (Phase 1)
  
- **Breaking changes communication**: Must be clear and accurate per Open Source Collaboration IV
  - **Mitigation**: Comprehensive breaking changes table with rationale (research phase)

### Post-Phase 1 Re-check

**Re-evaluation After Design Phase**:

All constitution gates remain satisfied:

- **Documentation Obligation** (✓): Migration guide template, rule doc schema, and examples schema fulfill documentation standards per IV.Documentation Obligation
- **Simplicity & Clarity** (✓): Style guidelines enforce direct language per V.Simplicity & Clarity; examples follow "show, don't tell" principle
- **Quality Assurance** (✓): Example validation process ensures code examples meet "testable and executable" standard per II.Quality Assurance Pipeline
- **No Code Changes** (✓): Feature remains documentation-only; no new code to test per I.Test-First Development

**Risks Mitigated**:
- Example validation strategy defined in `contracts/examples-schema.md` with execution template
- Breaking changes comprehensively cataloged in `research.md` with migration paths
- Constitution's clarity and simplicity standards embedded in style guidelines

**Conclusion**: All design artifacts support constitution compliance. Ready for Phase 2 (tasks breakdown).

## Project Structure

### Documentation (this feature)

```text
specs/002-v3-release-prep/
├── plan.md              # This file
├── research.md          # Phase 0: Breaking changes inventory, doc structure decisions
├── data-model.md        # Phase 1: Documentation entities and relationships
├── quickstart.md        # Phase 1: Quick reference for doc update workflow
├── contracts/           # Phase 1: Doc page schemas and migration guide template
│   ├── migration-guide-template.md
│   ├── rule-doc-schema.md
│   └── examples-schema.md
└── tasks.md             # Phase 2: NOT created by this command
```

### Source Code (repository root)

```text
docs/                              # Primary documentation directory
├── index.md                       # Landing page - update for v3
├── 01-installation.md             # Update PHP version requirements
├── 02-feature-guide.md            # Update all examples; add prefix rules section
├── 03-handling-exceptions.md     # Document new exception handling in Validator
├── 04-message-translation.md     # Update message rendering examples
├── 05-message-placeholder-conversion.md  # Document new placeholder behaviors
├── 06-concrete-api.md             # Add new methods; document changed signatures
├── 07-custom-rules.md             # Update to reflect v3 Rule interface
├── 08-comparable-values.md        # Verify examples against v3
├── 09-list-of-rules-by-category.md  # Update rule list; add prefixes; note removals
├── 10-license.md                  # No changes
├── 11-migration-from-2x.md        # NEW: Migration guide (main deliverable)
└── rules/                         # 162 rule reference pages
    ├── *.md                       # Update examples, signatures, deprecation notes
    └── [new rules if any]

mkdocs.yml                         # Update nav structure for migration guide
CHANGELOG.md                       # Add v3.0 section with summary
README.md                          # Update examples to v3 syntax; note 2.x EOL
```

**Structure Decision**: Documentation-only feature using existing `docs/` structure. Main additions are migration guide (`11-migration-from-2x.md`) and comprehensive updates to all sections. MkDocs config (`mkdocs.yml`) updated to include new guide in navigation.

## Complexity Tracking

No violations. Documentation updates align with all constitution principles.
