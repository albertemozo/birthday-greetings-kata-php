FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git

WORKDIR /srv/app