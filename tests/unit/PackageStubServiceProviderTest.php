<?php

namespace Laradev;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Laradev\Test\Support\TestCase;
use Mockery as m;
use Mockery\MockInterface;

final class PackageStubServiceProviderTest extends TestCase
{
    public function testRegister()
    {
        $app = $this->newAppMockWithConfig('register');
        
        $serviceProvider = new PackageStubServiceProvider($app);
        
        $serviceProvider->register();
        
        $this->assertTrue($app->config->register);
    }
    
    public function testBoot()
    {
        $app = $this->newAppMockWithConfig('boot');
        
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
    private function newAppMockWithConfig(string $method):MockInterface
    {
        $config = $this->newConfigMock()
            ->shouldReceive('set')
            ->with(PackageStubServiceProvider::CONFIG_KEY.'.'.$method, true)
            ->andSet($method, true)
        ->getMock();
        
        return $this->newAppMock()
            ->shouldReceive('make')
            ->with('config')
            ->andReturn($config)
            ->andSet('config', $config)
        ->getMock();
    }

    protected function doSetUp()
    {
        
    }

    protected function doTearDown()
    {
        
    }

}
