<?php

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;

class HasAttributeException extends InvalidException
{
    const MSG_HAS_ATTRIBUTE = 'HasAttribute_1';
    protected $messageTemplates = array(
        self::MSG_HAS_ATTRIBUTE => 'Object %s does not have the attribute %s'
    );

    public function __construct($input, $attributeName)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_HAS_ATTRIBUTE),
                    $this->getStringRepresentation($input), $attributeName
                )
        );
    }

}