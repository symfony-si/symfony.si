# Symfony.si

[![Build Status](https://img.shields.io/travis/symfony-si/symfony.si/master.svg?style=flat-square)](https://travis-ci.org/symfony-si/symfony.si)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/symfony-si/symfony.si.svg?style=flat-square)](https://scrutinizer-ci.com/g/symfony-si/symfony.si/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/symfony-si/symfony.si.svg?style=flat-square)](https://scrutinizer-ci.com/g/symfony-si/symfony.si)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c/big.png)](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c)

Welcome to the Symfony Slovenia project. Inspired by many others Symfony and PHP
local user groups, here is Symfony Slovenia as well. Project aims to provide
useful information for Symfony users.

## Local Installation

Application is built with Symfony PHP framework (obviously) and is using Symfony
Standard Edition. You can fork this project and send pull requests if you found
some bug or have an idea for improvement.

Fork Symfony.si project, clone it and install dependencies with
[Composer](https://getcomposer.org):

```bash
git clone git@github.com:your_username/symfony.si
cd symfony.si
composer install
```

Assets (CSS, JavaScript and images) are handled with [Gulp](http://gulpjs.com/):

```bash
yarn install
./node_modules/.bin/gulp build --production
```

After this you can get a symfony.si website running on your development machine:

```bash
bin/console server:run
```

### Docker Installation

Docker users can use provided [Docker files](.docker) and [Makefile](Makefile)
to get up and running fast:

```bash
git clone git://github.com/symfony-si/symfony.si
cd symfony.si
make install
make up
```

And visit `http://localhost`

## License and Contributing

If you're as excited about Symfony as we are and would like to contribute to this
project as well please check the [contributing document](CONTRIBUTING.md).

We respect that Symfony is a registered trademark of Fabien Potencier. This website
is about all about Symfony, PHP and open source. It is more of an introduction to
the official [Symfony project](http://symfony.com). Symfony.si website only promotes
Symfony and is not endorsed by Fabien Potencier. Source code of symfony.si
application is released under MIT License. Content is released Creative Commons
Attribution 4.0 International License. For more info see the [LICENSE](LICENSE)
file.
