FROM php:7.2-apache
RUN a2enmod cgi
RUN --mount=target=/var/lib/apt/lists,type=cache,sharing=locked \
    --mount=target=/var/cache/apt,type=cache,sharing=locked \
    rm -f /etc/apt/apt.conf.d/docker-clean \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        cpanminus
RUN cpanm install CGI
COPY cgi-bin/ /usr/lib/cgi-bin/
COPY src/ /var/www/html/
