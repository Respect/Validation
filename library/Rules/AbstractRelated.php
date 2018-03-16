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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use function is_scalar;

abstract class AbstractRelated extends AbstractRule
{
    public $mandatory = true;
    public $reference = '';
    public $validator;

    abstract public function hasReference($input): bool;

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator = null, $mandatory = true)
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

    public function setName(string $name): Validatable
    {
        parent::setName($name);

        if ($this->validator instanceof Validatable) {
            $this->validator->setName($name);
        }

        return $this;
    }

    public function assert($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        try {
            $this->decision('assert', $hasReference, $input);
        } catch (ValidationException $e) {
            throw $this
                ->reportError($this->reference, ['hasReference' => true])
                ->addRelated($e);
        }
    }

    public function check($input): void
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        $this->decision('check', $hasReference, $input);
    }

    public function validate($input): bool
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return false;
        }

        return $this->decision('validate', $hasReference, $input);
    }

    private function decision(string $type, bool $hasReference, $input)
    {
        return (!$this->mandatory && !$hasReference)
            || (is_null($this->validator)
                || $this->validator->$type($this->getReferenceValue($input)));
    }
}
