# Dockerfile - Ubuntu Trusty
# https://github.com/openresty/docker-openresty

FROM ubuntu:trusty

# Docker Build Arguments
ARG RESTY_VERSION="1.13.6.1"
ARG RESTY_LUAROCKS_VERSION="2.0.13"
ARG RESTY_OPENSSL_VERSION="1.0.2k"
ARG RESTY_PCRE_VERSION="8.41"
ARG RESTY_J="2"

# 1) Install apt dependencies
# 2) Download and untar OpenSSL, PCRE, and OpenResty
# 3) Build OpenResty
# 4) Cleanup

RUN DEBIAN_FRONTEND=noninteractive apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
        build-essential \
        ca-certificates \            
        curl \
        wget \
        gettext-base \
        libgd-dev \
        libgeoip-dev \
        libncurses5-dev \
        libperl-dev \
        libreadline-dev \
        libxslt1-dev \
        make \
        perl \
        unzip \
        zlib1g-dev \
        gnupg \
        gcc \
        nano \
        iputils-ping \
        libfcgi0ldbl \
        mysql-client

    RUN DEBIAN_FRONTEND=noninteractive wget -qO - https://openresty.org/package/pubkey.gpg | apt-key add - \
    && apt-get install -y software-properties-common \
    && add-apt-repository -y "deb http://openresty.org/package/ubuntu $(lsb_release -sc) main" \
    && apt-get update \
    && apt-get install -y openresty \
    && cd /tmp \
    && wget http://luarocks.org/releases/luarocks-${RESTY_LUAROCKS_VERSION}.tar.gz \
    && tar -xzvf luarocks-${RESTY_LUAROCKS_VERSION}.tar.gz \
    && cd luarocks-${RESTY_LUAROCKS_VERSION}/ \
    && ./configure --prefix=/usr/local/openresty/luajit \ 
         --with-lua=/usr/local/openresty/luajit/ \
         --lua-suffix=jit \
         --with-lua-include=/usr/local/openresty/luajit/include/luajit-2.1 \
    && make \
    && make install \
    && cd /tmp 

    RUN DEBIAN_FRONTEND=noninteractive groupadd www \
    && usermod -a -G www root

    RUN DEBIAN_FRONTEND=noninteractive /usr/local/openresty/luajit/bin/luarocks install lua-resty-auto-ssl \
    && DEBIAN_FRONTEND=noninteractive apt-get autoremove -y \
    && mkdir /etc/resty-auto-ssl \
    && mkdir /var/log/openresty\
    && chown -R root:www /etc/resty-auto-ssl/ \
    && chmod -R 775 /etc/resty-auto-ssl/ \
    && DEBIAN_FRONTEND=noninteractive openssl req -new -newkey rsa:2048 -days 3650 -nodes -x509 \
        -subj '/CN=sni-support-required-for-valid-ssl' \
        -keyout /etc/ssl/resty-auto-ssl-fallback.key \
        -out /etc/ssl/resty-auto-ssl-fallback.crt \
    && ln -sf /dev/stdout /var/log/openresty/access.log \
    && ln -sf /dev/stderr /var/log/openresty/error.log     

COPY ./.docker/openresty/nginx.conf /usr/local/openresty/nginx/conf/nginx.conf
COPY ./.docker/openresty/sites/default.conf /usr/local/openresty/nginx/sites/default.conf
COPY ./.docker/openresty/sites/index.html /usr/local/openresty/nginx/html/index.html

COPY ./app/ /app
RUN chown -R www-data:www-data /app/

# TODO: remove any other apt packages?
CMD ["/usr/local/openresty/bin/openresty", "-g", "daemon off;"]