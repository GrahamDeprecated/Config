# StyleCI Config ![Analytics](https://ga-beacon.appspot.com/UA-60053271-6/StyleCI/Config?pixel)


StyleCI Config was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a code style configuration manager. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/StyleCI/Config/releases), [license](LICENSE), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![StyleCI Config](https://cloud.githubusercontent.com/assets/2829600/6310846/0cec1374-b953-11e4-9153-aa75e1da069e.png)

<p align="center">
<a href="https://travis-ci.org/StyleCI/Config"><img src="https://img.shields.io/travis/StyleCI/Config/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Config/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/StyleCI/Config.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Config"><img src="https://img.shields.io/scrutinizer/g/StyleCI/Config.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/StyleCI/Config/releases"><img src="https://img.shields.io/github/release/StyleCI/Config.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of StyleCI Config, simply add the following line to the require block of your `composer.json` file:

```
"styleci/config": "0.1.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

If you're using Laravel 5, then you can register our service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'StyleCI\Config\ConfigServiceProvider'`


## Usage

StyleCI Config is designed to manage user provided config and protect against bad input. There is currently no real documentation for this package, but feel free to check out the [API Documentation](http://docs.grahamjcampbell.co.uk) for StyleCI Config.


## License

StyleCI Config is licensed under [The MIT License (MIT)](LICENSE).
