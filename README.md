# Symfony.si

[![Build Status](https://img.shields.io/travis/symfony-si/symfony.si/master.svg?style=flat-square)](https://travis-ci.org/symfony-si/symfony.si)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/symfony-si/symfony.si.svg?style=flat-square)](https://scrutinizer-ci.com/g/symfony-si/symfony.si/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/symfony-si/symfony.si.svg?style=flat-square)](https://scrutinizer-ci.com/g/symfony-si/symfony.si)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c/big.png)](https://insight.sensiolabs.com/projects/3d099459-fdfc-475e-a8a6-a5515429161c)

Welcome to the Symfony Slovenia project. Inspired by many others Symfony and PHP
local user groups, here is Symfony Slovenia as well.

Symfony.si project aims to provide useful information for Symfony users.

## Local Installation

Application is built with Symfony PHP framework (obviously) and is using Symfony
Standard Edition. You can fork this project and send pull requests if you found
some bug or have an idea for improvement.

Fork Symfony.si project, clone it and install dependencies with
[Composer](https://getcomposer.org):

```bash
git clone git@github.com:your_username/symfony.si --recursive
cd symfony.si
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

After this you should get a working symfony.si website on your development machine.

Docker users can use provided [Docker files](.docker) to get up and running fast:

```bash
docker-compose -f .docker/docker-compose.yml up --force-recreate -d
docker exec -it <container_name> zsh
cd /var/www/symfony.si/
composer install
bin/console assetic:dump
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

Point IP od Docker container to symfony.si.dev:

```bash
docker inspect <container_name> | grep -oE "\b([0-9]{1,3}\.){3}[0-9]{1,3}\b"
echo "XXX.XX.X.X symfony.si.dev" | sudo tee -a /etc/hosts
```

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
