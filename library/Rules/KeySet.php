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

/**
 * Validates a keys in a defined structure.
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeySet extends AbstractWrapper implements NonNegatable
{
    /**
     * @var mixed[]
     */
    private $keys;

    /**
     * @var mixed[]
     */
    private $extraKeys = [];

    /**
     * @var Key[]
     */
    private $keyRules;

    /**
     * Initializes the rule.
     *
     * phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.UselessAnnotation
     * @param Validatable ...$validatables
     */
    public function __construct(Validatable ...$validatables)
    {
        $this->keyRules = array_map([$this, 'getKeyRule'], $validatables);
        $this->keys = array_map([$this, 'getKeyReference'], $this->keyRules);

        parent::__construct(new AllOf(...$this->keyRules));
    }

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::assert($input);
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::check($input);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
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

    /**
     * @return mixed
     */
    private function getKeyReference(Key $rule)
    {
        return $rule->getReference();
    }

    /**
     * @param mixed $input
     */
    private function hasValidStructure($input): bool
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
