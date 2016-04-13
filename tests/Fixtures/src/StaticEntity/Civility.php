<?php

namespace Byscripts\BundleTest\StaticEntityBundle\StaticEntity;

use Byscripts\StaticEntity\StaticEntity;

class Civility extends StaticEntity
{
    const MR = 'mr';
    const MRS = 'mrs';
    /**
     * @var string
     */
    private $name;

    /**
     * @return array
     */
    static public function getDataSet()
    {
        return array(
            self::MR  => array('name' => 'Mister'),
            self::MRS => array('name' => 'Misses'),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
