#!/bin/bash

# Function to output logs to stderr
log_error() {
  echo "$1" >&2
}

# Start MySQL
/docker-entrypoint.sh mysqld --skip-networking --user=root --console &
mysql_pid=$!

# Wait for MySQL to start for up to 60 seconds
for i in {1..60}; do
  echo "Waiting for MySQL to start... Attempt $i"
  sleep 1
  if mysqladmin ping &>/dev/null; then
    break
  fi
done

# Check if MySQL started successfully
if ! mysqladmin ping &>/dev/null; then
  log_error "MySQL did not start. Check the logs for more information."
  exit 1
fi

echo "MySQL started successfully"

# Import SQL dump
if [ -f /docker-entrypoint-initdb.d/dump.sql ]; then
  echo "Importing SQL dump..."
  if ! mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE" < /docker-entrypoint-initdb.d/dump.sql; then
    log_error "Failed to import SQL dump."
    exit 1
  fi
else
  log_error "SQL dump file not found."
  exit 1
fi

# Stop MySQL
kill -s TERM "$mysql_pid"
wait

# Continue with the default entrypoint
exec "$@"
