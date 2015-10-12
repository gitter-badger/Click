phalcon:
  pkgrepo.managed:
    - humanname: Phalcon Apt Repository
    - ppa: phalcon/stable
    - refresh_db: true
    - require_in:
      - pkg: phalcon
  pkg.installed:
    - name: php5-phalcon
    - refresh: true
    - allow_updates: true
    - require:
      - pkg: php
