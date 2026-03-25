<?php

declare(strict_types=1);

namespace FOS\OAuthServerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * On Symfony 6.x, security.encoder_factory no longer exists.
 * This compiler pass rewires the OAuthStorage to use security.user_password_hasher instead.
 */
class PasswordHasherCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('fos_oauth_server.storage.default')) {
            return;
        }

        $storage = $container->getDefinition('fos_oauth_server.storage.default');

        if ($container->has('security.user_password_hasher')) {
            $storage->replaceArgument(5, new Reference('security.user_password_hasher'));
        }
    }
}