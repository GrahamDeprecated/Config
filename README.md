# StyleCI Config ![Analytics](https://ga-beacon.appspot.com/UA-60053271-6/StyleCI/Config?pixel)


<a href="https://styleci.io/repos/31083471"><img src="https://styleci.io/repos/31083471/shield" alt="StyleCI Status"></img></a>
<a href="https://travis-ci.org/StyleCI/Config"><img src="https://img.shields.io/travis/StyleCI/Config/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Config/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/StyleCI/Config.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Config"><img src="https://img.shields.io/scrutinizer/g/StyleCI/Config.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/StyleCI/Config/releases"><img src="https://img.shields.io/github/release/StyleCI/Config.svg?style=flat-square" alt="Latest Version"></img></a>


## Installation

[PHP](https://php.net) 5.6+ is required.

To get the latest version of StyleCI Config, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require styleci/config
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "styleci/config": "^2.0"
    }
}
```

If you're using Laravel 5, then you can register our service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'StyleCI\Config\ConfigServiceProvider'`


## Documentation

StyleCI Config is a code style configuration manager.

Feel free to check out the [releases](https://github.com/StyleCI/Config/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).


## License

StyleCI Config is licensed under [The MIT License (MIT)](LICENSE).
