php-fpm:
  pkg.installed:
    - name: php5-fpm
    - refresh: true
    - allow_updates: true
    - require:
      - pkg: php

php-fpm.config:
  file.managed:
    - name: /etc/php5/fpm/php-fpm.conf
    - source: salt://php/config/fpm/php-fpm.conf.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: php-fpm

php-fpm.config.php:
  file.managed:
    - name: /etc/php5/fpm/php.ini
    - source: salt://php/config/fpm/php.ini.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: php-fpm

{% for pool in salt['cp.list_master'](prefix='php/config/fpm/pool') %}
{% set item = pool.split('/').pop().replace('.tpl', '') %}
fpm.config.pool.{{ item }}:
  file.managed:
    - name: /etc/php5/fpm/pool.d/{{ item }}
    - source: salt://{{ pool }}
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: php-fpm
{% endfor %}
