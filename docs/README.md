# Command line tool

## Available commands

`app/console | fgrep click`

```
 click
  click:add            Add link to database.
  click:get            Get links from database.
  click:remove         Remove link from database.
  click:set            Create or update link in database.
```

### Add link to database

`app/console click:add -h`

```
Usage:
  click:add [options]

Options:
  -e, --env=ENV         Environment. [default: "default"]
      --urn=URN         Uniform Resource Name of source.
      --uri=URI         Uniform Resource Identifier of target.
  -a, --alias[=ALIAS]   Link alias.
```

### Create or update link in database

`app/console click:set -h`

```
Usage:
  click:set [options]

Options:
  -e, --env=ENV         Environment. [default: "default"]
      --urn=URN         Uniform Resource Name of source.
      --uri=URI         Uniform Resource Identifier of target.
  -a, --alias[=ALIAS]   Link alias (set null if you want to unset it).
```

### Get links from database

`app/console click:get -h`

```
Usage:
  click:get [options]

Options:
  -e, --env=ENV         Environment. [default: "default"]
      --id[=ID]         Link ID.
  -a, --alias[=ALIAS]   Link alias.
      --urn[=URN]       Uniform Resource Name of source.
```

### Remove link from database

`app/console click:remove -h`

```
Usage:
  click:remove [options]

Options:
  -e, --env=ENV         Environment. [default: "default"]
      --id[=ID]         Link ID.
  -a, --alias[=ALIAS]   Link alias.
      --urn[=URN]       Uniform Resource Name of source.
  -f, --force           Force remove from database.
```

## Import demo environment

To import data run `./demo.sh`. After importing you can view available links by command `app/console click:get -e demo`:

```
+----+---------+----------------------------------+-------+---------------------+---------------------+---------------------+
| ID | URN     | URI                              | Alias | Created at          | Updated at          | Deleted at          |
+----+---------+----------------------------------+-------+---------------------+---------------------+---------------------+
| 1  | /click  | https://github.com/octolab/Click | click | xxxx-xx-xx xx:xx:xx | xxxx-xx-xx xx:xx:xx |                     |
| 2  | /google | https://www.google.com/          |       | xxxx-xx-xx xx:xx:xx | xxxx-xx-xx xx:xx:xx | xxxx-xx-xx xx:xx:xx |
| 3  | /yandex | http://www.yandex.ru/            |       | xxxx-xx-xx xx:xx:xx | xxxx-xx-xx xx:xx:xx |                     |
+----+---------+----------------------------------+-------+---------------------+---------------------+---------------------+
```
