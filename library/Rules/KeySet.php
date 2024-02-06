<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\NonOmissibleValidationException;
use Respect\Validation\Message\Template;
use Respect\Validation\NonNegatable;
use Respect\Validation\Validatable;

use function array_key_exists;
use function array_map;
use function count;
use function current;
use function is_array;

#[ExceptionClass(NonOmissibleValidationException::class)]
#[Template(
    'All of the required rules must pass for {{name}}',
    '',
    self::TEMPLATE_NONE,
)]
#[Template(
    'These rules must pass for {{name}}',
    '',
    self::TEMPLATE_SOME,
)]
#[Template(
    'Must have keys {{keys}}',
    '',
    self::TEMPLATE_STRUCTURE,
)]
#[Template(
    'Must not have keys {{extraKeys}}',
    '',
    self::TEMPLATE_STRUCTURE_EXTRA,
)]
final class KeySet extends AbstractWrapper implements NonNegatable
{
    public const TEMPLATE_NONE = 'none';
    public const TEMPLATE_SOME = 'some';
    public const TEMPLATE_STRUCTURE = 'structure';
    public const TEMPLATE_STRUCTURE_EXTRA = 'structure_extra';

    /**
     * @var mixed[]
     */
    private readonly array $keys;

    /**
     * @var mixed[]
     */
    private array $extraKeys = [];

    /**
     * @var Key[]
     */
    private readonly array $keyRules;

    public function __construct(Validatable ...$validatables)
    {
        $this->keyRules = array_map([$this, 'getKeyRule'], $validatables);
        $this->keys = array_map([$this, 'getKeyReference'], $this->keyRules);

        parent::__construct(new AllOf(...$this->keyRules));
    }

    public function assert(mixed $input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::assert($input);
    }

    public function check(mixed $input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::check($input);
    }

    public function validate(mixed $input): bool
    {
        if (!$this->hasValidStructure($input)) {
            return false;
        }

        return parent::validate($input);
    }

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

        if (count($this->extraKeys)) {
            return self::TEMPLATE_STRUCTURE_EXTRA;
        }

        return KeySet::TEMPLATE_STRUCTURE;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return [
            'keys' => $this->keys,
            'extraKeys' => $this->extraKeys,
        ];
    }

    private function getKeyRule(Validatable $validatable): Key
    {
        if ($validatable instanceof Key) {
            return $validatable;
        }

        if (!$validatable instanceof AllOf || count($validatable->getRules()) !== 1) {
            throw new ComponentException('KeySet rule accepts only Key rules');
        }

        return $this->getKeyRule(current($validatable->getRules()));
    }

    private function getKeyReference(Key $rule): mixed
    {
        return $rule->getReference();
    }

    private function hasValidStructure(mixed $input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        foreach ($this->keyRules as $keyRule) {
            if (!array_key_exists($keyRule->getReference(), $input) && $keyRule->isMandatory()) {
                return false;
            }

            unset($input[$keyRule->getReference()]);
        }

        foreach ($input as $extraKey => &$ignoreValue) {
            $this->extraKeys[] = $extraKey;
        }

        return count($input) == 0;
    }
}
