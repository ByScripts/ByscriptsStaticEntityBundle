<?php

namespace Byscripts\BundleTest\StaticEntityBundle\StaticEntity;

use Byscripts\StaticEntity\StaticEntity;

class Civility extends StaticEntity
{
    private $name;

    static public function getDataSet()
    {
        return array(
            'mr'  => array('name' => 'Mister'),
            'mrs' => array('name' => 'Misses'),
        );
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
