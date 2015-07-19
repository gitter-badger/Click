postgres:
  pkgrepo.managed:
    - humanname: PostgreSQL Apt Repository
    - name: deb http://apt.postgresql.org/pub/repos/apt/ trusty-pgdg main
    - dist: trusty-pgdg
    - file: /etc/apt/sources.list.d/pgdg.list
    - enabled: true
    - key_url: https://www.postgresql.org/media/keys/ACCC4CF8.asc
    - refresh_db: true
    - require_in:
      - pkg: postgres
  pkg.installed:
    - pkgs:
      - postgresql-9.4
      - pgbouncer
    - refresh: true
    - allow_updates: true
  service.running:
    - name: postgresql
    - enable: true
    - require:
      - pkg: postgres

postgres-config:
  file.managed:
    - name: /etc/postgresql/9.4/main/postgresql.conf
    - source: salt://postgres/config/postgresql.conf
    - user: postgres
    - group: postgres
    - mode: 644
    - require:
      - pkg: postgres
    - watch_in:
      - service: postgres

postgres-hba:
  file.managed:
    - name: /etc/postgresql/9.4/main/pg_hba.conf
    - source: salt://postgres/config/pg_hba.conf
    - user: postgres
    - group: postgres
    - mode: 640
    - require:
      - pkg: postgres
    - watch_in:
      - service: postgres
