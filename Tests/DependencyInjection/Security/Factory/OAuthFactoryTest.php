<?php

declare(strict_types=1);

/*
 * This file is part of the FOSOAuthServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\OAuthServerBundle\Tests\DependencyInjection\Security\Factory;

use FOS\OAuthServerBundle\DependencyInjection\Security\Factory\OAuthFactory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class OAuthFactoryTest.
 *
 * @author Nikola Petkanski <nikola@petkanski.com>
 */
class OAuthFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var OAuthFactory
     */
    protected $instance;

    public function setUp(): void
    {
        $this->instance = new OAuthFactory();

        parent::setUp();
    }

    public function testGetPriority(): void
    {
        $this->assertSame(-10, $this->instance->getPriority());
    }

    public function testGetKey(): void
    {
        $this->assertSame('fos_oauth', $this->instance->getKey());
    }

    public function testCreateAuthenticator(): void
    {
        $container = new ContainerBuilder();
        $id = 'api';
        $userProvider = 'mock.user.provider.service';

        $authenticatorId = $this->instance->createAuthenticator($container, $id, [], $userProvider);

        $this->assertSame('fos_oauth_server.security.authentication.authenticator.'.$id, $authenticatorId);
        $definition = $container->getDefinition($authenticatorId);
        $this->assertInstanceOf(ChildDefinition::class, $definition);
        $this->assertSame('fos_oauth_server.security.authentication.authenticator', $definition->getParent());
        $this->assertEquals(new Reference('fos_oauth_server.server'), $definition->getArgument(0));
        $this->assertEquals(new Reference('security.user_checker.'.$id), $definition->getArgument(1));
        $this->assertEquals(new Reference($userProvider), $definition->getArgument(2));
    }

    public function testAddConfigurationDoesNothing(): void
    {
        $nodeDefinition = $this->getMockBuilder(NodeDefinition::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->instance->addConfiguration($nodeDefinition);
        $this->addToAssertionCount(1);
    }
}
