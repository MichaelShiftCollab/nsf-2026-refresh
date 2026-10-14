# NSF Website Build Plan for Claude Code

Version: October 14, 2026
Source of truth for features: `docs/implementation-plan.md` (converted from *NSF Implementation Plan 2026-10-14.docx*)
Figma file: [NSF-2026](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026)

## How to use this plan

Run the steps in order. Each step has:

- **Needs**: mockups and other inputs that must exist before you start the step.
- **Prompt**: paste it into Claude Code from the repo root.
- **Test**: what to run, and what passing looks like.

Commit after each step passes. Steps 7 to 15 can be reordered if a mockup arrives late. Each one depends only on steps 1 to 6.

The screenshot comparison in step 2 is the test for every visual step. Mockups use placeholder copy, so some difference is expected. A failing comparison means: open the diff image and look. Fix layout, spacing, color and type differences. Ignore copy differences.

---

## Before you start

Have these ready:

1. **Repo** with a local WordPress install, plus access to the WP Engine staging site.
2. **Frost** (WP Engine) installed as the parent theme.
3. **Gravity Forms** installed and licensed. The Zoho CRM connection in step 16 uses the Gravity Forms Zoho CRM Add-On, which needs a license tier that includes it.
4. **Figma access** for Claude Code (Figma MCP server), so prompts can read frames by link.
5. **Fonts:** Test Family (heading font until Shift buys Family) and Open Sans, as web font files.
6. **Logo:** Concept 1A as SVG.
7. **Implementation plan** saved as `docs/implementation-plan.md`. Use `pandoc -t gfm` on the Word file.
8. **Page content:** the page docs from the Drive folder "NSF Website Pages", exported as .docx to `content/pages/`, and the CONTENT PLAN tab exported as `content/content-plan.csv`.
9. **Site outline:** parent/child page structure from the FigJam board "NSF Web Outline", saved as `content/site-outline.md`.
10. **Zoho CRM:** API access, and the module and field mapping for each form saved as `docs/zoho-mapping.md` (step 16).

---

## Mockup schedule

All mockups are needed at 1440, 781 and 600 widths. A step can start once its 1440 mockup exists. The 781 and 600 mockups are needed before that step's test can fully pass.

| Mockup | Figma frame | Status | Needed by step |
|---|---|---|---|
| Styling | [362:219](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=362-219) | Ready | 3 |
| Shared components | [464:2](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=464-2) | Ready (1440) | 5, 6 |
| Header, alert banner, footer, newsletter sign-up row (if not all in Shared components) | — | To come | 5 |
| Content cards: outline and icon, navy fill, featured image | — | To come (featured image card is on Home and Resources) | 6 |
| Sleep Health Resources, cards view | [1440](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-431) · [781](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=182-2) · [600](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=187-185) | Ready | 7 |
| Sleep Health Resources, table view | [1440](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-681) · [781](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=188-2) · [600](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=190-2) | Ready | 7 |
| Home | [1440](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=464-67) | Ready (1440); 781 and 600 to come | 8 |
| Best Slept Self band, options A/B/C | [A](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-60) · [B](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-74) · [C](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-88) | Ready; option to be chosen | 8 |
| Campaign band, Drowsy Driving Prevention Week® and Sleep Awareness Week® versions | — | To come | 8 |
| General CTA row, Flexible CTAs, Contact Us CTA, Statistics row, Participation Toolkit, gated download form and success page | — | To come | 9 |
| Header Flag | — | To come | 10 |
| FAQ accordion, Sponsor/Collaborator grid | — | To come | 11 |
| Resource single | — | To come | 12 |
| Search results | — | To come | 13 |
| Sleep Learning Zone archive, topic archive, 404 | — | To come | 14 |
| National Programs, Sleep Awareness Week®, SleepTech® Network Membership, Sleep in America® Polls, Drowsy Driving Prevention Resource Center, Drowsy Driving Prevention Week®, Media Center | — | To come | 15 |

Wireframes for all of these are on the [Wireframe detailed](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=2-21) page. Until a mockup exists, Claude Code can build structure from the wireframe and come back for styling.

