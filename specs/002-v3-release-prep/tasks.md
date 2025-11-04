# Tasks: Version 3.0 Release Readiness (Documentation)

**Input**: Design documents from `/specs/002-v3-release-prep/`
**Prerequisites**: plan.md (required), spec.md (required for user stories), research.md, data-model.md, contracts/
**Repository Root**: `/Users/henriquemoody/opt/personal/Validation/`

**Tests**: The examples below include test tasks. Tests are OPTIONAL - only include them if explicitly requested in the feature specification.

**Organization**: Tasks are grouped by user story to enable independent implementation and testing of each story.

## Format: `[ID] [P?] [Story] Description`

- **[P]**: Can run in parallel (different files, no dependencies)
- **[Story]**: Which user story this task belongs to (e.g., US1, US2, US3)
- Include exact file paths in descriptions

## Path Conventions

- **Documentation feature**: Files in `docs/` directory at repository root
- **Source files**: `docs/`, `mkdocs.yml`, `CHANGELOG.md`, `README.md`
- **Rule documentation**: `docs/rules/` directory with 162+ files

<!-- 
  ============================================================================
  IMPORTANT: The tasks below are ACTUAL tasks based on:
  - User stories from spec.md (with their priorities P1, P2, P3...)
  - Feature requirements from plan.md
  - Entities from data-model.md
  - Endpoints from contracts/
  
  Tasks are organized by user story so each story can be:
  - Implemented independently
  - Tested independently
  - Delivered as an MVP increment
  ============================================================================
-->

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Project initialization and basic structure for documentation update

- [x] T001 Create project structure per implementation plan in specs/002-v3-release-prep/
- [x] T002 Initialize documentation validation environment with MkDocs and PHPUnit dependencies
- [x] T003 [P] Configure linting and formatting tools for Markdown documentation
- [x] T004 [P] Set up example validation script for testing code examples against v3.0 library

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Core infrastructure that MUST be complete before ANY user story can be implemented

**⚠️ CRITICAL**: No user story work can begin until this phase is complete

- [x] T005 Setup migration guide template from contracts/migration-guide-template.md to docs/11-migration-from-2x.md
- [x] T006 [P] Create rule documentation schema validation script based on contracts/rule-doc-schema.md
- [x] T007 [P] Setup example validation framework based on contracts/examples-schema.md
- [x] T008 Configure link checking tool for documentation cross-references
- [x] T009 Setup environment with v3.0 library for example validation

**Checkpoint**: Foundation ready - user story implementation can now begin in parallel

---

## Phase 3: User Story 1 - Upgrade via Migration Guide (Priority: P1) 🎯 MVP

**Goal**: Provide a comprehensive migration guide that enables safe, predictable upgrade from v2.4 to v3.0

**Independent Test**: Follow the migration guide to update a minimal v2.4 sample project to v3.0 until all examples/tests pass without consulting external sources

### Tests for User Story 1 (OPTIONAL - only if tests requested) ⚠️

> **NOTE: Write these tests FIRST, ensure they FAIL before implementation**

- [x] T010 [P] [US1] Validate migration guide structure against template in docs/11-migration-from-2x.md
- [x] T011 [P] [US1] Test all side-by-side examples in migration guide compile for both v2.4 and v3.0

### Implementation for User Story 1

- [x] T012 [P] [US1] Update migration guide metadata (dates, version) in docs/11-migration-from-2x.md
- [x] T013 [P] [US1] Fill in breaking changes section with all v3.0 changes from research.md
- [x] T014 [US1] Complete validator construction pattern section with examples in docs/11-migration-from-2x.md
- [x] T015 [US1] Document rule renames with find/replace guidance in docs/11-migration-from-2x.md
- [x] T016 [US1] Add removed rules migration paths with examples in docs/11-migration-from-2x.md
- [x] T017 [US1] Complete split rules documentation with usage patterns in docs/11-migration-from-2x.md
- [x] T018 [US1] Document message customization changes (setName/setTemplate) in docs/11-migration-from-2x.md
- [x] T019 [US1] Add KeySet negation workaround examples in docs/11-migration-from-2x.md
- [x] T020 [US1] Complete new features section (prefix rules, attributes, enhanced error handling) in docs/11-migration-from-2x.md
- [x] T021 [US1] Document deprecation warnings and temporary compatibility in docs/11-migration-from-2x.md
- [x] T022 [US1] Add testing your migration section with step-by-step validation in docs/11-migration-from-2x.md
- [x] T023 [US1] Complete common gotchas section with real-world examples in docs/11-migration-from-2x.md
- [x] T024 [US1] Update support and resources section with correct links and dates in docs/11-migration-from-2x.md
- [x] T025 [US1] Finalize summary checklist for migration completeness in docs/11-migration-from-2x.md
- [x] T026 [US1] Validate all code examples in migration guide execute correctly against v3.0

**Checkpoint**: At this point, User Story 1 should be fully functional and testable independently

---

## Phase 4: User Story 2 - Updated Rules and API Documentation (Priority: P2)

