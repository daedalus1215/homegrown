<?php
declare(strict_types=1);


namespace App\Controller;


use App\Service\Serializer;
use App\Annotations\Route;

/**
 * @Route(route="/")
 */
class IndexController {
    
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
                'Action' => 'Index',
                'Time' => time()
            ]
        );
    }

}