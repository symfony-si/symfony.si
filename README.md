# Symfony.si

[![Build Status](https://secure.travis-ci.org/symfony-si/symfony.si.png?branch=master)](http://travis-ci.org/symfony-si/symfony.si)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c/big.png)](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c)

## About

Welcome to the Symfony Slovenia project. Inspired by many others similar local user groups here is Symfony Slovenia as well.

Symfony.si project aims to provide useful information to users of Symfony PHP framework and connect them with Slovenian Symfony users.
We respect that Symfony is a trademark of Fabien Potencier so this website is about community and is more of an introduction to
the official Symfony framework and [website](http://symfony.com).

Project is open source and we encourage new and existing users of Symfony to contribute and get involved in the project.

## Contributing

If you're excited about Symfony as we are and would like to contribute to this project as well please check
[contributing document](CONTRIBUTING.md).

## Installation

Application is built with Symfony PHP framework (obviously) and is using Symfony Standard Edition.
You can fork this project and send pull requests if you found some bug or have an idea for improvement.

We assume you have a [Composer](https://getcomposer.org) already installed globally on your system:

```bash
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Local installation of Symfony.si application can be than done by the following procedure:

```bash
$ git clone git@github.com:your_username/symfony.si --recursive
$ cd symfony.si
$ composer install
$ php bin/console assets:install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:fixtures:load
```

After this you should get a working symfony.si website on your local computer.

## Upgrading, updating

Updating dependencies:

```bash
$ composer update
```

When you want to update local repository

```bash
$ git pull --recurse-submodules --rebase
```

### Documentation installation (optional)

The `doc` folder in the root of application contains resources for building Slovenian translation of Symfony documentation.
Symfony documentation is generated with [Sphinx](http://sphinx-doc.org). Building documentation locally requires python
Docutils and Sphinx installed however it is not needed for running your local installation.

For building documentation locally use the following procedure:

```bash
$ php bin/console docs:generate --update-sources
```

## License

Symfony is a registered trademark of Fabien Potencier. Symfony.si website only promotes Symfony framework and community.
Source code of symfony.si application is released under [MIT License](LICENSE).
