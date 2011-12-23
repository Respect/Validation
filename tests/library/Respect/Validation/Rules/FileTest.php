<?php

namespace Respect\Validation\Rules;

class FileTest extends \PHPUnit_Framework_TestCase
{

    protected $fileValidator;
    private $temp;
    /**
     * @expectedException PHPUnit_Framework_Warning
     */
    protected function setUp()
    {
        $this->fileValidator = new File;
        do
        {
            $this->temp = __DIR__.'/.tmp_filetest_'.rand(0,2048).'/';
        }
        while(is_dir($this->temp));
        if(!@mkdir($this->temp)){
            $this->markTestIncomplete('No permission to write on '.__DIR__);
        }
        else
        {
            fopen($this->temp.'foo','x');
            fopen($this->temp.'bar','x');
        }
    }
    
    
    protected function tearDown()
    {
        if(!is_null($this->temp))
        {
            unlink($this->temp.'foo');
            unlink($this->temp.'bar');
            rmdir($this->temp);
        }
    }
    /**
     * @dataProvider providerForFile
     */
    public function test_valid_file($input)
    {
        $this->assertTrue($this->fileValidator->Validate($input));
    }
    
    /**
     * @dataProvider providerForNotFile
     */
    public function test_invalid_file($input)
    {
        $this->assertFalse($this->fileValidator->Validate($input));
    }
    
    public function providerForFile()
    {
        if(is_null($this->temp)) 
            return array( array(__FILE__) );
        else{
            return array(
                array(__FILE__),
                array($this->temp.'foo'),
                array($this->temp.'bar'),
                 array(array($this->temp.'foo',$this->temp.'bar',__FILE__))
            );
        } 
    }
    
    public function providerForNotFile()
    {
        return array(
            array($this->temp.'cloud'),
            array($this->temp.'son'),
            array(array($this->temp.'cloud',$this->temp.'son'))
        );
    }
    
}
