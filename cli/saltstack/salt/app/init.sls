{% set app = pillar['application'] %}

include:
  - app.postgres

app:
  file.directory:
    - name: {{ app['root'] }}
    - user: web
    - group: users
    - mode: 0755
    - makedirs: true
    - require:
      - user: user.web
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
  composer.installed:
    - name: {{ app['root'] }}
    - user: web
    - prefer_dist: true
    - optimize: {{ pillar['environment'] != 'dev' }}
    - no_dev: {{ pillar['environment'] != 'dev' }}
    - quiet: true
    - require:
      - git: app
  cmd.run:
    - name: app/console migrations:migrate --no-interaction
    - cwd: {{ app['root'] }}
    - user: web
    - require:
      - composer: app
      - service: postgres.service

{% if pillar['install_demo'] %}
app.demo:
  cmd.run:
    - name: ./demo.sh
    - cwd: {{ app['root'] }}
    - user: web
    - require:
      - cmd: app
{% endif %}