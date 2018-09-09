<?php

namespace AppBundle\Entity;


class Company implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;



    function jsonSerialize()
    {
        return [
            'name' => $this-> name,
        ];
    }

}