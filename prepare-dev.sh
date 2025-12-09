#!/bin/bash

set -e

# -----------------------------------------------------
# Load environment variables from .env
# -----------------------------------------------------
if [ -f .env ]; then
    echo "Loading environment variables from .env..."
    export $(grep -v '^#' .env | xargs)
else
    echo ".env file not found!"
    exit 1
fi

# -----------------------------------------------------
# MySQL Container Name (docker-compose service name)
# -----------------------------------------------------
MYSQL_CONTAINER="mysql"

# -----------------------------------------------------
# Ensure SQL file is passed as argument
# -----------------------------------------------------
if [ -z "$1" ]; then
    echo "Usage: ./create_tables.sh path/to/schema.sql"
    exit 1
fi

SQL_FILE="$1"

if [ ! -f "$SQL_FILE" ]; then
    echo "Error: SQL file '$SQL_FILE' does not exist."
    exit 1
fi

# -----------------------------------------------------
# Execute SQL inside container
# -----------------------------------------------------
echo "Running SQL migrations on MySQL container: $MYSQL_CONTAINER"
docker compose exec -T $MYSQL_CONTAINER \
    mysql -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < "$SQL_FILE"

echo "✅ Tables created successfully!"
