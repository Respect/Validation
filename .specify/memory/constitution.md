# Respect\Validation Constitution

<!--
Sync Impact Report - Version 1.0.0

Version Change: Initial constitution (template → v1.0.0)

Modified Principles:
- PROJECT_NAME: [TEMPLATE] → Respect\Validation
- All principles defined from template placeholders

Added Sections:
- I. Test-First Development (NON-NEGOTIABLE)
- II. Quality Assurance Pipeline
- III. Code Standards & Type Safety
- IV. Open Source Collaboration
- V. Simplicity & Clarity
- Code Review Requirements
- Quality Gates
- Commit Message Standards

Templates Status:
- ✅ plan-template.md: Compatible (Constitution Check section aligns)
- ✅ spec-template.md: Compatible (Requirements and testing sections align)
- ✅ tasks-template.md: Compatible (Test-first approach and phases align)

Follow-up TODOs:
- None - all placeholders filled based on repository analysis

Ratified: 2025-10-31
-->

## Core Principles

### I. Test-First Development (NON-NEGOTIABLE)

**Dual-Testing Strategy**: Every feature MUST be validated through two complementary test suites:

- **Unit Tests** (PHPUnit): Test individual rules and components in isolation
  - Located in `tests/unit/`
  - MUST extend `RuleTestCase` for rule validation
  - MUST implement `providerForValidInput()` and `providerForInvalidInput()`
  - Tests written BEFORE implementation
  
- **Feature Tests** (Pest): Test complete user scenarios and integration flows
  - Located in `tests/feature/`
  - MUST validate real-world usage patterns
  - MUST test error message rendering and exception handling

**Red-Green-Refactor Cycle**: Tests MUST fail initially, then pass after implementation. No code ships without passing tests.

### II. Quality Assurance Pipeline

**Mandatory Pre-Commit Checks**: All changes MUST pass the complete QA pipeline (`composer qa`) before merge:

1. **docheader**: Verify license headers on all source files
2. **phpcs**: Enforce coding standards (PSR-12 + Respect standards)
3. **phpstan**: Static analysis at level 8 with no ignored production code errors
4. **phpunit**: All unit tests pass
5. **pest**: All feature tests pass

**Non-Negotiable**: A single failure in any stage blocks the merge. No exceptions.

### III. Code Standards & Type Safety

**Strict Typing Mandate**: Every PHP file MUST declare `strict_types=1`. Type hints are REQUIRED for all parameters and return types.

**Encapsulation Defaults**:
- Classes MUST be `final` unless explicitly designed for inheritance
- Properties MUST be `private` unless extension is required
- Methods MUST have explicit visibility modifiers

**Documentation Requirements**:
- License header MUST be present (enforced by docheader)
- Complex logic MUST have explanatory comments
- Public APIs MUST have DocBlocks when native PHP types are insufficient (e.g., array shapes, generic types, additional context)
- Thrown exceptions MUST be documented in DocBlocks when not evident from signature
- Template attributes MUST define both positive and negative validation messages

**Namespace Organization**:
- Rules: `Respect\Validation\Rules\*`
- Exceptions: `Respect\Validation\Exceptions\*`
- Tests mirror library structure

### IV. Open Source Collaboration

**Contribution Workflow**:
- Features and bug fixes MUST reference an existing issue or create one
- Pull requests MUST be based on `main` branch for new features
- Pull requests for bug fixes MUST target the oldest stable version branch
- Contributors MUST allow maintainers time to review (acknowledge delays are expected)

**Documentation Obligation**:
- New rules MUST include documentation in `docs/rules/`
- CONTRIBUTING.md provides the canonical guide for adding validators
- README.md links to comprehensive documentation at respect-validation.readthedocs.io

### V. Simplicity & Clarity

**Rule Design Philosophy**:
- Each rule SHOULD solve one specific validation concern
- Complex validations are composed from simple rules via chaining
- Example: `v::numericVal()->positive()->between(1, 255)`

