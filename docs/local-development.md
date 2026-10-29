# Local development setup

## Current machine status

- macOS with PHP 8.5.8 and the required PHP extensions (`mysqli`, `pdo_mysql`,
  `curl`, `mbstring`, `openssl`, `gd`, `intl`, and `soap`) available.
- MySQL 8.4.5 is reachable at `127.0.0.1:3306`.
- The configured application database, `whmcs78_cloudytek_demo`, exists and
  the application database login has been verified.
- The database currently has no tables. This repository does not include the
  WHMCS installer or a database dump, so the application cannot complete its
  bootstrap yet.
- PHP dependencies are present in `vendor/`. There is no root Composer
  manifest, so do not run `composer install` for this repository.
- `configuration.php` points at port `3306`. It contains credentials and is
  tracked by Git; do not copy credentials into documentation, commit local
  secrets, or overwrite them with placeholders.

## Prerequisites

1. PHP with the extensions listed above.
2. A running MySQL server and a database user with privileges limited to the
   WHMCS database.
3. A WHMCS database dump from a compatible WHMCS version, or the matching
   licensed WHMCS installer. Neither is included in this repository.
4. A local WHMCS license/domain configuration if required by the license.

The bundled source is a legacy WHMCS application. PHP 8.5 reports deprecated
nullable-parameter declarations in the Linode integration; use the PHP version
supported by the matching WHMCS release for a closer-to-production environment.

## Setup steps

1. Start MySQL and create an empty database plus a dedicated application user.
   Grant that user access only to the WHMCS database; do not run the app as
   MySQL `root`.
2. Configure `configuration.php` with the local database host, port, name, user,
   password, license value, and encryption hash. Keep these values private.
   The current local config uses `127.0.0.1:3306` and the database
   `whmcs78_cloudytek_demo`.
3. Import a compatible WHMCS SQL backup into that database. For example, with
   the MySQL command-line client installed:

   ```sh
   mysql --host=127.0.0.1 --port=3306 --user=YOUR_DB_USER --password \
     whmcs78_cloudytek_demo < /path/to/whmcs-backup.sql
   ```

   Enter the password at the prompt. Never put it in the command line, shell
   history, this document, or a checked-in file. A compressed `.sql.gz` dump
   needs to be decompressed or imported with an appropriate client.
4. Check that the imported database contains the expected WHMCS tables, such as
   `tblclients` and `tblconfiguration`. Use a backup from the matching WHMCS
   version; do not point this code at an unrelated schema.
5. Configure the local `SystemURL` in WHMCS to match the local web address and
   check the license requirements before loading the site.
6. Serve the project from its repository root. For a basic PHP endpoint check:

   ```sh
   php -S 127.0.0.1:8000 -t .
   ```

   Open `http://127.0.0.1:8000/`. PHP's built-in server does not process
   `.htaccess`, so extensionless WHMCS routes and rewrite rules require Apache
   (or another web server) configured with PHP and the repository's rewrite
   rules enabled.
7. Check the home page and login using a non-production test account. Do not
   expose this legacy application to a public network.

## Validation

From the repository root:

```sh
php -l index.php
php -l init.php
php -l configuration.php
php includes/cloudytek/linode/tests/api_test.php
```

The Linode API test uses a mock transport and does not create live resources.
The database-backed Linode worker test requires a populated, isolated WHMCS
database and refuses to run unless its configured fixture database matches the
expected demo database.
