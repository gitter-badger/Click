include:
  - php.phalcon
  - php.composer

php:
  pkg.installed:
    - pkgs:
      - php5
      - php5-cli
      - php5-common
      - php5-dev
      - php5-fpm
      - php5-mcrypt
      - php5-pgsql
    - refresh: true
    - allow_updates: true
