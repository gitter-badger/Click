environment: prod

application:
  root: /opt/web/click.phalcon
  repo: https://github.com/octolab/Click.git
  head: php-phalcon
  host: phalcon.click.dev default

database:
  name: click
  user: click_ro
  pass: click_ro_pass
  host: dbro
  ip: ~

php:
  timezone: UTC
