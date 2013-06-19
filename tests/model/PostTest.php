<?php

class PostTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var LogininTracker
     */
    protected $post;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $host = "localhost";
        $db = "tow";
        $user = "towuser";
        $pass = "towpassword";
        $this->database = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        
        $this->titleDummy = array('Flexitarian', 'Tonx', 'non accusamus', 'fashion', 'axe kale', 'chips squid',                                                                                             'ethnic', 'tempor',  'asymmetrical', 'irure', 'meggings', 'Cosby', 'sweater',
                                  'YOLO', 'Retro', 'skateboard', '8-bit', 'plaid', 'literally');
              
        $this->postContent = $this->titleDummy[rand(0,18)]." ".$this->titleDummy[rand(0,18)]." "
                            .$this->titleDummy[rand(0,18)]." ".$this->titleDummy[rand(0,18)] 
                            ." Lebowski ipsum look, I've got certain information, certain things have come to light, and
                               uh, has it ever occurred to you, man, that given the nature of all this new shit, that,"
                            .$this->titleDummy[rand(0,18)]." ".$this->titleDummy[rand(0,18)]." "
                            .$this->titleDummy[rand(0,18)]." ".$this->titleDummy[rand(0,18)]
                            ."uh, instead of running around blaming me, that this whole thing might just be, not, you
                              know, not just such a simple, but uh—you know? Okay. Vee take ze money you haf on you und
                              vee call it eefen. Updated:".date("Y-m-d H:i:s");
    }
    
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {      
    }
    
    public function testConstruct()
    {
        
        $this->post = new Post($this->database);
        
        $this->assertNotNull($this->post);
        
        $post = $this->post;
        
        return($post);
    }
    
    /**
     * @depends testConstruct
     */    
    public function testCreatePost(Post $post) {
        
        //`postid`, `title`, `displayStatus`, `ACL`, `content`, `username`
        $post->setTitle($this->titleDummy[rand(0,18)].' '.$this->titleDummy[rand(0,18)].' '.$this->titleDummy[rand(0,18)].' '.$this->titleDummy[rand(0,18)]);
        $post->setStatus("published");
        $post->setACL(1);
        $post->setContent($this->postContent);
        $post->setUsername("stephen");
        
        $post->create($post->getPost());
        
        $post->load($post->getPostid());
        
        $this->assertEquals( $this->postContent , $post->getContent());
        
        return($post);
    }
    
    /**
     * @depends testConstruct
     */    
    public function testLoadPost(Post $post) {
        
        $postId = 1;
        
        $post->load($postId);
        
        $postArray = $post->getPost();
        
        $this->assertArrayHasKey( 'postid' , $postArray);
        
        return($post);
    }
    
    /**
     * @depends testLoadPost
     */    
    public function testSetContent(Post $post) {
        
        $postArray = $post->getPost();
        
        $this->assertArrayHasKey( 'postid' , $postArray);        
        
        $post->setContent($this->postContent);
        
        $this->assertEquals( $this->postContent , $post->getContent());
        
        $this->assertEquals( 1 , $post->getPostid());
        
        return($post);
        
    }
    
    /**
     * @depends testCreatePost
     */    
    public function testSavePost(Post $post) {
        
        $post->save();
        
        //reload the post from the database to check it saved
        $post->load($post->getPostid());

        $this->assertEquals( 1 , $post->getPostid());
        
        $this->assertEquals( 'First Post' , $post->getTitle());
        
    }
    
}
?>