**Naming Conventions**:
- Rule class names are PascalCase (e.g., `HelloWorld`)
- Fluent API converts to camelCase automatically (e.g., `helloWorld()`)
- Method names MUST be descriptive and unambiguous

**Avoid Over-Engineering**:
- Start with the simplest solution that meets requirements
- Justify complexity in code reviews
- Prefer composition over inheritance
- Delete unnecessary abstractions (example: Mode enum removal in commit 901774f6)

## Code Review Requirements

**Review Gates**:
- All QA checks MUST pass before review begins
- Reviewers MUST verify test coverage for new features
- Reviewers MUST check that rule follows the Simple/Standard pattern
- Documentation updates MUST be included for user-facing changes

**Approval Process**:
- At least one maintainer approval required, unless the author is a maintainer
- CI/CD pipeline MUST be green
- No force-pushes after approval unless requested by maintainer

## Quality Gates

**Definition of Done** for a new rule:
1. Rule class implements `Rule` interface (typically extends `Simple`)
2. Unit test extends `TestCase` with valid and invalid data providers
3. Feature test validates real-world usage and error messages
4. Template attribute defines positive and negative messages
5. Documentation page created in `docs/rules/`
6. All QA checks pass (`composer qa` succeeds)
7. Approved by maintainer

**Performance Standards**:
- Rules MUST execute efficiently for typical validation workloads
- Avoid I/O operations within rule validation logic when possible
- Use dependency injection for external dependencies (e.g., email validators, phone validators)

## Commit Message Standards

**Format**: Descriptive imperative mood without conventional commit prefixes

**Structure**:
```
<Concise imperative summary line>

<Detailed explanation of what changed and why>
<Rationale for the approach taken>
<Context about alternatives considered or issues resolved>
```

**Examples** (from repository history):
```
Improve naming and delete unnecessary `Mode`

I don't expect us to have more modes, hence a simple boolean value
should be enough for indicating the mode of the template. Apart from
that, the name "inverted" wouldn't always make sense, because if you
invert something that is inverted, it gets back to its original mode.

This commit will remove the `Mode` enum, and also improve the naming of
some methods in the `Result`.
```

```
Use paths to identify when a rule fails

When nested-structural validation fails, it's challenging to identify
which rule failed from the main exception message. A great example is
the `Issue796Test.php` file. The exception message says:

host must be a string

But you're left unsure whether it's the `host` key from the `mysql` key
or the `postgresql` key.

This commit changes that behaviour by introducing the concept of "Path."
The `path` represents the path that a rule has taken, and we can use it
in structural rules to identify the path of an array or object.
```

**Guidelines**:
- First line: Concise, imperative mood (e.g., "Add", "Fix", "Improve", "Remove")
- Body: Explain the problem, solution, and rationale
- Include examples or before/after comparisons when helpful
- Reference issue numbers when applicable
- No scope prefixes (no `feat:`, `fix:`, etc.)
- Focus on clarity and context for future maintainers

## Governance

**Constitution Authority**: This constitution supersedes informal practices and provides the binding standards for the project.

**Amendment Process**:
1. Proposed amendments MUST be documented in an issue or pull request
2. Amendments require approval from project maintainers
3. Version bumps follow semantic versioning:
   - **MAJOR**: Backward-incompatible changes to governance or removed principles
   - **MINOR**: New principles added or existing ones materially expanded
   - **PATCH**: Clarifications, wording improvements, or non-semantic refinements

**Compliance Review**:
- All pull requests MUST verify compliance with this constitution
- Complexity MUST be justified and documented
- Violations found in reviews block merge until resolved

**Runtime Guidance**:
- Refer to CONTRIBUTING.md for day-to-day development guidance
- Refer to docs/ for user-facing documentation standards
- Refer to this constitution for non-negotiable principles and quality gates

**Version**: 1.0.0 | **Ratified**: 2025-10-31 | **Last Amended**: 2025-10-31
