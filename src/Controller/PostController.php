<?php
declare(strict_types=1);


namespace App\Controller;


use App\Service\Serializer;


/**
 * @Route(route="/posts")
 */
class PostController {
    
    /** 
    * @var Serializer $serializer
    */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route(route="/")
     * @return string
     */
    public function dispatch()
    {
        return $this->serializer->serialize(
            [
                'Action' => 'Post',
                'Time' => time()
            ]
        );
    }

    /**
     * @Route(route="/one")
     * @return string
     */
    public function one()
    {
        return $this->serializer->serialize(
            [
                'Action' => 'one',
                'Time' => time()
            ]
        );
    }

}