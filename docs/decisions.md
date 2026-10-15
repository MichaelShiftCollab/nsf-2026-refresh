# Decisions

Answers to the open questions in the build spec and build plan. Newest first.

## October 15, 2026 (Michael)

| Question | Decision |
| :--- | :--- |
| Best Slept Self® band | Build it as the Home mockup shows it ([Figma 473:60](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=473-60)): full-width Light Blue to Light Orange gradient, 96px top-right corner, three photos over a faded sun. Replaces Option A |
| Logo | Use the logo from the mockups until NSF sends final files |

## October 15, 2026 (defaults chosen while building step 15)

| Question | Decision |
| :--- | :--- |
| Interior page mockups | Claude's HTML mockups in the project files (`mockups/`), drawn from the wireframes and the Home and Resources mockups because Figma could not be edited from a Dev seat. Rendered at 1440, 781 and 600 and copied to `tests/visual/mockups/` as the visual test references. Provisional until Michael signs them off |
| Title band | The Inner Page Heading gradient with a white sheet whose top-right corner is rounded (block style "Title band"). Pages, Resources, search and 404 use it, replacing the Lightest Blue stand-in |
| Pages whose band has more than a title | They use the "No Title" template (full-width content only) and start with a title band section: the plain `nsf/title-band` pattern, or one with a photo or a contact box |
| Page subtitle | `nsf_subtitle` meta on pages too, set in the editor's "Title band" panel |
| Page URLs | From the site outline until the page docs give URLs (step 17): `/national-programs/…`, `/research/nsf-research-reports/sleep-in-america-polls/`, `/sleeptech/sleeptech-network/sleeptech-network-membership/`, `/media-center/` |
| Page section CSS | One file per page in `assets/css/pages/`, available on every page and in the editor so sections can be reused anywhere |
| Statistic on a tinted section | Turns white with the card shadow and rounded top-right corner, as in the Resource single mockup |
| Related Content at tablet width | Two cards across, one on phones |
| Visual test scope for pages | Interior pages and the Resource single ignore the header, sign-up and footer, which have their own tests and differ from the HTML mockups at 781 and 600. The Resource single allows 25% height difference because the seeded Resource has much shorter copy than the mockup's |
| Section spacing | The `section` spacing token is now 56px at 781 and below (was 40px), rising to 72px, to match the page mockups |
| Tablet type and corners | New `body-large` (20px) and `body-medium` (18px) font tokens and a `band-tablet` (64px) radius for the title band at 781 and below replace sizes typed into the page CSS; the per-page 56px section overrides are gone now the `section` token covers them |
| Breadcrumbs on phones | Home stays left out at every width (the October 15 step 5 decision). The interior page mockups wrongly showed "Home /" and were corrected |
| Dropdown fields | The NSF Form preview draws Gravity Forms `select` fields as a pill with a Primary Blue chevron; the first option is the placeholder |
| Flexible CTA with Form options | An optional eyebrow above the form and a "One field per row" toggle that stacks half-width fields (used by the Sleep Awareness Week® toolkit, as in its mockup) |
| SleepTech® Network Membership form | A real form (`forms/sleeptech-network-membership.json`) replaces the drawn field preview. Company type choices are provisional: Device or wearable maker, App or software, Bedding or sleep products, Health care or research, Other |
| Half-width fields on phones | Stack at 600px and below (was 599), matching the mockups' phone breakpoint |
| Home at 781 and 600 | HTML kit mockups (`mockups/pages/home.frag.html`) drawn from the Figma 1440 frame and the site's reflow. They allow 15% mismatch (other pages 10%) because the kit's stand-in heading font and untrimmed text spacing drift the long page. Featured cards stay 3 across at 781, as the block's Figma 182:31 reference says |
| Band corner below 782px | The campaign bands use the 64px `band-tablet` corner, like the title band |
| Accessibility check | `npm run test:a11y` runs axe-core (WCAG 2.2 A and AA) on 15 pages at 1440 and 390. Only color contrast fails, all from mockup colors (Primary Orange text, white on orange buttons, Medium Blue pagination); waiting on Michael |
| Page section CSS on the front end | A page loads only the section files whose classes its content uses (all of them when it holds a synced pattern), printed inline when small. The editor still loads all of them |
| Performance | Open Sans is preloaded; the sun watermark is WebP (130 KB to 30 KB); theme images in patterns get their width and height. Local Lighthouse mobile: Home 88, Resources 86, on PHP's dev server without compression or caching, which WP Engine adds |

## October 15, 2026 (defaults chosen while building step 9)

