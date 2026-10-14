# Decisions

Answers to the open questions in the build spec and build plan. Newest first.

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
| Featured image card image | 16:9 crop and 24px gap to the text, from the Resources mockup. The Home mockup's cards use a shorter image and a 40px gap; Resources wins until a designer says otherwise |
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

## Deferred

- Header Flag JavaScript location (needed for step 10)
- Copy for the 12 empty page docs (step 17)
- Zoho module and field mapping (step 16)
