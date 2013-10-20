# Symfony.si

[![Build Status](https://secure.travis-ci.org/symfony-si/symfony.si.png?branch=master)](http://travis-ci.org/symfony-si/symfony.si)

## About

Welcome to the Symfony Slovenia project. You probably wonder why is this project located in a separate
repository and why a special seperate dedicated page for a PHP framework and community?
Symfony is a framework, community, a philosophy and more all working together in harmony and we believe
that it deserves special attention for that matter so we've decided to make a website specially for a
Slovenian Symfony community as well.

Inpsired by Symfony Italia, Symfony Armenia and Symfony Spain here is Symfony Slovenia as well. Project
is open sourced and contributors to the project are most welcome.


## Contributing

If you're excited about Symfony as we are and would like to contribute to this project as well please check
[contributing document](CONTRIBUTING.md).


## Installation

Application is built with Symfony PHP framework (obviously) and is using Symfony Standard Edition.
You can fork this project and send pull requests. Local installation can be done by following procedure:

```bash
git clone git@github.com:your_username/symfony.si
cd symfony.si
curl -s https://getcomposer.org/installer |php
php composer.phar install
php app/console assets:install
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load
```

Documentation is built using [Sphinx](http://sphinx-doc.org). For building documentation locally use the following procedure:

```bash
git clone git://github.com/symfony-si/symfony-docs-sl.git doc/sources
cd doc
sphinx-build -b html -c ./ sources ../web/doc/current
```

## License

Symfony is a registered trademark of Fabien Potencier. Symfony.si website only promotes Symfony framework and community
in Slovenia area. Source code of symfony.si application is released under [MIT License](LICENSE).
