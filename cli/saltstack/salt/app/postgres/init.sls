{% set db = pillar['database'] %}

{% for group in db['groups'].keys() %}
postgres.group.{{ group }}:
  postgres_group.present:
    - name: {{ group }}
    - createdb: false
    - createroles: false
    - login: false
    - require:
      - service: postgres.service
{% endfor %}

{% for user, details in db['users'].items() %}
postgres.user.{{ user }}:
  postgres_user.present:
    - name: {{ user }}
    - createdb: false
    - createroles: false
    - encrypted: true
    - login: true
    - password: {{ details['password'] }}
    - refresh_password: true
    - groups: {{ ','.join(details['groups']) }}
    - require:
      - service: postgres.service
      {% for group in details['groups'] %}
      - postgres_group: {{ group }}
      {% endfor %}
{% endfor %}

postgres.db:
  postgres_database.present:
    - name: {{ db['name'] }}
    - tablespace: pg_default
    - encoding: UTF8
    - lc_collate: {{ db['collate'] }}
    - lc_ctype: {{ db['ctype'] }}
    - owner: {{ db['owner'] }}
    - template: template0
    - require:
      - postgres_user: {{ db['owner'] }}

{% for group, permissions in db['groups'].items() %}
postgres.permissions.{{ group }}:
  cmd.run:
    - name: psql -d {{ db['name'] }} -c "GRANT {{ ','.join(permissions) }} ON ALL TABLES IN SCHEMA public TO GROUP {{ group }}"
    - user: postgres
    - require:
      - postgres_database: postgres.db
      - postgres_group: postgres.group.{{ group }}
{% endfor %}

postgres.host:
  host.present:
    - name: dbrw
    - ip: 127.0.0.1
