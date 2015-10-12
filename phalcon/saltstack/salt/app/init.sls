{% set app = pillar['application'] %}

include:
  - app.nginx
  - app.postgres

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
    - rev: {{ app['head'] }}
    - target: {{ app['root'] }}
    - user: web
    - force: true
    - force_checkout: true
    - force_clone: true
    - force_fetch: true
    - force_reset: true
    - require:
      - file: app
      - ssh_known_hosts: github.com
