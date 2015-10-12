environment: prod

application:
  root: /opt/web/click.phalcon
  repo: https://github.com/octolab/Click.git
  head: php-phalcon

database:
  name: click
  user: click_ro
  pass: click_ro_pass
  host: dbro
  ip: 127.0.0.1

php:
  timezone: UTC
