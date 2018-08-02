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
use function array_filter;
use function array_map;

/**
 * Abstract class for rules that are composed by other rules.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractComposite extends AbstractRule
{
    /**
     * @var Validatable[]
     */
    private $rules = [];

    /**
     * Initializes the rule adding other rules to the stack.
     *
     * @param Validatable ...$rules
     */
    public function __construct(Validatable ...$rules)
    {
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name): Validatable
    {
        $parentName = $this->getName();
        foreach ($this->rules as $rule) {
            $ruleName = $rule->getName();
            if ($ruleName && $parentName !== $ruleName) {
                continue;
            }

            $rule->setName($name);
        }

        return parent::setName($name);
    }

    /**
     * Append a rule into the stack of rules.
     *
     * @param Validatable $rule
     *
     * @return AbstractComposite
     */
    public function addRule(Validatable $rule): self
    {
        if ($this->shouldHaveNameOverwritten($rule)) {
            $rule->setName($this->getName());
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * Returns all the rules in the stack.
     *
     * @return Validatable[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * Returns all the exceptions throw when asserting all rules.
     *
     * @param mixed $input
     *
     * @return ValidationException[]
     */
    protected function getAllThrownExceptions($input): array
    {
        return array_filter(
            array_map(
                function (Validatable $rule) use ($input): ?ValidationException {
                    try {
                        $rule->assert($input);
                    } catch (ValidationException $exception) {
                        $this->updateExceptionTemplate($exception);

                        return $exception;
                    }

                    return null;
                },
                $this->getRules()
            )
        );
    }

    private function shouldHaveNameOverwritten(Validatable $rule): bool
    {
        return $this->hasName($this) && !$this->hasName($rule);
    }

    private function hasName(Validatable $rule): bool
    {
        return null !== $rule->getName();
    }

    private function updateExceptionTemplate(ValidationException $exception): void
    {
        if (null === $this->template || $exception->hasCustomTemplate()) {
            return;
        }

        $exception->updateTemplate($this->template);

        if (!$exception instanceof NestedValidationException) {
            return;
        }

        foreach ($exception->getChildren() as $childException) {
            $this->updateExceptionTemplate($childException);
        }
    }
}
