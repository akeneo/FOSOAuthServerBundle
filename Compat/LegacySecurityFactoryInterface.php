<?php

declare(strict_types=1);

namespace FOS\OAuthServerBundle\Compat;

/**
 * Empty stub that replaces Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface
 * when it doesn't exist (Symfony 6.x+). Allows OAuthFactory to implement it on all Symfony versions.
 */
interface LegacySecurityFactoryInterface
{
}