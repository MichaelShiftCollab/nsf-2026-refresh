# Deploying to WP Engine

Build plan step 18. Code goes up through GitHub Actions; content is loaded once over WP Engine's SSH gateway.

## What deploys

`.github/workflows/deploy.yml` runs on every push to `main` (and by hand from the Actions tab). It builds the blocks, then sends three folders with WP Engine's official action ([github-action-wpe-site-deploy](https://github.com/wpengine/github-action-wpe-site-deploy)):

| Folder | Notes |
| :--- | :--- |
| `wp-content/plugins/nsf/` | With `build/`, without `src/`, `node_modules/` and source maps. Carries a copy of `content/taxonomy-terms.json` in `data/` for `wp nsf terms import` |
| `wp-content/themes/nsf/` | As in the repo |
| `wp-content/themes/frost/` | The parent theme, at the version `bin/setup.sh` uses |

Never deployed: WordPress core, `wp-config.php`, `wp-config-local.php`, `wp-content/db.php` and the SQLite plugin. WP Engine runs its own config and MySQL; the SQLite drop-in would take the site off MySQL.

## One-time setup

1. **Key pair.** Make a deploy-only key: `ssh-keygen -t ed25519 -f wpengine_deploy -N "" -C "nsf github deploy"`.
2. **WP Engine.** In the User Portal, Profile > SSH keys > Create SSH key, paste `wpengine_deploy.pub`. It takes a few minutes to work.
3. **GitHub.** In the repo, Settings > Secrets and variables > Actions:
   - Secret `WPE_SSHG_KEY_PRIVATE`: the contents of `wpengine_deploy` (the private key). Then delete the local copy.
   - Variable `WPE_ENV`: the environment name, the part before `.wpengine.com` (staging first).
   Until `WPE_ENV` is set, the workflow skips the deploy.
4. **Deploy.** Actions > Deploy to WP Engine > Run workflow, or push to `main`.

## First content load (over SSH)

The local site's database is SQLite, so it is not copied. Instead, build the same setup on the environment with WP-CLI. Replace `ENV` with the environment name:

```sh
ssh ENV@ENV.ssh.wpengine.net
cd sites/ENV
wp theme activate nsf
wp plugin activate nsf
wp rewrite structure '/%postname%/'
wp nsf terms import
wp nsf seed          # optional: sample Resources, posts and press releases
exit
```

The page scripts in `bin/dev/` are not deployed; send them from a checkout with `wp eval-file -`, which reads the script from standard input:

```sh
for s in home-page listing-pages interior-pages; do
  ssh ENV@ENV.ssh.wpengine.net "cd sites/ENV && wp eval-file -" < bin/dev/$s.php
done
```

Without SSH access, run **Actions > Refresh pages > Run workflow** instead. It sends the named scripts (default `interior-pages`) over the same deploy key. Re-run it after a deploy that changes a page pattern or template, since page content lives in the database.

Skip the private test pages (`cta-test-page`, `card-test-page`, `faq-logos-test-page`) unless you want them there. `wp nsf seed --delete` removes the sample content before launch.

## Still to do on the environment

- Install and license Gravity Forms (and the Zoho CRM add-on for step 16), then import the forms in `wp-content/plugins/nsf/forms/` (the `wp nsf forms import` command is still to build in step 4).
- Add the Zoho feeds (step 16).
- Real content comes with the migration in step 17.
