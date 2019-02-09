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

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ZendException;
use Zend\Validator\ValidatorInterface as ZendValidator;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 */
class Zend extends AbstractRule
{
    /**
     * @var string[]
     */
    protected $messages = [];

    /**
     * @var ZendValidator
     */
    protected $zendValidator;

    /**
     * @param string|ZendValidator $validator
     * @param mixed[] $params
     */
    public function __construct($validator, array $params = [])
    {
        if ($validator instanceof ZendValidator) {
            $this->zendValidator = $validator;

            return;
        }

        if (!is_string($validator)) {
            throw new ComponentException('Invalid Validator Construct');
        }

        $this->zendValidator = $this->createZendValidator($validator, $params);
    }

    /**
     * @param mixed[] $params
     */
    private function createZendValidator(string $name, array $params): ZendValidator
    {
        if (false === mb_stripos($name, 'Zend')) {
            $name = "Zend\\Validator\\{$name}";
        } else {
            $name = "\\{$name}";
        }

        $reflection = new ReflectionClass($name);

        /** @var ZendValidator $validator */
        $validator = $reflection->newInstanceArgs($params);

        return $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $validator = clone $this->zendValidator;

        if ($validator->isValid($input)) {
            return;
        }

        $exceptions = [];
        foreach ($validator->getMessages() as $m) {
            $exceptions[] = $this->reportError($m, get_object_vars($this));
        }

        /** @var ZendException $zendException */
        $zendException = $this->reportError($input);
        $zendException->addChildren($exceptions);

        throw $zendException;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $validator = clone $this->zendValidator;

        return $validator->isValid($input);
    }
}
