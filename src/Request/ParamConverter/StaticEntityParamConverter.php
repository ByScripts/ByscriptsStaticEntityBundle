<?php


namespace Byscripts\Bundle\StaticEntityBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class StaticEntityParamConverter implements ParamConverterInterface
{
    /**
     * Stores the object in the request.
     *
     * @param Request                                                                                                                                   $request       The request
     * @param ConfigurationInterface $configuration Contains the name, class and options of the object
     *
     * @return boolean True if the object has been successfully set, else false
     */
    function apply(Request $request, ConfigurationInterface $configuration)
    {
        $paramName = $configuration->getName();

        if(!$request->attributes->has($paramName)) {
            return;
        }

        $request->attributes->set(
            $paramName,
            call_user_func(
                array($configuration->getClass(), 'get'),
                $request->attributes->get($paramName)
            )
        );
    }

    /**
     * Checks if the object is supported.
     *
     * @param ConfigurationInterface $configuration Should be an instance of ParamConverter
     *
     * @return boolean True if the object is supported, else false
     */
    function supports(ConfigurationInterface $configuration)
    {
        return is_subclass_of($configuration->getClass(), 'Byscripts\StaticEntity\StaticEntity');
    }
}
