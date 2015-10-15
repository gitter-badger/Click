#!/usr/bin/env bash
app/console click:set -e demo -u 00000000-0000-0000-0000-000000000000 --urn=/google --uri=https://www.google.com/ -a null
app/console click:set -e demo -u 00000000-0000-0000-0000-000000000000 --urn=/yandex --uri=http://www.yandex.ru/   -a null
app/console click:set -e demo -u 00000000-0000-0000-0000-000000000000 --urn=/click  --uri=https://github.com/octolab/Click
