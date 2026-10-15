#!/usr/bin/env bash
# Recreates the local environment around this repo:
# WordPress core, Frost parent theme, SQLite database drop-in, WP-CLI, npm deps,
# then installs the site and activates the nsf theme and plugin.
# Sources come from GitHub because wordpress.org downloads may be blocked.
set -euo pipefail

WP_VERSION=7.1.3
FROST_VERSION=v1.0.10
SQLITE_VERSION=v3.1.0
WPCLI_VERSION=2.11.0
URL=${URL:-http://localhost:8080}

ROOT=$(cd "$(dirname "$0")/.." && pwd)
cd "$ROOT"
TMP=$(mktemp -d)
trap 'rm -rf "$TMP"' EXIT

if [ ! -f wp-settings.php ]; then
	echo "Installing WordPress $WP_VERSION"
	git -c advice.detachedHead=false clone -q --depth 1 --branch "$WP_VERSION" https://github.com/WordPress/WordPress.git "$TMP/wp"
	rm -rf "$TMP/wp/.git" "$TMP/wp/wp-content/themes/"twenty* "$TMP/wp/wp-content/plugins/akismet" "$TMP/wp/wp-content/plugins/hello.php"
	cp -rn "$TMP/wp/." .
fi

if [ ! -d wp-content/themes/frost ]; then
	echo "Installing Frost $FROST_VERSION"
	git -c advice.detachedHead=false clone -q --depth 1 --branch "$FROST_VERSION" https://github.com/wpengine/frost.git wp-content/themes/frost
	rm -rf wp-content/themes/frost/.git
fi

SQLITE=wp-content/plugins/sqlite-database-integration
if [ ! -d "$SQLITE" ]; then
	echo "Installing SQLite Database Integration $SQLITE_VERSION"
	git -c advice.detachedHead=false clone -q --depth 1 --branch "$SQLITE_VERSION" https://github.com/WordPress/sqlite-database-integration.git "$TMP/sqlite"
	cp -r "$TMP/sqlite/packages/plugin-sqlite-database-integration" "$SQLITE"
	rm -rf "$SQLITE/wp-includes/database"
	mkdir -p "$SQLITE/wp-includes/database"
	cp -r "$TMP/sqlite/packages/mysql-on-sqlite/src/." "$SQLITE/wp-includes/database/"
fi
if [ ! -f wp-content/db.php ]; then
	sed -e "s#'{SQLITE_IMPLEMENTATION_FOLDER_PATH}'#__DIR__ . '/plugins/sqlite-database-integration'#" \
		-e "s#{SQLITE_PLUGIN}#sqlite-database-integration/load.php#" \
		"$SQLITE/db.copy" > wp-content/db.php
fi

if [ ! -f bin/wp ]; then
	echo "Installing WP-CLI $WPCLI_VERSION"
	curl -sSL -o bin/wp "https://github.com/wp-cli/wp-cli/releases/download/v$WPCLI_VERSION/wp-cli-$WPCLI_VERSION.phar"
	chmod +x bin/wp
fi

[ -f wp-config-local.php ] || printf "<?php\n// Machine-specific overrides. Not committed.\n" > wp-config-local.php
mkdir -p .local/database

WP="php bin/wp"
[ "$(id -u)" = 0 ] && WP="$WP --allow-root"

if ! $WP core is-installed 2>/dev/null; then
	$WP core install --url="$URL" --title="National Sleep Foundation" \
		--admin_user=admin --admin_password=admin --admin_email=admin@example.com --skip-email
	$WP rewrite structure '/%postname%/'
fi
$WP plugin activate sqlite-database-integration nsf
$WP theme activate nsf

# Private Style Guide page (build plan step 3); the visual test compares it to the Figma Styling frame.
if [ -z "$($WP post list --post_type=page --name=style-guide --post_status=any --format=ids)" ]; then
	$WP post create --post_type=page --post_title="Style Guide" --post_name=style-guide --post_status=private \
		--page_template=blank --post_content='<!-- wp:pattern {"slug":"nsf/style-guide"} /-->'
fi

# Sleep Health Resources page (build plan step 7), built from the Resource Hub pattern.
if [ -z "$($WP post list --post_type=page --name=sleep-health-resources --post_status=any --format=ids)" ]; then
	$WP post create --post_type=page --post_title="Sleep Health Resources" --post_name=sleep-health-resources --post_status=publish \
		--post_content='<!-- wp:pattern {"slug":"nsf/resource-hub"} /-->'
fi

npm install
npm run build

# Private Card Test page (build plan step 6); seed content first with: php bin/wp nsf seed --allow-root
$WP eval-file bin/dev/card-test-page.php
$WP eval-file bin/dev/home-page.php

echo "Done. Run 'npm run serve' and open $URL (admin / admin)."
