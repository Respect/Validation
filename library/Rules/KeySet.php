<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;
use function array_key_exists;
use function array_map;
use function count;
use function current;
use function is_array;

/**
 * Validates a keys in a defined structure.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 */
final class KeySet extends AbstractWrapper
{
    /**
     * @var array
     */
    private $keys;

    /**
     * @var Key[]
     */
    private $keyRules;

    /**
     * Initializes the rule.
     *
     * @param Validatable[] ...$validatables
     */
    public function __construct(Validatable ...$validatables)
    {
        $this->keyRules = array_map([$this, 'getKeyRule'], $validatables);
        $this->keys = array_map([$this, 'getKeyReference'], $this->keyRules);

        parent::__construct(new AllOf(...$this->keyRules));
    }

    /**
     * @param Validatable $validatable
     *
     * @throws ComponentException
     *
     * @return Key
     */
    private function getKeyRule(Validatable $validatable): Key
    {
        if ($validatable instanceof Key) {
            return $validatable;
        }

        if (!$validatable instanceof AllOf
            || 1 !== count($validatable->getRules())) {
            throw new ComponentException('KeySet rule accepts only Key rules');
        }

        return $this->getKeyRule(current($validatable->getRules()));
    }

    /**
     * @param Key $rule
     *
     * @return mixed
     */
    private function getKeyReference(Key $rule)
    {
        return $rule->reference;
    }

    /**
     * @param array $input
     *
     * @return bool
     */
    private function hasValidStructure($input)
    {
        if (!is_array($input)) {
            return false;
        }

        foreach ($this->keyRules as $keyRule) {
            if (!array_key_exists($keyRule->reference, $input) && $keyRule->mandatory) {
                return false;
            }

            unset($input[$keyRule->reference]);
        }

        return 0 == count($input);
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::assert($input);
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        if (!$this->hasValidStructure($input)) {
            throw $this->reportError($input);
        }

        parent::check($input);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!$this->hasValidStructure($input)) {
            return false;
        }

        return parent::validate($input);
    }
}
