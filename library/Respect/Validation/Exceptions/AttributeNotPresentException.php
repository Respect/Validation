<?php

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;

class AttributeNotPresentException extends InvalidException
{
    const MSG_ATTRIBUTE_NOT_PRESENT = 'HasAttribute_1';
    protected $messageTemplates = array(
        self::MSG_ATTRIBUTE_NOT_PRESENT => 'Object %s does not have the attribute %s'
    );

    public function __construct($input, $attributeName)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_ATTRIBUTE_NOT_PRESENT),
                    $this->getStringRepresentation($input), $attributeName
                )
        );
    }

}