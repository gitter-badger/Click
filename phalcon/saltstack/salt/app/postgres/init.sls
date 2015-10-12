{% set db = pillar['database'] %}

postgres.host:
  host.present:
    - name: {{ db['host'] }}
    - ip: {{ db['ip'] }}
