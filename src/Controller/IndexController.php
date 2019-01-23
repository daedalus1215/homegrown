<?php
declare(strict_types=1);


namespace App\Controller;


use App\Service\Serializer;
 

class IndexController {
    
    /** 
    * @var Serializer $serializer
    */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

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