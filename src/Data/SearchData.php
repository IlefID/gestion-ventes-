<?php 

namespace App\Data;
use App\Entity\Appareil;

class SearchData
{
    /**
     * @var Appareil[]
    */
    public $types =[];

    /**
     * @var null/integer
    */
    public $max;

    /**
     * @var null/integer
    */
    public $min;
}