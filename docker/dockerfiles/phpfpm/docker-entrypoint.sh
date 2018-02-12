#!/bin/bash
set -e

# Wait for containers

while ! mysqladmin ping --host mysql -u${DBUSER} -p${DBPASS} --silent; do
  sleep 2
done

# Some scripts to run before app, for ex. database migration

exec "$@"