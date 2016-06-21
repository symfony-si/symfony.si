FROM debian:jessie

MAINTAINER Peter Kokot <peterkokot@gmail.com>

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections && \
    apt-get update && apt-get upgrade -y && \
    apt-get install -y wget curl vim git build-essential net-tools supervisor && \
    echo "deb http://packages.dotdeb.org jessie all\ndeb-src http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list && \
    wget https://www.dotdeb.org/dotdeb.gpg -O /tmp/dotdeb.gpg && apt-key add /tmp/dotdeb.gpg && \
    apt-get update && apt-get install -y php7.0-cgi \
    php7.0-curl \
    php7.0-intl \
    php7.0-gd \
    php7.0-mcrypt \
    php7.0-xsl \
    nginx

# Install Node.js, npm, gulp, bower
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash - && \
    apt-get install -y nodejs && \
    npm install npm -g && \
    npm install -g gulp && \
    npm install -g bower

# Allow bower to be run as root
RUN echo '{ "allow_root": true }' > /root/.bowerrc

# Install ZSH and oh-my-zsh framework for nicer shell
RUN apt-get install -y zsh && \
    wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true &&\
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