---

## Steps

### 1. Set up the repo, child theme and NSF plugin

**Needs:** everything in "Before you start" except Zoho.

**Prompt**
```text
Set up this repo for the NSF website build.

1. Create a block child theme of Frost in /wp-content/themes/nsf (style.css with Template: frost, theme.json, functions.php, /parts, /templates, /patterns, /assets/fonts).
2. Create a site plugin named "NSF" in /wp-content/plugins/nsf. It will hold custom post types, taxonomies, custom blocks and site functions. Set up @wordpress/scripts so blocks live in /wp-content/plugins/nsf/src/blocks/<block-name> and build to /build.
3. Add npm scripts at the repo root: build, start, lint, test:visual.
4. Write CLAUDE.md at the repo root with: project summary, where things live (theme vs plugin), "read docs/implementation-plan.md before building any feature", "use theme.json tokens, never hard-coded colors or sizes", "native blocks only", and how to run the build and tests.
5. Activate the theme and plugin on the local site with WP-CLI.

Do not build any features yet.
```

**Test:** `npm run build` finishes with no errors. `wp theme list` shows nsf active with frost as parent. `wp plugin list` shows nsf active. The site front end loads.

---

### 2. Build the screenshot comparison harness

**Needs:** Styling mockup (to try the harness).

**Prompt**
```text
Build a screenshot comparison harness that compares the local site to Figma mockups.

1. Use Playwright and pixelmatch. Put everything in /tests/visual.
2. Mockup images live in /tests/visual/mockups/<name>-<width>.png. Add a script, npm run mockups:pull, that exports Figma frames listed in /tests/visual/mockups.json (name, Figma node id, width) as PNG at 1x using the Figma MCP or REST API. File key: mVNfIISs9yQQurddJagkfU.
3. /tests/visual/pages.json lists what to capture: name, local URL, widths (1440, 781, 600), optional CSS selector for a single section, and optional setup actions (click, select a filter, switch to table view) so interactive states can be captured.
4. npm run test:visual captures each entry at each width, compares it to the matching mockup, and writes the screenshot, the diff image and a mismatch percentage to /tests/visual/results. Compare the overlapping area when heights differ, and report the height difference.
5. Default pass threshold 10% mismatch, configurable per entry. Produce an HTML report listing every comparison with the three images side by side.
6. Add the Styling page (node 362:219, 1440) as the first mockup entry so the harness can be tried.
```

**Test:** `npm run mockups:pull` downloads the Styling mockup. `npm run test:visual` runs and the HTML report opens with the screenshot, mockup and diff side by side. The Styling comparison is expected to fail until step 3.

---

### 3. Set up design tokens and the style guide page

**Needs:** Styling mockup. Test Family and Open Sans font files.

**Prompt**
```text
Read docs/implementation-plan.md, section "Web Styling Details", and the Figma Styling frame (node 362:219).

Set up the child theme's theme.json and block styles to match:
1. Color palette: Dark Blue, Primary Blue, Medium Blue, Light Blue, Lightest Blue, Primary Orange, Medium Orange, Light Orange, Gray, White. Read exact values from Figma.
2. Gradients: Primary Blue > Dark Blue, Light Blue > Light Orange, Light Blue > White, Light Orange > White, and the limited-use Announcement Bar (Medium Blue > Primary Blue) and Inner Page Heading (Primary Blue > Medium Blue > Primary Orange).
3. Typography: self-host Test Family (H1, H2) and Open Sans (H3 to H5, eyebrow, paragraphs). Font sizes and line heights for H1 to H5, Eyebrow, Paragraph 1, 2, 3, Caption and Meta Text. Register Eyebrow, Paragraph 1, Caption and Meta Text as block style variations or font size presets.
4. Layout: content width and wide width 1200px, with 120px side spacing at 1440.
5. Buttons: Primary (orange fill; hover orange outline) and Secondary (blue outline; hover blue fill), pill shape, as core Button block styles.
6. Image block style "Frame": 72px radius on two opposite corners, as on the Styling page.
7. Separator: Light Blue rule as the default.
8. Section background styles for Group: each solid and gradient above.

Then create a private page "Style Guide" with WP-CLI whose content reproduces the Styling frame using core blocks, and add it to /tests/visual/pages.json.
```