**Goal**: Ensure all rules, categories, options, and examples reflect v3.0 behavior with accurate cross-references

**Independent Test**: Randomly sample rules from docs; verify each has an example that works as written against v3.0 and links to the correct API section

### Tests for User Story 2 (OPTIONAL - only if tests requested) ⚠️

- [x] T027 [P] [US2] Validate rule catalog completeness in docs/09-list-of-rules-by-category.md
- [x] T028 [P] [US2] Test randomly sampled rule examples execute successfully against v3.0

### Implementation for User Story 2

- [x] T029 [P] [US2] Update installation requirements to PHP 8.1+ in docs/01-installation.md
- [x] T030 [P] [US2] Update Composer command to ^3.0 in docs/01-installation.md
- [x] T031 [P] [US2] Add prefix rules section to docs/02-feature-guide.md
- [x] T032 [P] [US2] Add attributes support section to docs/02-feature-guide.md
- [x] T033 [P] [US2] Update assert() overloads documentation in docs/02-feature-guide.md
- [x] T034 [P] [US2] Replace setName()/setTemplate() examples with Named/Templated rules in docs/02-feature-guide.md
- [x] T035 [P] [US2] Update all examples in docs/03-handling-exceptions.md to v3.0 syntax
- [x] T036 [P] [US2] Document Named and Templated rules in docs/03-handling-exceptions.md
- [x] T037 [P] [US2] Update result tree examples with path semantics in docs/03-handling-exceptions.md
- [x] T038 [P] [US2] Document new assert() overloads in docs/03-handling-exceptions.md
- [x] T039 [P] [US2] Update examples to use Named rule instead of setName() in docs/04-message-translation.md
- [x] T040 [P] [US2] Show Templated rule usage in docs/04-message-translation.md
- [x] T041 [P] [US2] Document new {{placeholder|quote}} filter in docs/05-message-placeholder-conversion.md
- [x] T042 [P] [US2] Update all examples in docs/05-message-placeholder-conversion.md to v3.0 syntax
- [x] T043 [P] [US2] Show filter usage in templates in docs/05-message-placeholder-conversion.md
- [x] T044 [P] [US2] Add new methods on Validator class to docs/06-concrete-api.md
- [x] T045 [P] [US2] Document assert() overloads with signatures in docs/06-concrete-api.md
- [x] T046 [P] [US2] Remove deprecated methods documentation in docs/06-concrete-api.md
- [x] T047 [P] [US2] Show Named and Templated rules in docs/06-concrete-api.md
- [x] T048 [P] [US2] Verify custom rule examples show correct v3.0 Rule interface in docs/07-custom-rules.md
- [x] T049 [P] [US2] Ensure custom rule examples use #[Template] attributes in docs/07-custom-rules.md
- [x] T050 [P] [US2] Verify examples in docs/08-comparable-values.md run against v3.0
- [x] T051 [P] [US2] Update examples to new rule names in docs/08-comparable-values.md
- [x] T052 [P] [US2] Update rule names in docs/09-list-of-rules-by-category.md (all renames from research.md)
- [x] T053 [P] [US2] Remove deleted rules from docs/09-list-of-rules-by-category.md
- [x] T054 [P] [US2] Add new rules to docs/09-list-of-rules-by-category.md
- [x] T055 [P] [US2] Add "Prefixes" category to docs/09-list-of-rules-by-category.md
- [x] T056 [P] [US2] Mark deprecated rules with clear notes in docs/09-list-of-rules-by-category.md
- [x] T057 [P] [US2] Update all 162+ rule documentation files in docs/rules/ to v3.0 syntax
- [x] T058 [P] [US2] Add deprecation notices to renamed rule docs in docs/rules/
- [x] T059 [P] [US2] Add removal notices with replacements to removed rule docs in docs/rules/
- [x] T060 [P] [US2] Create documentation for new rule variants (KeyExists, KeyOptional, etc.) in docs/rules/
- [x] T061 [P] [US2] Create documentation for new prefix rules in docs/rules/
- [x] T062 [P] [US2] Update all examples in rule docs to use v:: facade
- [x] T063 [P] [US2] Remove <?php tags from all examples in documentation
- [x] T064 [P] [US2] Add inline comments to examples showing expected outcomes
- [x] T065 [US2] Validate that 95% of sampled code examples from docs run successfully against v3.0

**Checkpoint**: At this point, User Stories 1 AND 2 should both work independently

---

## Phase 5: User Story 3 - Exceptions, Messages, and Translations (Priority: P3)

**Goal**: Ensure users understand changes to exception behavior, message rendering, placeholder conversion, and translation in v3.0

**Independent Test**: Execute the provided examples for exceptions/messages/translation; outputs match the documented strings and formats

### Tests for User Story 3 (OPTIONAL - only if tests requested) ⚠️

- [x] T066 [P] [US3] Validate exception examples produce documented output in docs/03-handling-exceptions.md
- [x] T067 [P] [US3] Test placeholder conversion examples with different locales in docs/05-message-placeholder-conversion.md

### Implementation for User Story 3

