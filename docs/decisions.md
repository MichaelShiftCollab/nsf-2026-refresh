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

## Deferred

- Header Flag JavaScript location (needed for step 10)
- Copy for the 12 empty page docs (step 17)
- Zoho module and field mapping (step 16)
