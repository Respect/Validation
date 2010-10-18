<?php

namespace Respect\Validation\Exceptions;

use Exception;

class CallbackException extends InvalidException
{
    const MSG_CALLBACK = 'Callback_1';
    protected $messageTemplates = array(
        self::MSG_CALLBACK => '%s does not validate against the provided callback %s.'
    );

    public function __construct($input, $callback)
    {
        parent::__construct(
                $this->getMessageTemplate(
                    sprintf(
                        self::MSG_CALLBACK,
                        $this->getStringRepresentation($input),
                        $this->getStringRepresentation($callback)
                    )
                )
        );
    }

}