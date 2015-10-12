# Requirements

Vagrant plugins:

* `vagrant-vbguest` for sync VirtualBox Guest Additions

Use `vagrant plugin install <plugin>`.

# Presented environments

## Multi-machine

Run `vagrant up "/cli|phalcon/"` (or other combination with `cli`) for up application cluster.

Available environment:

* cli (primary)
* phalcon

## Command line tool

Xdebug via `ssh -R 9191:127.0.0.1:9000 vagrant@192.168.7.2`

## Phalcon application

Xdebug via `ssh -R 9191:127.0.0.1:9001 vagrant@192.168.7.3`

## Silex application

## Slim application
