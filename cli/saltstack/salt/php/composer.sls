composer-get:
  cmd.run:
    - name: 'CURL=`which curl`; $CURL -sS https://getcomposer.org/installer | php'
    - unless: test -f /usr/local/bin/composer
    - cwd: /tmp
    - require:
      - pkg: php

composer-global-install:
  cmd.wait:
    - name: mv composer.phar /usr/local/bin/composer
    - cwd: /tmp
    - watch:
      - cmd: composer-get