| Question | Decision |
| :--- | :--- |
| CTA look before mockups | The wireframes are gray; the blocks use the brand: General CTA Row on a Lightest Blue panel, Flexible CTA with Link on Dark Blue (Navy, default) or Lightest Blue, forms in a white panel 640px wide beside the copy. All Provisional |
| Contact Us CTA, Participation Toolkit | Patterns built on the Flexible CTA with Form block with the `contact-us` and `participation-toolkit` forms. Toolkit fields: Name and Email required, Organization and "How you plan to use it" optional |
| CTA blocks' text | Headings, copy and buttons are ordinary blocks inside the CTA blocks, so editors use the usual tools; the blocks add the layout, the form and the file |
| Gated Download flow | The form carries a signed token naming the file, cover and success page, never the file URL. Gravity Forms' confirmation redirects to the success page with a signed link that works for 7 days; the button streams the file through `?nsf_file=`. The PDF stays in the media library, so someone who already has its uploads URL can still open it |
| Gated Download success page | A "Thank you" page (`/prospectus-thank-you/`) with the Gated Download Success block. Without a success page the block returns visitors to its own page |
| Gated Download before Gravity Forms | On local and development sites only, the form posts to a stand-in handler that checks required fields and stores nothing, so the flow can be tested now |
| Statistics row and pull quote copy | Placeholders ("00%", "A short quote…") so no unsourced number reaches a page. Big numbers use the H2 font at 48px |
| Email CTA address | The email variation links to `mailto:` with no address; the editor adds it |

## October 15, 2026 (defaults chosen while building step 5)

| Question | Decision |
| :--- | :--- |
| Logo files | PNGs cut from the mockup at 1x (`assets/images/brand/`). Swap in SVGs when NSF sends them; they will look soft on high-density screens until then |
| Newsletter sign-up row | Part of the footer template part (pattern `nsf/newsletter-signup`), not a synced pattern post: a template part is already synced across the site, and a synced pattern's ID would differ between local and staging |
| Forms in patterns and parts | The NSF Form block places a form by its key (`forms/<key>.json`). Shortcodes do not run inside template parts, so the block replaces `[nsf_form]` there |
| Mobile menu breakpoint | Below 1100px the utility and main menus move into one menu button; the search icon stays in the bar. 781 and 600 header mockups are still to come |
| Social links | `#` until NSF confirms each profile URL |
| Breadcrumbs | Leave out Home (the logo links there). Added to the page and post templates now; archive, search and Resource templates add the block in steps 12 to 14 |

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
| Title band on search and 404 | Superseded in step 15: the gradient Title band |
| Posts per page on the blog and archives | 9 (three rows of cards); search stays at 10 |
| Blog-only search | The search field sends `post_type=post`, so it lands on the search template limited to posts |
| 404 link URLs | Typed from the site outline (`/national-programs/`, `/contact-us/` and so on); check them after the content migration in step 17 |
| FAQ accordion | Core Details blocks inside a Group with the FAQ block style; first question open, as in the wireframe (489:6). Every Details block in an FAQ group goes into one FAQPage JSON-LD per page. Core Accordion is not used because the spec names Details |
| Sponsor/Collaborator grid | Core Image blocks in a Group with the Logo grid block style (grid layout, 8rem minimum column). Each logo is contained in the same 5:3 box; the Image caption carries optional text such as an award and year. From the Drowsy Driving Prevention Week wireframe (341:150) |
| Resource breadcrumb | Sleep Health Resources / Resource Type (and its parents) / title, each type linking to the hub with `types=` set. The wireframe shows a page path (Research / NSF Research Reports); the spec's taxonomy trail wins |
| Breadcrumbs block scope (step 12) | Resources and pages. Posts and archives get their trail in step 5 |
| Resource title band | Superseded in step 15: the gradient Title band |
| Resource byline | New `nsf_byline` meta (credit line) followed by "Published Month YYYY" |
| Gated Resource download | Download button and file details are hidden until the Gated Download block (step 9) exists, so the file URL never reaches the page |
| Related Content eyebrow | Resource Type for Resources, "Article / Blog post" for posts (as in the hub), the top-level section for pages |
| Related Content with fewer than 3 picks | Resources sharing a topic with the current item fill the empty cards, then the newest Resources |
| Statistics row | One shared grid (`inc/statistics-grid.php`) of Statistic panels for the 2- and 4-across patterns (step 9) and the Resource layout (step 12) |

## Deferred

- Header Flag JavaScript location (needed for step 10)
- Copy for the 12 empty page docs (step 17)
- Zoho module and field mapping (step 16)
