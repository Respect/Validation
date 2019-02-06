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
use function get_object_vars;
use function is_object;
use function is_string;
use function mb_stripos;

/**
 * Use Zend validators inside Respect\Validation flow. Messages are preserved.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 */
final class Zend extends AbstractRule
{
    /**
     * @var mixed
     */
    private $zendValidator;

    public function __construct($validator, $params = [])
    {
        if (is_object($validator)) {
            $this->zendValidator = $validator;
            return;
        }

        if (!is_string($validator)) {
            throw new ComponentException('Invalid Validator Construct');
        }

        if (false === mb_stripos($validator, 'Zend')) {
            $validator = "Zend\\Validator\\{$validator}";
        } else {
            $validator = "\\{$validator}";
        }

        $zendMirror = new ReflectionClass($validator);

        if ($zendMirror->hasMethod('__construct')) {
            $this->zendValidator = $zendMirror->newInstanceArgs($params);
        } else {
            $this->zendValidator = $zendMirror->newInstance();
        }
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
        
        $exceptions = array_map(function ($message) {
            return $this->reportError($message, get_object_vars($this));
        }, $validator->getMessages());

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
