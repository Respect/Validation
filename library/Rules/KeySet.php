<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\NonNegatable;
use Respect\Validation\Validatable;

use function array_key_exists;
use function array_map;
use function count;
use function current;
use function is_array;

final class KeySet extends AbstractWrapper implements NonNegatable
{
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

    /**
     * @throws ComponentException
     */
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
