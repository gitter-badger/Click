phalcon:
  pkgrepo.managed:
    - ppa: phalcon/stable
    - enabled: true
    - refresh_db: true
    - require_in:
      - pkg: phalcon
  pkg.installed:
    - pkgs:
      - php5
      - php5-cli
      - php5-common
      - php5-dev
      - php5-fpm
      - php5-mcrypt
      - php5-pgsql
      - php5-phalcon
      - gcc
      - libpcre3-dev
    - refresh: true
    - allow_updates: true
