postgres:
  pkgrepo.managed:
    - name: deb http://apt.postgresql.org/pub/repos/apt/ trusty-pgdg main
    - humanname: PostgreSQL Apt Repository
    - file: /etc/apt/sources.list.d/pgdg.list
    - dist: trusty-pgdg
    - key_url: https://www.postgresql.org/media/keys/ACCC4CF8.asc
    - refresh_db: true
    - require_in:
      - pkg: postgres
  pkg.installed:
    - refresh: true
    - pkgs:
      - postgresql-9.4
      - postgresql-contrib-9.4
    - allow_updates: true

postgres.service:
  cmd.wait:
    - name: service postgresql restart
    - user: root
  service.running:
    - name: postgresql
    - enable: true
    - reload: true
    - require:
      - pkg: postgres

postgres.config.main:
  file.managed:
    - name: /etc/postgresql/9.4/main/postgresql.conf
    - source: salt://postgres/config/postgresql.conf.tpl
    - user: postgres
    - mode: 0644
    - template: jinja
    - require:
      - pkg: postgres
    - watch_in:
      - cmd: postgres.service

postgres.config.hba:
  file.managed:
    - name: /etc/postgresql/9.4/main/pg_hba.conf
    - source: salt://postgres/config/pg_hba.conf.tpl
    - user: postgres
    - mode: 0640
    - template: jinja
    - require:
      - pkg: postgres
    - watch_in:
      - cmd: postgres.service
