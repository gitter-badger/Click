include:
  - php.composer
  - php.fpm
  - php.phalcon

php:
  pkg.installed:
    - refresh: true
    - pkgs:
      - php5
      - php5-cli
      - php5-common
      - php5-pgsql
      {% if pillar['environment'] == 'dev' %}
      - php5-xdebug
      {% endif %}
    - allow_updates: true

php.config.cli:
  file.managed:
    - name: /etc/php5/cli/php.ini
    - source: salt://php/config/cli/php.ini.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: php

{% for mod in salt['cp.list_master'](prefix='php/config/mods/') %}
{% set item = mod.split('/').pop().replace('.tpl', '') %}
{% if pillar['environment'] != 'dev' and item == 'xdebug.ini' %}
# skip
{% else %}
php.config.mods.{{ item }}:
  file.managed:
    - name: /etc/php5/mods-available/{{ item }}
    - source: salt://{{ mod }}
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: php
{% endif %}
{% endfor %}
