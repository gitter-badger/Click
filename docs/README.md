# Environment

## Requirements

* [VirtualBox](https://www.virtualbox.org)
* [Vagrant](https://www.vagrantup.com)

Vagrant plugins:

* `vagrant-vbguest` for sync VirtualBox Guest Additions

Installation instruction available [here](https://docs.vagrantup.com/v2/plugins/usage.html).

## Multi-machine

Run `vagrant up cli <environment>` for up application cluster.

| Environment   | Status    | Description         |
| ------------- | --------- | ------------------- |
| cli (primary) | available | Command line tool   |
| phalcon       | available | Phalcon application |
| silex         | not ready | Silex application   |
| slim          | not ready | Slim application    |

Documentation about Vagrant command-line interface available [here](https://docs.vagrantup.com/v2/cli/index.html).

## Command line tool

### What's inside

* Ubuntu 14.04 x64 Trusty
* Git 1.9+
* PHP 5.5+ with Composer and Xdebug (on dev mode)
* PostgreSQL 9.4+
* [Application](../../../tree/cli/docs), default located in `/opt/cli/click`
(see [pillar](/cli/saltstack/pillar/env.sls)).

All Salt Formulas are located [here](/cli/saltstack/salt).

### Debugging

Default configuration:

```
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
xdebug.remote_host = 127.0.0.1
xdebug.remote_port = 9191
xdebug.profiler_enable = 0
xdebug.idekey = CLICK
xdebug.max_nesting_level = 100
```

Use `ssh -R 9191:127.0.0.1:9000 vagrant@192.168.7.2` to forward :9191 of guest machine to 127.0.0.1:9000 of your host.

### Database

PhpStorm configuration: `jdbc:postgresql://192.168.7.2:5432/click`, user: click_rw, password: click_rw_pass
