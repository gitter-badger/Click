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
