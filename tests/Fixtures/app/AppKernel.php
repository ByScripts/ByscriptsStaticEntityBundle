<?php
/*
 * This file is part of the ByscriptsStaticEntityBundle package.
 *
 * (c) Thierry Goettelmann <thierry@byscripts.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byscripts\AppTest;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

/**
 * Class AppKernel
 *
 * @author Thierry Goettelmann <thierry@byscripts.info>
 */
class AppKernel extends Kernel
{

    /**
     * Returns an array of bundles to register.
     *
     * @return BundleInterface[] An array of bundle instances.
     *
     * @api
     */
    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Byscripts\Bundle\StaticEntityBundle\ByscriptsStaticEntityBundle(),
            new \Byscripts\BundleTest\StaticEntityBundle\ByscriptsStaticEntityTestBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
        );
    }

    /**
     * Loads the container configuration.
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     *
     * @api
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config.yml');
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/ByscriptsStaticEntityBundle/cache';
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/ByscriptsStaticEntityBundle/cache';
    }


}
