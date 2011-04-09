<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must have a length lower than {{maxValue}}',
        ),
        self::MODE_NEGATIVE => array(
            self::BOTH => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must not have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must not have a length lower than {{maxValue}}',
        )
    );

    public function configure($name, array $params=array())
    {
        $params['minValue'] = static::stringify($params['minValue']);
        $params['maxValue'] = static::stringify($params['maxValue']);
        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('minValue'))
            return static::GREATER;
        elseif (!$this->getParam('maxValue'))
            return static::LOWER;
        else
            return static::BOTH;
    }

}

/**
 * LICENSE
 *
 * Copyright (c) 2009-2011, Alexandre Gomes Gaigalas.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 *     * Neither the name of Alexandre Gomes Gaigalas nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */