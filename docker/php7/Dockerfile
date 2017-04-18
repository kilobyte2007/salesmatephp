FROM alpine:latest

RUN apk update --no-cache
RUN apk add php7
RUN apk add php7-ctype

ENTRYPOINT ["php7", "/var/www/salesmatephp/vendor/bin/phpunit", "/var/www/salesmatephp/tests/", "--testdox-text", "/var/testoutput/php7-test.txt"]