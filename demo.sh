#!/usr/bin/env bash
app/console click:set -e demo --urn=/click  --uri=https://github.com/octolab/Click -a click
app/console click:set -e demo --urn=/google --uri=https://www.google.com/          -a null
app/console click:set -e demo --urn=/yandex --uri=http://www.yandex.ru/
app/console click:remove -e demo --urn=/google
