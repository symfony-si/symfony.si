FROM debian:jessie

MAINTAINER Peter Kokot <peterkokot@gmail.com>

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections && \
    apt-get update && apt-get upgrade -y && \
    apt-get install -y supervisor wget curl vim git zsh && \
    echo "deb http://packages.dotdeb.org jessie all\ndeb-src http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list && \
    wget https://www.dotdeb.org/dotdeb.gpg -O /tmp/dotdeb.gpg && apt-key add /tmp/dotdeb.gpg && \
    apt-get update && apt-get install -y php7.0-fpm \
    php7.0-curl \
    php7.0-intl \
    php7.0-gd \
    php7.0-mcrypt \
    php7.0-xsl \
    php7.0-mysql \
    nginx

# Install Zsh
RUN wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true &&\
    cp ~/.oh-my-zsh/templates/zshrc.zsh-template ~/.zshrc &&\
    chsh -s $(which zsh) &&\
    echo 'TERM=xterm' >> ~/.zshrc

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod a+x /usr/local/bin/composer && \
    wget https://phar.phpunit.de/phpunit.phar -O /usr/local/bin/phpunit && \
    chmod a+x /usr/local/bin/phpunit

RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.zshrc && \
    /bin/zsh -c "source ~/.zshrc"

RUN usermod -u 1000 www-data

ADD ./ /
RUN ln -s /etc/nginx/sites-available/symfony.si /etc/nginx/sites-enabled/symfony.si

EXPOSE 8080:80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
