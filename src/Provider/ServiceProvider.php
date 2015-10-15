<?php

namespace OctoLab\Click\Service;

use Cilex\Application;
use Cilex\ServiceProviderInterface;
use OctoLab\Click\Repository\LinkRepository;
use Symfony\Component\Validator\Validation;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function register(Application $app)
    {
        $app->offsetSet('validator', $app->share(function () {
            return Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator()
            ;
        }));
        $app->offsetSet('repository', $app->share(function () use ($app) {
            return new LinkRepository(
                $app->offsetGet('db'),
                $app->offsetGet('validator'),
                $app->offsetGet('logger')
            );
        }));
    }
}