**Test:** `npm run test:visual -- --grep styling` passes at 1440. Buttons show their hover states when hovered in the browser.

---

### 4. Set up Gravity Forms in code

**Needs:** form field lists in `docs/implementation-plan.md` (Forms, Gated Download, Custom Blocks & Patterns > CTAs, Patterns > Participation Toolkit) and the SleepTech® Network Membership wireframe.

**Prompt**
```text
Read docs/implementation-plan.md sections "Forms", "Gated Download", "Custom Blocks & Patterns" and the SleepTech Network Membership wireframe (Figma node 207:2).

Write a WP-CLI command in the NSF plugin, `wp nsf forms import`, that creates or updates these Gravity Forms using GFAPI, so forms are reproducible across local and staging:
1. Newsletter sign-up (email)
2. SleepMark lead (Name, Work email, Company)
3. Contact Us (fields from the plan)
4. Sponsorship Prospectus (fields from the plan; used by the Flexible CTA and the Gated Download)
5. Participation Toolkit (Name, Email, Organization, How you plan to use it)
6. SleepTech Network Membership Application (fields from the wireframe)

Store each form definition as JSON in /wp-content/plugins/nsf/forms. Matching is by a stable form key, so running the command twice does not duplicate forms. Do not connect Zoho yet.
```

**Test:** run `wp nsf forms import` twice. `wp gf form list` shows six forms, with no duplicates. Each form renders on a scratch page and submits an entry.

---

### 5. Build the global parts

**Needs:** Shared components mockup, plus header, alert banner, footer and newsletter sign-up row mockups at all three widths.

**Prompt**
```text
Read docs/implementation-plan.md sections "Alert Banner", "Header Search", "Newsletter Sign-up Row" and "Patterns" (Header, Footer, Breadcrumbs). Use the Figma Shared components section (node 464:2) and the header, alert banner, footer and sign-up mockups.

Build:
1. Alert Banner: a custom block in the NSF plugin with editable text and link and an on/off control, styled with the Announcement Bar gradient. Place it at the top of the header part.
2. Header template part: Concept 1A logo, utility menu (About Us, Contact, Media Center), a search icon that opens a search field in the header and submits to the search page, and the main menu (National Programs, Sleep Health Resources, Research, SleepTech®, SleepMark®). Mobile navigation per the 600 mockup.
3. Footer template part: logo, tagline, utility links, 35th anniversary seal, disclaimer, copyright, social icons (Instagram, Facebook, X, LinkedIn, YouTube, Bluesky).
4. Newsletter sign-up row: a synced pattern using the Newsletter Gravity Form, placed above the footer on every template.
5. Breadcrumbs: a breadcrumb block or function used by page, post, archive and Resource templates. Resource breadcrumbs come later in step 12.

Add the header, footer and sign-up row as section entries in /tests/visual/pages.json at 1440, 781 and 600.
```

**Test:** `npm run test:visual -- --grep global` passes at all three widths. The alert banner can be turned off in the editor. Typing in the header search field and pressing Enter lands on the search results page.

---

### 6. Build the content model and content cards

**Needs:** content card mockups (all three types). The featured image card is already on the Home and Resources mockups.

**Prompt**
```text
Read docs/implementation-plan.md sections "Content Types" and "Blocks > Featured Content Cards".

1. In the NSF plugin, register the Resource custom post type (post date, content, author, featured image, attachment) and taxonomies Resource Type (hierarchical), Resource Tag and Audience. Register them for the REST API.
2. Add a meta field for the Resource's attached file, and a helper that returns file type, size and page count for PDFs.
3. Write `wp nsf seed` to create test content: 30 Resources across types, tags and audiences; 20 posts across categories; featured images from a placeholder set. Mark seeded items so `wp nsf seed --delete` removes them.
4. Build a Content Card block with three variations: Outline and icon, Navy fill, Featured image. Fields: eyebrow, title, excerpt, link, image or icon. It works with a manually picked post or page, and as a card pattern inside a Query Loop post template.
5. Create a "Card grid" pattern (3-up and 4-up) for each variation.

Add a test page with every card variation to /tests/visual/pages.json.
```

