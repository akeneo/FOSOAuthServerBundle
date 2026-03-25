<?php

declare(strict_types=1);

/*
 * Polyfill for PassportInterface, which was removed in Symfony 6.0.
 * On Symfony 6.x, it is aliased to Passport so that type hints using
 * PassportInterface remain valid on both Symfony versions.
 */
if (!interface_exists(\Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface::class)) {
    class_alias(
        \Symfony\Component\Security\Http\Authenticator\Passport\Passport::class,
        \Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface::class
    );
}