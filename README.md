# Symfony.si

[![Build Status](https://secure.travis-ci.org/symfony-si/symfony.si.png?branch=master)](http://travis-ci.org/symfony-si/symfony.si)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c/big.png)](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c)

## About

Welcome to the Symfony Slovenia project. You probably wonder why is this project located in a separate
repository and why a special seperate dedicated page for a PHP framework and community?
Symfony is a framework, community, a philosophy and more all working together in harmony and we believe
that it deserves special attention for that matter so we've decided to make a website specially for a
Slovenian Symfony community as well.

Inspired by Symfony Italia, Symfony Armenia, Symfony Spain and many others here is Symfony Slovenia as well.

Symfony.si project aims to provide useful information to users of Symfony PHP framework and connect them with Slovenian Symfony users.
We respect that Symfony is a trademark of Fabien Potencier so this website is about community and is more of an introduction to
the official Symfony framework and [website](http://symfony.com).

Project is open source and we encourage new and existing users of Symfony to contribute and get involved in the project.

## Contributing

If you're excited about Symfony as we are and would like to contribute to this project as well please check
[contributing document](CONTRIBUTING.md).


## Installation

Application is built with Symfony PHP framework (obviously) and is using Symfony Standard Edition.
You can fork this project and send pull requests. Local installation can be done by the following procedure:

```bash
$ git clone git@github.com:your_username/symfony.si
$ cd symfony.si
$ curl -s https://getcomposer.org/installer |php
$ php composer.phar install
$ php app/console assets:install
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
```

After this you should get a working symfony.si website on your local computer. Documentation section (doc folder in the root of application)
is mainly built with [Sphinx](http://sphinx-doc.org). Building documentation requires python Docutils and Sphinx installed and is not needed
for your installation. For building documentation locally use the following procedure:

```bash
$ git clone git://github.com/symfony-si/symfony-docs-sl.git doc/sources
$ php app/console docs:generate --update-sources
```

## License

Symfony is a registered trademark of Fabien Potencier. Symfony.si website only promotes Symfony framework and community
in Slovenia area. Source code of symfony.si application is released under [MIT License](LICENSE).
