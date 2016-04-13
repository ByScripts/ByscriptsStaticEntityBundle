<?php
/*
 * This file is part of the ByscriptsStaticEntityBundle package.
 *
 * (c) Thierry Goettelmann <thierry@byscripts.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byscripts\BundleTest\StaticEntityBundle\Controller;

use Byscripts\Bundle\StaticEntityBundle\Form\Type\StaticEntityType;
use Byscripts\BundleTest\StaticEntityBundle\StaticEntity\Civility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestController
 *
 * @author Thierry Goettelmann <thierry@byscripts.info>
 */
class TestController extends Controller
{
    public function paramConverterAction(Civility $civility = null)
    {
        return new Response(null === $civility ? 'null' : $civility->getName());
    }

    public function formTypeAction($testSkipClass = false)
    {
        $options = array();

        if (!$testSkipClass) {
            $options['class'] = 'Byscripts\BundleTest\StaticEntityBundle\StaticEntity\Civility';
        }

        $form = $this
            ->createForm(FormType::class)
            ->add(
                'civility',
                StaticEntityType::class,
                $options
            );

        return $this->render(
            'ByscriptsStaticEntityTestBundle:Test:formType.html.php',
            array('form' => $form->createView())
        );
    }
}
