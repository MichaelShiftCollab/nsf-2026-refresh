# NSF 2026 Refresh

A fresh WordPress build of thensf.org for the National Sleep Foundation: a block child theme of Frost, one NSF site plugin, Gravity Forms, hosted on WP Engine.

## Read first

- Read `docs/implementation-plan.md` before building any feature. It is the source of truth for features.
- `docs/build-spec.md` says what "done" looks like for each piece; where it and the build plan disagree, the spec wins.
- `docs/build-plan.md` is the 19-step build order. Commit after each step passes its test.
- `docs/decisions.md` holds the answers to open questions. Check it before asking.
- Figma file `mVNfIISs9yQQurddJagkfU`: wireframes on page 2:21, mockups on 154:430, styling on 362:219.

## Where things live

| Path | Holds |
| :--- | :--- |
| `wp-content/themes/nsf/` | Child theme of Frost: `theme.json`, styles, `templates/`, `parts/`, `patterns/`, `assets/fonts/` |
| `wp-content/plugins/nsf/` | Site plugin: post types, taxonomies, custom blocks (`src/blocks/<name>/` → `build/`), REST endpoints, WP-CLI commands (`cli/`), form JSON (`forms/`) |
| `content/` | Site outline, taxonomy terms, page docs, content plan |
| `tests/visual/` | Playwright + pixelmatch screenshot comparison against Figma |

WordPress core, Frost and third-party plugins are not in Git. `bin/setup.sh` installs them.

## Rules

- Use theme.json tokens. Never hard-code colors, sizes or font stacks in CSS or block markup.
- Native blocks only. Build a custom block only where the build spec lists one.
- Never edit Frost. Override it in the child theme.
- Do not build ahead of the current build plan step.

## Commands

```sh
bin/setup.sh            # one-time: WordPress, Frost, SQLite, WP-CLI, npm install, activate
npm run serve           # http://localhost:8080 (admin / admin)
npm run build           # compile blocks to wp-content/plugins/nsf/build
npm run start           # watch blocks
npm run lint            # JS and CSS lint
npm run test:visual     # screenshot comparison (step 2)
npm run test:hub        # Resource Hub behavior: in-place filtering, URL state, view cookie (step 7)
npm run test:global     # header search, mobile menu, Alert Banner on/off, press releases Load more (step 5)
npm run test:home       # Home Hero rotation and reduced motion, valid blocks in the editor (step 8)
npm run test:cta        # Gated Download: no file URL in the page, form to success page, download works (step 9)
npm run test:a11y       # axe-core WCAG 2.2 AA check of the main templates at 1440 and 390 (spec: accessibility)
npm run wp -- <args>    # WP-CLI; add --allow-root when running as root
npm run wp -- nsf terms import   # taxonomy terms from content/taxonomy-terms.json
npm run wp -- nsf seed [--delete]  # 30 sample resources, 20 posts and 8 press releases for building and testing
npm run wp -- nsf reindex          # rebuild the Resource Hub table sort keys
npm run wp -- eval-file bin/dev/card-test-page.php  # rebuild the private Card Test page
npm run wp -- eval-file bin/dev/listing-pages.php   # Sleep Learning Zone® posts page and stub pages for search (add `delete` to remove)
npm run wp -- eval-file bin/dev/home-page.php       # rebuild the Home page from the nsf/home pattern (add keep to keep its content)
npm run wp -- eval-file bin/dev/cta-test-page.php   # rebuild the private CTA Test page and the prospectus Thank you page
npm run wp -- eval-file bin/dev/faq-logos-test-page.php  # rebuild the private FAQ and Logo Test page
npm run wp -- eval-file bin/dev/interior-pages.php [slug ...]  # build the step 15 interior pages from their page patterns
```

The local database is SQLite (`.local/database/nsf.sqlite`) through the sqlite-database-integration drop-in, so no MySQL is needed. Machine-specific settings go in `wp-config-local.php`, which is not committed.
