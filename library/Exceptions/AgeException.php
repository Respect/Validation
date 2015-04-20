<?php
namespace Respect\Validation\Exceptions;

class AgeException extends AbstractNestedException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::BOTH => '{{name}} must be between {{minAge}} and {{maxAge}} years',
            self::LOWER => '{{name}} must be greater than {{minAge}} years',
            self::GREATER => '{{name}} must be lower than {{maxAge}} years',
        ),
        self::MODE_NEGATIVE => array(
            self::BOTH => '{{name}} must not be between {{minAge}} and {{maxAge}} years',
            self::LOWER => '{{name}} must not be greater than {{minAge}} years',
            self::GREATER => '{{name}} must not be lower than {{maxAge}} years',
        ),
    );

    public function configure($name, array $params = array())
    {
        $params['minAge'] = static::stringify($params['minAge']);
        $params['maxAge'] = static::stringify($params['maxAge']);

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('minAge')) {
            return static::GREATER;
        }

        if (!$this->getParam('maxAge')) {
            return static::LOWER;
        }

        return static::BOTH;
    }
}
