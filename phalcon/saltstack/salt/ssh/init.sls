include:
  - ssh.hosts.github

ssh:
  pkg.installed:
    - refresh: true
    - allow_updates: true

ssh.service:
  cmd.wait:
    - name: service ssh restart
    - user: root
  service.running:
    - name: ssh
    - enable: true
    - reload: true
    - require:
      - pkg: ssh

ssh.config.client:
  file.managed:
    - name: /etc/ssh/ssh_config
    - source: salt://ssh/config/ssh_config.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: ssh
    - watch_in:
      - cmd: ssh.service

ssh.config.server:
  file.managed:
    - name: /etc/ssh/sshd_config
    - source: salt://ssh/config/sshd_config.tpl
    - user: root
    - mode: 0644
    - template: jinja
    - require:
      - pkg: ssh
    - watch_in:
      - cmd: ssh.service