**Test:** `wp post-type list` shows resource. `wp nsf seed` and `wp nsf seed --delete` both run cleanly. The card test page passes `npm run test:visual -- --grep cards` at all three widths.

---

### 7. Build the Resource Hub

**Needs:** Sleep Health Resources cards and table mockups at 1440, 781 and 600 (ready). Steps 3, 5 and 6 done.

**Prompt**
```text
Read docs/implementation-plan.md section "Resource Hub" in full. Use the Figma mockups: cards view 154:431, 182:2, 187:185; table view 154:681, 188:2, 190:2.

Build in the NSF plugin:
1. Featured Resources block: editor picks 3 posts; displays featured image cards.
2. Resource Filter Controls block: search box, Topic / Audience / Type facets populated from terms that have posts (with counts), facet groups that expand and collapse with "Show more" after six options, active filter chips with "Clear all", sort dropdown (default newest first), result count, Cards/Table toggle stored in a cookie.
3. A REST endpoint that returns filtered, sorted, paginated results for Resources and posts.
4. Results display: cards view, and table view with Title, Type, Topic, Audience and Date columns, each sortable ascending or descending with an arrow control. Pagination that works with the AJAX filtering.
5. A "Resource Hub" pattern: intro, Featured Resources, then filter controls with results. Create the Sleep Health Resources page with it.

Add these states to /tests/visual/pages.json at all three widths: default cards view; table view; two filters applied with chips showing.
```

**Test:** `npm run test:visual -- --grep resources` passes for all states and widths. In the browser: filtering does not reload the page, the URL keeps the filter state, and the Cards/Table choice survives a reload.

---

### 8. Build the Home page

**Needs:** Home mockup (1440 ready; 781 and 600 to come). Best Slept Self band option chosen. Campaign band versions for Drowsy Driving Prevention Week® and Sleep Awareness Week®.

**Prompt**
```text
Read docs/implementation-plan.md sections "Home Hero", "Patterns > Campaign band" and "Blocks > Featured Content Cards". Use the Figma Home mockup (464:67) and Best Slept Self band option [A/B/C — fill in].

Build:
1. Home Hero: H1 with rotating images (six, auto-advance, no slide indicators), sized to fit above the fold at 1440 × 800. Respect prefers-reduced-motion.
2. Campaign band: three patterns (Best Slept Self default, Drowsy Driving Prevention Week, Sleep Awareness Week) that an editor swaps by hand.
3. Home page sections per the mockup: What we do, campaign band, featured Sleep Health Resources (3 editor-picked featured image cards), Research (featured research row and 3 panels as featured image cards), For business (SleepMark panel with the SleepMark Gravity Form; SleepTech panel), featured collaboration.
4. A front-page template using these patterns.

Add the Home page to /tests/visual/pages.json at 1440, and at 781 and 600 once those mockups are pulled.
```

**Test:** `npm run test:visual -- --grep home` passes at every width that has a mockup. The hero stops rotating when reduced motion is on.

---

### 9. Build the CTA and callout blocks

**Needs:** mockups for the General CTA row, Flexible CTAs, Contact Us CTA, Statistics row, Participation Toolkit, and the gated download form and success page. Until they exist, use the "Plan items — added wireframes" sheet (node 489:2).

**Prompt**
```text
Read docs/implementation-plan.md sections "General Call to Action", "Gated Download", "Blocks > Callouts", "Blocks > CTAs" and "Patterns > Participation Toolkit". Use the mockups listed in the build plan, or the wireframes on node 489:2 where a mockup is missing.

Build in the NSF plugin and child theme:
1. General CTA row block: heading, text, one button that links to a page or a mailto address.
2. Flexible CTA with link block.
3. Flexible CTA with Gravity Form block: heading, copy, form picker.
4. Contact Us CTA pattern using the Contact Us form.
5. Statistics row pattern: big-number grid, 2 or 4 across.
6. Pull quote: a block style on core Pullquote.
7. Participation Toolkit pattern using the Toolkit form.
8. Gated Download block: cover, title, file details and a form picker. Submitting sends the visitor to a success page that shows the cover and a download button for the chosen file. The file URL is not exposed before the form is submitted.

Add a test page per block to /tests/visual/pages.json.
```

