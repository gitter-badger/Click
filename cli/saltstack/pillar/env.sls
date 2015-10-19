environment: prod
install_demo: false

application:
  root: /opt/cli/click
  repo: https://github.com/octolab/Click.git
  head: cli

database:
  name: click
  user: click_rw
  pass: click_rw_pass
  hba: ~
  collate: C.UTF-8
  ctype: C.UTF-8

php:
  timezone: UTC
