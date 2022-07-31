<?php
class unitTest extends \PHPUnit\Framework\TestCase
{
    private $uploadedFile = __DIR__ . '/test.png';
    private $user;

    public function setUp()
    {
        $_FILES = [
            'filename' => [
                'name' => $this->uploadedFile,
                'type' => 'image/png',
                'size' => 5093,
                'tmp_name' => $this->uploadedFile,
                'error' => 0
            ]
        ];
    
        parent::setUp();

        $this->user = new User();
        $this->user->setAttribute('name', 'Test');
            $this->user->setAttribute('password', 'dummy');
            $this->user->setAttribute('email', 'test@test.com');
            $this->user->save();
    }

    public function testPost()
    {
        $this->be($this->user);

        //Does not work
        $this->post('/upload',
             [
                'id' => 1,
                //other vars
            ]
        )->seeJson([
            'id' => 1,
            //other vars
        ]);

        //Works, but does not work with seeJson
            $this->call('POST',
                '/upload',
                [
                    'id' => 1
                ],
                [],
                $_FILES,
                []
            )->seeJson([
            'id' => 1,
            //other vars
        ]);
    }
}
