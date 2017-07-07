## Configuration
Add the following to `app/AppKernel.php`.

```php
<?php
    // app/AppKernel.php
    
    // ...
    class AppKernel extends Kernel {
        public function registerBundles() {
            // ...
            if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
                // ...
                if ($this->getEnvironment() === 'test') {
                    $bundles[] = new Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
                }
            }
    
            return $bundles;
        }
    
        // ...
    }
```

Next, enable the Liip bundle. Additionally, you should also configure Doctrine to use a temporary
SQLite database, in lieu of your normal database connection.

```yaml
liip_functional_test:
    cache_sqlite_db: true

# Optional, but recommended; tells Doctrine to use a temporary SQLite database for testing
doctrine:
    dbal:
        driver: pdo_sqlite
        path: '%kernel.cache_dir%/test.db'
```

Please read the [LiipFunctionalTestBundle](https://github.com/liip/LiipFunctionalTestBundle/blob/master/README.md)
documentation for more information on configuring the Liip bundle.

## Usage
Simply have your test cases extend from `DaybreakStudios\Utility\SymfonyPHPUnitHelpers\WebTestCase`.

```php
<?php
    use DaybreakStudios\Utility\SymfonyPHPUntHelpers\WebTestCase;

    class MyTestCase extends WebTestCase {
    	public function testItRespondsSuccessfully() {
    	    $this->client->request('GET', '/home');
    	    
    	    $response = $this->client->getResponse();
    	    
    	    $this->isSuccessful($response);
    	}
    }
```