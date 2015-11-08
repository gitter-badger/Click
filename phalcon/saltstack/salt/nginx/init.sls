nginx:
  pkg.installed:
    - refresh: true
    - allow_updates: true

apache:
  pkg.purged:
    - name: apache2

nginx.service:
  cmd.wait:
    - name: service nginx restart
    - user: root
  service.running:
    - name: nginx
    - enable: true
    - reload: true
    - require:
      - pkg: nginx
