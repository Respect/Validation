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

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use function is_null;
use function is_scalar;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
abstract class AbstractRelated extends AbstractRule
{
    /**
     * @var bool
     */
    public $mandatory = true;

    /**
     * @var mixed
     */
    public $reference = '';

    /**
     * @var Validatable|null
     */
    public $validator;

    /**
     * @param mixed $input
     */
    abstract public function hasReference($input): bool;

    /**
     * @param mixed $input
     *
     * @return mixed
     */
    abstract public function getReferenceValue($input);

    /**
     * @param mixed $reference
     */
    public function __construct($reference, ?Validatable $validator = null, bool $mandatory = true)
    {
        if (is_scalar($reference)) {
            $this->setName((string) $reference);
            if ($validator && !$validator->getName()) {
                $validator->setName((string) $reference);
            }
        }

        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name): Validatable
    {
        parent::setName($name);

        if ($this->validator instanceof Validatable) {
            $this->validator->setName($name);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        try {
            $this->decision('assert', $hasReference, $input);
        } catch (ValidationException $validationException) {
            /** @var NestedValidationException $nestedValidationException */
            $nestedValidationException = $this->reportError($this->reference, ['hasReference' => true]);
            $nestedValidationException->addChild($validationException);

            throw $nestedValidationException;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        $this->decision('check', $hasReference, $input);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return false;
        }

        return $this->decision('validate', $hasReference, $input);
    }

    /**
     * @param mixed $input
     */
    private function decision(string $type, bool $hasReference, $input): bool
    {
        return (!$this->mandatory && !$hasReference)
            || (is_null($this->validator)
                || $this->validator->$type($this->getReferenceValue($input)));
    }
}
