environment: prod

application:
  root: /opt/cli/click
  repo: https://github.com/octolab/Click.git
  head: cli

database:
  groups:
    rw:
      - SELECT
      - INSERT
      - UPDATE
      - DELETE
    ro:
      - SELECT
  users:
    click_rw:
      password: click_rw_pass
      groups:
        - rw
    click_ro:
      password: click_ro_pass
      groups:
        - ro
  name: click
  owner: click_rw
  hba: ~
  collate: C.UTF-8
  ctype: C.UTF-8

php:
  timezone: UTC
