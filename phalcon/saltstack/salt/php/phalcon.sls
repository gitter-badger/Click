phalcon:
  pkgrepo.managed:
    - ppa: phalcon/stable
    - enabled: true
    - refresh_db: true
    - require_in:
      - pkg: phalcon
  pkg.installed:
    - pkgs:
      - php5-phalcon
    - require:
      - pkg: php
