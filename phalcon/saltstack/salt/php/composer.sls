php.composer.get:
  cmd.run:
    - name: curl -sS https://getcomposer.org/installer | php
    - unless: test -f /usr/local/bin/composer
    - cwd: /tmp
    - user: root
    - require:
      - pkg: php

php.composer.install:
  cmd.wait:
    - name: mv composer.phar /usr/local/bin/composer
    - cwd: /tmp
    - user: root
    - watch:
      - cmd: php.composer.get

php.composer.update:
  cmd.run:
    - name: composer self-update
    - onlyif: test -f /usr/local/bin/composer
    - user: root
