Package Stub
============
A [Laravel][laravel] package stub.    
Useful to test if a package is loaded in [Laravel][laravel].

Installation
------------
### Using Git
`git clone https://github.com/laradev/package-stub`

### Using Composer
If there is an interest of installing this package using composer, just run: `composer require --dev laradev/package-stub`

Usage
-----
From a [Laravel][laravel] point of view check the following config keys:    
* `package-stub.register`: set to `true`, it confirms that the package register method was correctly called.
* `package-stub.boot`: set to `true`, it confirms that the package boot method was correctly called.   

License
-------
This project is licensed under the terms of the [MIT License](/LICENSE)

[laravel]: https://laravel.com