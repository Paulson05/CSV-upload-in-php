<?php
class CsvTest extends \PHPUnit\Framework\TestCase
{
     public $testFile = array(
       'name'=>'2012-04-20 21.13.42.jpg',
       'tmp_name'=>'C:\wamp\tmp\php8D20.tmp',
       'type'=>'image/jpeg',
       'size'=>1472190,
       'error'=>0
    );


public function testFileupload()
    {   

        $testUpload = new UserModel;
        $testUpload->image = new CUploadedFile($this->testFile['name'],$this->testFile['tmp_name'],$this->testFile['type'],$this->testFile['size'],$this->testFile['error']);
        $this->assertFalse($testUpload->validate());

        $errors= $testUpload->errors;
        $this->assertEmpty($errors);
    }

   
}