**Test:** `npm run test:visual -- --grep cta` passes at all three widths for blocks with mockups. Submitting the gated download form lands on the success page, and the download works.

---

### 10. Build the Header Flag

**Needs:** Header Flag mockup. The existing Header Flag JavaScript from the current site.

**Prompt**
```text
Read docs/implementation-plan.md section "Header Flag". Port the existing Header Flag JavaScript into a custom block with page-level controls: visibility on/off, label text, and link type (anchor on the page, PDF from the media library, or another page). Rewrite it so it works on any page. Example: the "Drowsy Driving Forum" tab on the Drowsy Driving Prevention Week page. Add a test page that shows the flag after scrolling.
```

**Test:** the comparison passes at all three widths with the page scrolled. Each link type works.

---

### 11. Build the FAQ accordion and the Sponsor/Collaborator grid

**Needs:** FAQ and Sponsor/Collaborator grid mockups.

**Prompt**
```text
Read docs/implementation-plan.md sections "FAQ" and "Sponsor/Collaborator Grid".

1. FAQ pattern: question rows that expand and collapse, keyboard accessible. Output FAQPage JSON-LD that matches the questions and answers on the page. Use the SleepTech Network FAQs from https://www.thensf.org/sleeptech-network/ as test content.
2. Sponsor/Collaborator grid: unsynced patterns for tiered rows and untiered grids, with logos kept to a consistent height and width box. Editors can add, reorder and remove logos.
```

**Test:** the comparison passes at all three widths. The JSON-LD passes Google's Rich Results Test (paste the page HTML).

---

### 12. Build the Resource single template

**Needs:** Resource single mockup.

**Prompt**
```text
Read docs/implementation-plan.md section "Resource CPT Single". Use the Resource single mockup.

1. Extend breadcrumbs for Resources to show the taxonomy, with middle terms linking to the Resource Hub with that filter applied.
2. single-resource template: title band (breadcrumb, H1, subtitle, byline), overview pattern (cover, download button, file details from step 6, summary), Statistics row for key findings, Related Content block, disclaimer.
3. Related Content block: editor picks 3 posts or pages, shown as featured image cards with each item's type as the eyebrow.
```

**Test:** the comparison passes at all three widths using a seeded Resource. Breadcrumb links open the hub with the filter applied.

---

### 13. Build the Search results template

**Needs:** Search results mockup.

**Prompt**
```text
Read docs/implementation-plan.md section "Search Page". Use the Search results mockup.

Build the search template: title band with search field and button prefilled with the query, result count, multi-select filter buttons populated from categories, tags and taxonomies that have results, a results list where pages show their site section as the eyebrow and posts and Resources show their post type, publish dates on posts only, and pagination.
```

**Test:** the comparison passes at all three widths for a search for "sleep" on seeded content, with and without a filter selected.

---

### 14. Build the archive and 404 templates

**Needs:** Sleep Learning Zone archive, topic archive and 404 mockups.

**Prompt**
```text
Read docs/implementation-plan.md sections "Sleep Learning Zone Archive", "Topic Archive" and "404 Page". Use their mockups.

Build: the blog archive template (search limited to posts, post count, 3-column featured image cards, pagination); the category archive template (breadcrumb, H1, description, search, count, cards without the category eyebrow, pagination); and the 404 template (title band, short copy, site search, "Where to go instead" links in three columns).
```

**Test:** the comparison passes at all three widths for each template.

---

### 15. Build the interior page patterns

**Needs:** mockups for National Programs, Sleep Awareness Week®, SleepTech® Network Membership, Sleep in America® Polls, Drowsy Driving Prevention Resource Center, Drowsy Driving Prevention Week® and Media Center. Build one page at a time as each mockup arrives.