- [x] T068 [P] [US3] Update exception type/hierarchy documentation in docs/03-handling-exceptions.md
- [x] T069 [P] [US3] Document placeholder conversion behaviors for different locales in docs/05-message-placeholder-conversion.md
- [x] T070 [P] [US3] Update message rendering/translation documentation in docs/04-message-translation.md
- [x] T071 [P] [US3] Document placeholder behaviors and formatting changes in docs/04-message-translation.md
- [x] T072 [US3] Verify all exception examples match documented strings and formats
- [x] T073 [US3] Ensure placeholder examples produce documented localized messages

**Checkpoint**: All user stories should now be independently functional

---

## Phase 6: Polish & Cross-Cutting Concerns

**Purpose**: Improvements that affect multiple user stories and final validation

- [x] T074 [P] Update mkdocs.yml navigation to include migration guide at docs/11-migration-from-2x.md
- [x] T075 [P] Add v3.0 section to CHANGELOG.md with summary pointing to migration guide
- [x] T076 [P] Update README.md examples to v3.0 syntax
- [x] T077 [P] Add v2.x support timeline to README.md
- [x] T078 [P] Add link to migration guide in README.md
- [x] T079 Run automated link checker across all updated documentation
- [x] T080 [P] Fix any broken internal links discovered in link check
- [x] T081 [P] Add visible v3.0 applicability notes to 100% of changed pages
- [x] T082 Validate that 0 broken links exist across updated documentation
- [x] T083 Run quickstart.md validation to ensure all steps work correctly
- [x] T084 Final proofread of all documentation for clarity and consistency
- [x] T085 Verify cross-linking integrity between sections
- [x] T086 Ensure all examples execute as written against v3.0

---

## Dependencies & Execution Order

### Phase Dependencies

- **Setup (Phase 1)**: No dependencies - can start immediately
- **Foundational (Phase 2)**: Depends on Setup completion - BLOCKS all user stories
- **User Stories (Phase 3+)**: All depend on Foundational phase completion
  - User stories can then proceed in parallel (if staffed)
  - Or sequentially in priority order (P1 → P2 → P3)
- **Polish (Final Phase)**: Depends on all desired user stories being complete

### User Story Dependencies

- **User Story 1 (P1)**: Can start after Foundational (Phase 2) - No dependencies on other stories
- **User Story 2 (P2)**: Can start after Foundational (Phase 2) - May integrate with US1 but should be independently testable
- **User Story 3 (P3)**: Can start after Foundational (Phase 2) - May integrate with US1/US2 but should be independently testable

### Within Each User Story

- Tests (if included) MUST be written and FAIL before implementation
- Documentation sections can be updated in parallel when marked with [P]
- Story complete before moving to next priority
- All examples validated after implementation

### Parallel Opportunities

- All Setup tasks marked [P] can run in parallel
- All Foundational tasks marked [P] can run in parallel (within Phase 2)
- Once Foundational phase completes, all user stories can start in parallel (if team capacity allows)
- All tests for a user story marked [P] can run in parallel
- Documentation sections within a story marked [P] can run in parallel
- Different user stories can be worked on in parallel by different team members
- Rule documentation files can be updated in parallel by multiple contributors

---

## Parallel Example: User Story 1

```bash
# Launch all sections for User Story 1 together:
Task: "Update migration guide metadata (dates, version) in docs/11-migration-from-2x.md"
Task: "Fill in breaking changes section with all v3.0 changes from research.md"
Task: "Complete validator construction pattern section with examples in docs/11-migration-from-2x.md"
Task: "Document rule renames with find/replace guidance in docs/11-migration-from-2x.md"
Task: "Add removed rules migration paths with examples in docs/11-migration-from-2x.md"
```

---

## Implementation Strategy

### MVP First (User Story 1 Only)

1. Complete Phase 1: Setup
2. Complete Phase 2: Foundational (CRITICAL - blocks all stories)
3. Complete Phase 3: User Story 1
4. **STOP and VALIDATE**: Test User Story 1 independently by following migration guide
5. Deploy/demo if ready

### Incremental Delivery

1. Complete Setup + Foundational → Foundation ready
2. Add User Story 1 → Test independently → Deploy/Demo (MVP!)
3. Add User Story 2 → Test independently → Deploy/Demo
4. Add User Story 3 → Test independently → Deploy/Demo
5. Each story adds value without breaking previous stories

### Parallel Team Strategy

With multiple developers:

1. Team completes Setup + Foundational together
2. Once Foundational is done:
   - Developer A: User Story 1 (Migration Guide)
   - Developer B: User Story 2 (Rules and API Documentation)
   - Developer C: User Story 3 (Exceptions, Messages, and Translations)
3. Stories complete and integrate independently

---

## Notes

- [P] tasks = different files, no dependencies
- [Story] label maps task to specific user story for traceability
- Each user story should be independently completable and testable
- Verify tests fail before implementing
- Commit after each task or logical group
- Stop at any checkpoint to validate story independently
- Avoid: vague tasks, same file conflicts, cross-story dependencies that break independence
- Rule documentation updates (T057-T064) can be distributed across multiple contributors for parallel execution