git:
  pkg.installed:
    - name: git
    - refresh: true
    - allow_updates: true

github.com:
  ssh_known_hosts.present:
    - name: github.com
    - user: web
    - fingerprint: 16:27:ac:a5:76:28:2d:36:63:1b:56:4d:eb:df:a6:48
    - enc: rsa
    - require:
      - user: web-user
      - pkg: git