**Prompt** (run once per page)
```text
Read docs/implementation-plan.md and the [PAGE NAME] mockup at 1440, 781 and 600.

Build the page's sections as patterns in the child theme, reusing the blocks and patterns from steps 3 to 14 wherever they fit. Use core blocks for simple layouts. Only create a new pattern when a section will be reused or is hard for editors to rebuild. List any section that needed something new.

Create the page with placeholder content matching the mockup, and add it to /tests/visual/pages.json.

Page-specific notes:
- Sleep in America Polls: poll entry pattern with the cover on the left; it must also work without a cover.
- Media Center: sections in this order: title band with media contact, key facts (Statistics row), experts, press mentions, press releases with "Load more".
```

**Test:** the comparison passes at all three widths for each page.

---

### 16. Connect Gravity Forms to Zoho CRM

**Needs:** Zoho CRM API access and the module and field mapping for each form.

**Prompt**
```text
Install and configure the Gravity Forms Zoho CRM Add-On. Create a feed for each form from step 4 using the mapping in docs/zoho-mapping.md. Export the feed settings so they can be re-applied on staging. Write docs/zoho-setup.md with the steps to connect the add-on on a new environment.
```

**Test:** submit each form once. Each submission appears in the right Zoho module with every mapped field filled. Delete the test records in Zoho afterwards.

---

### 17. Migrate page content from the Word docs

**Needs:** the .docx files in `content/pages/`, `content/content-plan.csv` and `content/site-outline.md`. Steps 3 to 15 done for the patterns each page uses.

**Prompt**
```text
Migrate page content into WordPress.

1. Convert each .docx in content/pages to HTML with pandoc, keeping headings, links and lists.
2. Read the doc header (Page title, Old URL, New URL, Audience, Meta) and the matching row in content/content-plan.csv.
3. Map the body onto the page's patterns from step 15, or onto core blocks for pages without a mockup. Keep headings structural (one H1, then H2, H3 in order). Buttons and form labels in the docs become Button blocks or form placements.
4. Create or update each page with WP-CLI: title, slug from New URL, parent from content/site-outline.md, meta description from Meta.
5. Write a migration report to content/migration-report.md: each page, what pattern it used, and anything that did not map cleanly.

Make the script safe to re-run: it updates existing pages instead of duplicating them.
```

**Test:** the report lists every page in the content plan. Pages with mockups pass the comparison at all three widths, with copy differences ignored. Spot-check five pages without mockups in the browser.

---

### 18. Deploy to WP Engine staging

**Needs:** WP Engine staging access.

**Prompt**
```text
Deploy the child theme, the NSF plugin build and the content to WP Engine staging.

1. Set up deployment using WP Engine's Git push or the WP Engine GitHub Action. Deploy only /wp-content/themes/nsf and /wp-content/plugins/nsf, excluding node_modules and source maps.
2. Move the database and uploads from local to staging, replacing URLs.
3. On staging, run `wp nsf forms import`, re-apply the Zoho feeds, and run `wp nsf seed --delete` if any seed content is left.
4. Write docs/deploy.md with the deploy steps.
```

**Test:** staging loads with the nsf theme active. `wp gf form list` on staging shows six forms. One test submission per form reaches Zoho.

---

### 19. Run the full visual check on staging

**Needs:** all mockups at all three widths.

**Prompt**
```text
Point the visual harness at the staging URL and run every entry in /tests/visual/pages.json at 1440, 781 and 600. Group the failures by cause (spacing, type, color, layout, content only). Fix everything except content-only differences, re-run, and write docs/visual-qa.md listing what remains and why.
```

**Test:** every comparison passes, or is listed in docs/visual-qa.md as a content-only difference.

---

## Open questions

These affect the steps noted. Answer them before the step starts.

1. **Topic** (Resource Hub, step 7): which taxonomy does the Topic facet and table column use?
2. **Blog posts and Resources** (step 17): the Word docs cover pages. Where do the existing Sleep Learning Zone posts and the Resources come from: a WordPress export of the current site, or somewhere else?
3. **Header Flag JavaScript** (step 10): where is the current implementation?
