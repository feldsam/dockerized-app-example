FROM php:7.1-fpm-alpine
LABEL maintainer "Kristian Feldsam <feldsam@gmail.com>"

ENV MEMCACHED_PECL 3.0.4
ENV APCU_PECL 5.1.9
ENV IMAGICK_PECL 3.4.3

RUN apk add -U --no-cache libxml2-dev \
	icu-dev \
	imap-dev \
	libmemcached-dev \
	cyrus-sasl-dev \
	pcre-dev \
	icu-libs \
	redis \
	mysql-client \
	bash \
	autoconf \
	g++ \
	make \
	openssl \
	openssl-dev \
	samba-client \
	libpng \
	libpng-dev \
	libjpeg-turbo-dev \
	libwebp-dev \
	zlib-dev \
	libxpm-dev \
	c-client \
  imagemagick-dev \
  imagemagick \
  libtool \
  gettext-dev \
  openldap-dev \
  librsvg \
	&& pecl install redis-${REDIS_PECL} memcached-${MEMCACHED_PECL} APCu-${APCU_PECL} imagick-${IMAGICK_PECL} \
	&& docker-php-ext-enable apcu memcached imagick \
	&& pecl clear-cache \
	&& docker-php-ext-configure intl \
  && docker-php-ext-install -j 4 intl gettext ldap sockets soap pdo pdo_mysql xmlrpc gd zip pcntl opcache \
  && docker-php-ext-configure imap --with-imap --with-imap-ssl \
	&& docker-php-ext-install -j 4 imap \
	&& apk del --purge autoconf g++ make libxml2-dev icu-dev imap-dev openssl-dev cyrus-sasl-dev pcre-dev libpng-dev libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev imagemagick-dev

COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["php-fpm"]