<?php


namespace Byscripts\Bundle\StaticEntityBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class StaticEntityParamConverter implements ParamConverterInterface
{
    /**
     * Stores the object in the request.
     *
     * @param Request                                                                                                                                   $request       The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool|void
     * @throws \Exception
     */
    function apply(Request $request, ParamConverter $configuration)
    {
        $paramName = $configuration->getName();

        if (!$request->attributes->has($paramName)) {
            return false;
        }

        $value = $request->attributes->get($paramName);

        if(null === $value) {
            return true;
        }

        $staticEntity = call_user_func(
            array($configuration->getClass(), 'get'),
            $value
        );

        if (null === $staticEntity) {
            throw new \Exception(
                sprintf(
                    'Static entity not found "%s" with id "%s"',
                    $configuration->getClass(),
                    $value
                )
            );
        }

        $request->attributes->set(
            $paramName,
            $staticEntity
        );

        return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return boolean True if the object is supported, else false
     */
    function supports(ParamConverter $configuration)
    {
        return is_subclass_of($configuration->getClass(), 'Byscripts\StaticEntity\StaticEntity');
    }
}
