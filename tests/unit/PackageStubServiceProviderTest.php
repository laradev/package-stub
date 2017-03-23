<?php

namespace Laradev;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Mockery as m;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;

final class PackageStubServiceProviderTest extends PHPUnit_Framework_TestCase {
    
    public function tearDown() {
        m::close();
        parent::tearDown();
    }

    public function testRegister()
    {
        $app = $this->newAppMock('register');
        
        $serviceProvider = new PackageStubServiceProvider($app);
        
        $serviceProvider->register();
        
        $this->assertTrue($app->config->register);
    }
    
    public function testBoot()
    {
        $app = $this->newAppMock('boot');
        
        $serviceProvider = new PackageStubServiceProvider($app);
        
        $serviceProvider->boot();
        
        $this->assertTrue($app->config->boot);
    }
    
    /**
     * Create a new mock instance of Laravel Application.
     * 
     * This mock expects its method 'make' to be called with the argument: 'config'.
     * 
     * It then returns another mock of Laravel Repository, which expects its method
     * 'set' to be called with the method under test prefixed with
     * PackageStubServiceProvider::CONFIG_KEY as the config key, and the value: true.
     * 
     * If all these expectations are met then the config mock will provide a public
     * property named as the method under test and set with the value: true.
     * 
     * @param string $method
     * @return MockInterface
     */
    private function newAppMock(string $method):MockInterface
    {
        $config = m::mock(Repository::class)
            ->shouldReceive('set')
            ->with(PackageStubServiceProvider::CONFIG_KEY.'.'.$method, true)
            ->andSet($method, true)
        ->getMock();
        
        return m::mock(Application::class)
            ->shouldReceive('make')
            ->with('config')
            ->andReturn($config)
            ->andSet('config', $config)
        ->getMock();
    }
}
