nginx.upstreams:
  file.managed:
    - name: /etc/nginx/conf.d/upstreams.conf
    - source: salt://app/nginx/config/conf.d/upstreams.conf.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: nginx
      - pkg: php-fpm
    - watch_in:
      - cmd: nginx.service

app.config.nginx:
  file.managed:
    - name: /etc/nginx/sites-available/application
    - source: salt://app/nginx/config/sites-available/application.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - context:
      host: {{ salt['pillar.get']('application:host') }}
      root: {{ salt['pillar.get']('application:root') }}
      app_env: {{ pillar['environment'] }}
    - require:
      - file: nginx.upstreams

app.config.nginx.publish:
  file.symlink:
    - name: /etc/nginx/sites-enabled/application
    - target: /etc/nginx/sites-available/application
    - force: true
    - user: root
    - mode: 0644
    - require:
      - file: app.config.nginx
    - watch_in:
      - cmd: nginx.service
