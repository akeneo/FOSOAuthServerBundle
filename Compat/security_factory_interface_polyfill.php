<?php

declare(strict_types=1);

/*
 * Polyfill for SecurityFactoryInterface, which was removed in Symfony 6.0.
 * Defining it as an empty interface allows OAuthFactory to safely implement it
 * on both Symfony 5.4 and 6.x without a fatal error.
 */
if (!interface_exists(\Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface::class)) {
    class_alias(
        \FOS\OAuthServerBundle\Compat\LegacySecurityFactoryInterface::class,
        \Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface::class
    );
}