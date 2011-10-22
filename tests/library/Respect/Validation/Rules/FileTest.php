<?php

namespace Respect\Validation\Rules;

class FileTest extends \PHPUnit_Framework_TestCase
{

    protected $fileValidator;
    
    protected function setUp()
    {
        $this->fileValidator = new File;
    }
    
    /**
     * @dataProvider providerForFile
     * @expectedException Respect\Validation\Exceptions\FileException
     */
    public function test_invalid_file($input)
    {
        $this->assertFalse($this->fileValidator->Validate($input));
    }
    
    /**
     * @expectedException Respect\Validation\Exceptions\FileException
     */
    public function test_valid_file($input)
    {
        $this->assertTrue($this->fileValidator->Validate($input));
    } 
    
    public function providerForFile()
    {
        return array(
            array(__FILE__);
        );
    }
    
}
