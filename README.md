## Turso HTTP SDK for PHP

## Connect to db shell without auth

```shell
turso db shell http://127.0.0.1:8080
```

## Connect to db shell with auth

```shell
turso db shell $(echo "http://127.0.0.1:8080?auth_token=$DB_TOKEN")
```
