# NSF 2026 Refresh

WordPress build of the new National Sleep Foundation website. See `CLAUDE.md` for how the repo is organized and `docs/` for the spec, build plan and implementation plan.

## Local setup

Needs PHP 8.1+ (with the pdo_sqlite extension), Node 20+, git and curl.

```sh
bin/setup.sh
npm run serve
```

Open http://localhost:8080 and log in at /wp-admin with admin / admin.

Gravity Forms is licensed and is not in the repo. Install its zip into `wp-content/plugins/` and activate it before build plan step 4.
