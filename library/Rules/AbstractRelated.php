<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
abstract class AbstractRelated implements Rule
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var Rule|null
     */
    private $rule;

    /**
     * @var bool
     */
    private $mandatory = true;

    public function __construct($reference, Rule $rule = null, bool $mandatory = true)
    {
        $this->reference = $reference;
        $this->rule = $rule;
        $this->mandatory = $mandatory;
    }

    /**
     * @param string $input
     *
     * @return bool
     */
    abstract protected function hasReference($input, $reference): bool;

    /**
     * @param string $input
     *
     * @return mixed
     */
    abstract protected function getReferenceValue($input, $reference);

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        $properties = ['reference' => $this->reference, 'mandatory' => $this->mandatory];

        if (!$this->hasReference($input, $this->reference)) {
            return new Result(!$this->mandatory, $input, $this, $properties);
        }

        if ($this->rule === null) {
            return new Result(true, $input, $this, $properties);
        }

        $referenceValue = $this->getReferenceValue($input, $this->reference);
        $referenceValueResult = $this->rule->validate($referenceValue);

        return new Result($referenceValueResult->isValid(), $input, $this, $properties, $referenceValueResult);
    }
}
