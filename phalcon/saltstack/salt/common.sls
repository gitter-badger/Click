web_user:
  user.present:
    - name: web
    - groups:
      - users
    - home: /home/web
    - shell: /bin/bash
    - empty_password: true
    - fullname: "Web User"
