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

use Respect\Validation\Exceptions\SfException;
use Respect\Validation\Exceptions\ValidationException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Validate the input with a Symfony Validator (>=4.0 or >=3.0) Constraint.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Sf extends AbstractRule
{
    /**
     * @var Constraint
     */
    private $constraint;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Initializes the rule with the Constraint and the Validator.
     *
     * In the the Validator is not defined, tries to create one.
     *
     * @param Constraint $constraint
     * @param ValidatorInterface|null $validator
     */
    public function __construct(Constraint $constraint, ValidatorInterface $validator = null)
    {
        $this->constraint = $constraint;
        $this->validator = $validator ?: Validation::createValidator();
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $violations = $this->validator->validate($input, $this->constraint);
        if (0 === $violations->count()) {
            return;
        }

        if (1 === $violations->count()) {
            throw $this->reportError($input, ['violations' => $violations[0]->getMessage()]);
        }

        throw $this->reportError($input, ['violations' => trim((string) $violations)]);
    }

    /**
     * {@inheritdoc}
     */
    public function reportError($input, array $extraParams = []): ValidationException
    {
        $exception = parent::reportError($input, $extraParams);
        if (isset($extraParams['violations'])) {
            $exception->updateTemplate($extraParams['violations']);
        }

        return $exception;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        try {
            $this->assert($input);
        } catch (SfException $exception) {
            return false;
        }

        return true;
    }
}
