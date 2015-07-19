{% set app = pillar['application'] %}

app:
  file.directory:
    - name: {{ app['root'] }}
    - user: web
    - group: users
    - mode: 0755
    - makedirs: true
    - require:
      - user: web
  git.latest:
    - name: {{ app['repo'] }}
    - rev: {{ app['rev'] }}
    - target: {{ app['root'] }}
    - force_checkout: true
    - force_reset: true
    - user: web
    - require:
      - file: app
      - ssh_known_hosts: github.com
