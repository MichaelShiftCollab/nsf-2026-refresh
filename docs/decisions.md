# Decisions

Answers to the open questions in the build spec and build plan. Newest first.

## October 15, 2026 (Michael)

| Question | Decision |
| :--- | :--- |
| Best Slept Self® band | Build it as the Home mockup shows it ([Figma 473:60](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=473-60)): full-width Light Blue to Light Orange gradient, 96px top-right corner, three photos over a faded sun. Replaces Option A |
| Logo | Use the logo from the mockups until NSF sends final files |

## October 15, 2026 (defaults chosen while building step 8)

| Question | Decision |
| :--- | :--- |
| Home page source | A "Home" page holds the sections as editable blocks and is the static front page; `templates/front-page.html` is header, post content, footer. Rebuild it with `bin/dev/home-page.php` |
| Home Hero images | Placeholders cut from the mockup until NSF picks six photos; the hero advances every 6 seconds, crossfades, and stays on the first image under reduced motion or in a hidden tab |
| Home resource cards | Featured Resources block with the new Short image style (150px image, 40px gap) and excerpts on. The Resources page keeps the 16:9 image |
| Research panels on Home | Outlined text panels with a dot list and a link, as in the mockup, rather than featured image cards as the plan says |
| SleepMark® form before Gravity Forms | `[nsf_form key="sleepmark-lead"]` places a form by its key from `forms/<key>.json`; until Gravity Forms is installed it shows a disabled preview |
| Drowsy Driving Prevention Week® and Sleep Awareness Week® bands | Same layout as Best Slept Self® with placeholder copy and photos until their mockups arrive |
| Section padding | 72px at 1440, as the `section` spacing preset (`clamp(40px, 5vw, 72px)`) |

## October 14, 2026 (Michael)

| Question | Decision |
| :--- | :--- |
| Best Slept Self® band | Option A ([Figma 471:60](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-60)) |
| Topic, Audience and Resource Type terms | Use the terms in the mockups and wireframes; see `content/taxonomy-terms.json` |
| Repository name | NSF 2026 Refresh (`nsf-2026-refresh`) |
| Zoho CRM | Ignore for now; build plan step 16 is deferred |
| Plugin list | Use the keep/drop list in the build spec as is |
| Stack | WordPress, Frost child theme, NSF plugin, Gravity Forms, WP Engine |
| Pages without mockups | Build from wireframes, marked Provisional |
| Topic facet | New hierarchical `topic` taxonomy |

## Defaults taken (change any of these by saying so)

| Question | Default |
| :--- | :--- |
| SEO plugin | All in One SEO (on the current site) |
| Analytics | MonsterInsights (on the current site) |
| My Calendar | Not installed until NSF confirms it still lists events |
| Accessibility target | WCAG 2.2 AA |
| Performance target | Lighthouse mobile 90+ on Home and Sleep Health Resources |
| Blog posts and Resources source | WXR export of the current site (step 17) |
| Dark Blue hex | Taken from the Styling frame swatch in step 3 |
| Sponsor post type | Not built |
| Navy content card colors | Dark Blue fill, Medium Orange eyebrow, white title and link, Light Blue text (the wireframe is gray) |
| Outline and icon card | White, 2px Light Blue border, 16px radius, icon picked per card; no mockup yet |
| Featured image card image | 16:9 crop and 24px gap to the text, from the Resources mockup. Home uses the Short image style of Featured Resources (150px image, 40px gap), from the Home mockup |
| Card grid gap | 30px, from the mockups, added as the `gutter` spacing preset |
| Resource Hub toolbar placement | Search and facets are the Resource Filter Controls block (left rail); result count, sort, Cards/Table toggle and chips sit in the Resource Results block, where the mockup puts them |
| Resource Hub URL parameters | `q`, `topics`, `audiences`, `types`, `sort`, `pg`. Plural names because WordPress reserves `topic` and `audience` for the taxonomy archives |
| Type facet for blog posts | "Article / Blog post", from the mockup; posts and Resources are searched together |
| Facet counts | Shown in parentheses (the spec asks for counts; the mockup omits them). Options stay listed at 0 so choices do not jump around |
| Results per page | 9 (three rows of cards). The table mockup shows 10 rows |
| Featured Resources with fewer than 3 picks | The newest Resources fill the empty cards |
| Cards/Table cookie | Applied in the browser, not by PHP, so WP Engine's page cache serves one page to everyone |
| Filters below 782px | A full-screen drawer opened by the "Filters (n)" button; chips are hidden there, as in the 781 and 600 mockups |
| Page gutter | 32px at 600, 40px at 781, rising to 120px at 1440, from the Resources mockups |
| Search filter buttons | Built from core blocks plus two block bindings sources in the NSF plugin (`nsf/listing`, `nsf/result`), not a custom block, since the spec lists none. A result matches any selected term. Terms with the same name in different taxonomies (Sleep Disorders topic and category) share one button. The 12 most used show; selected ones always show |
| Search URL parameter | `filter=taxonomy:slug,taxonomy:slug` |
| Dates in search results | On everything but pages. The spec says "posts only", but the wireframe dates Resources too |
| Page result eyebrow | The top-level ancestor's title; top-level pages show none |
| Title band on search and 404 | Lightest Blue section style, standing in for the wireframe's gray band until the Title band pattern (step 15) and mockups exist |
| Posts per page on the blog and archives | 9 (three rows of cards); search stays at 10 |
| Blog-only search | The search field sends `post_type=post`, so it lands on the search template limited to posts |
| Topic archive breadcrumb | A bound paragraph (Sleep Learning Zone® / topic) until the Breadcrumbs block in step 5 replaces it |
| 404 link URLs | Typed from the site outline (`/national-programs/`, `/contact-us/` and so on); check them after the content migration in step 17 |

## Deferred

- Header Flag JavaScript location (needed for step 10)
- Copy for the 12 empty page docs (step 17)
- Zoho module and field mapping (step 16)
