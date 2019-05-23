<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Exceptions\ZendException;
use Throwable;
use Zend\Validator\ValidatorInterface;
use function array_map;
use function current;
use function is_string;
use function sprintf;
use function stripos;

/**
 * Use Zend validators inside Respect\Validation flow.
 *
 * Messages are preserved.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 */
final class Zend extends AbstractRule
{
    /**
     * @var ValidatorInterface
     */
    private $zendValidator;

    /**
     * @param string|ValidatorInterface $validator
     * @param mixed[] $params
     *
     * @throws ComponentException
     */
    public function __construct($validator, array $params = [])
    {
        $this->zendValidator = $this->zendValidator($validator, $params);
    }

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        $validator = clone $this->zendValidator;
        if ($validator->isValid($input)) {
            return;
        }

        /** @var ZendException $zendException */
        $zendException = $this->reportError($input);
        $zendException->addChildren(
            array_map(
                function (string $message) use ($input): ValidationException {
                    $exception = $this->reportError($input);
                    $exception->updateTemplate($message);

                    return $exception;
                },
                $validator->getMessages()
            )
        );

        throw $zendException;
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        $validator = clone $this->zendValidator;
        if ($validator->isValid($input)) {
            return;
        }

        /** @var ZendException $zendException */
        $zendException = $this->reportError($input);
        $zendException->updateTemplate(current($validator->getMessages()));

        throw $zendException;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return (clone $this->zendValidator)->isValid($input);
    }

    /**
     * @param mixed $validator
     * @param mixed[] $params
     *
     * @throws ComponentException
     */
    private function zendValidator($validator, array $params = []): ValidatorInterface
    {
        if ($validator instanceof ValidatorInterface) {
            return $validator;
        }

        if (!is_string($validator)) {
            throw new ComponentException('The given argument is not a valid Zend Validator');
        }

        $className = stripos($validator, 'Zend') === false ? 'Zend\\Validator\\'.$validator : '\\'.$validator;

        try {
            $reflection = new ReflectionClass($className);
            if (!$reflection->isInstantiable()) {
                throw new ComponentException(sprintf('"%s" is not instantiable', $className));
            }

            return $this->zendValidator($reflection->newInstanceArgs($params));
        } catch (Throwable $exception) {
            throw new ComponentException(sprintf('Could not create "%s"', $validator), 0, $exception);
        }
    }
}
