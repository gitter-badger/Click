nginx:
  pkg.installed:
    - name: nginx
    - refresh: true
    - allow_updates: true
  service.running:
    - name: nginx
    - enable: true
    - reload: true
    - require:
      - pkg: nginx
