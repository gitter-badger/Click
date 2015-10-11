{% set db = pillar['database'] %}

postgres.user:
  postgres_user.present:
    - name: {{ db['user'] }}
    - createdb: false
    - createroles: false
    - encrypted: true
    - login: true
    - password: {{ db['pass'] }}
    - refresh_password: true
    - require:
      - service: postgres.service

postgres.db:
  postgres_database.present:
    - name: {{ db['name'] }}
    - tablespace: pg_default
    - encoding: UTF8
    - lc_collate: {{ db['collate'] }}
    - lc_ctype: {{ db['ctype'] }}
    - owner: {{ db['user'] }}
    - template: template0
    - require:
      - postgres_user: postgres.user

postgres.host:
  host.present:
    - name: dbrw
    - ip: 127.0.0.1
