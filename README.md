# Salesmate.io PHP Wrapper

PHP5 and PHP7 compatible Salesmate.io PHP wrapper, to sync sales leads and activities with your Salesmate.io account.

# Requirements

- Salesmate.io account with API _Private Key_, _Session Token_ and _Access Key_. These are all found in your Salesmate.io dashboard.

# Testing

## Running Unit Tests

- Run `composer install` to install Composer dependencies
- Run `php /vendor/bin/phpunit tests/` to run our set of unit tests using PHPUnit

## Automated Unit Testing Using Docker

- Run `composer install`
- Make sure you have Docker installed and running.
- Run `docker-compose up` to build and execute Dockerized environments and test our API wrapper on
    - PHP5
    - PHP7