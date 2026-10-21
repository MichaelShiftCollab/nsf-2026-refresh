# NSF 2026 Website Build Spec

Oct 14, 2026 · Michael

Live version with comments and the drawn site map: [https\://claude.ai/code/artifact/db46640b-5312-4e9a-8c7b-e49a5d7d4b7b](https://claude.ai/code/artifact/db46640b-5312-4e9a-8c7b-e49a5d7d4b7b)

## About this spec

This spec defines what the new NSF website is, where it lives and how it gets built, so a developer or Claude Code can build it without asking. It covers two things. The first is the **build setup**: stack, hosting, environments, repository, plugins, integrations and deployment. The second is the **product**: design tokens, content model, every template, block and pattern, forms, and the test each one has to pass.

The build plan says *how to sequence* the work in 19 steps. This spec says *what done looks like* for each piece. Where they disagree, this spec wins and the build plan gets updated.

**Sources**

- [NSF Implementation Plan 2026-10-14](https://drive.google.com/file/d/1Aw52mhkYWXwfoVLyXo9wO6zD1JXih0l4/view): feature requirements  
- [NSF Build Plan for Claude Code 2026-10-14](https://docs.google.com/document/d/1xLUyZYb3D1x7_9uQv3zbwMXVjj34Hp4x-XJk0YhhAg8/edit): build steps and mockup schedule  
- Figma [NSF-2026](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026): [Wireframe detailed](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=2-21), [Mockups](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-430), [Styling](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=362-2)

**Status labels used below**

| Label | Meaning |
| :---- | :---- |
| Final | A 1440 mockup exists; build and test against it |
| Provisional | Wireframe only; build the structure now and restyle when the mockup lands |
| Open | Needs a decision before it is built |

## Overview and scope

The new thensf.org is a fresh WordPress build: a new child theme, a new site plugin and migrated content. Nothing from the current theme carries over. Editors build pages from native blocks and NSF patterns, never from page builders or shortcodes.

**Goals**

- Make Sleep Health Resources the place people find NSF content, with search, facets and two views.  
- Give National Programs (Sleep Awareness Week®, Drowsy Driving Prevention Week®, Best Slept Self®) a reusable campaign system editors can swap by hand.  
- Route every lead form (newsletter, SleepMark®, Contact, Sponsorship, Toolkit, SleepTech® Network) through Gravity Forms into Zoho CRM.  
- Make FAQs and the Media Center readable by search engines and AI search through JSON-LD.

**In scope:** theme, plugin, all templates and patterns below, six forms, the Zoho connection, page migration, staging deploy and visual QA.

**Out of scope for this build:** a Sponsor post type (decided later, see Open questions), animation and fade-ins (TBD in the plan), parallax (none), and production launch steps such as DNS and redirects cutover. Redirect mapping is in scope under Content migration.

## Platform, hosting and environments

The site runs on WordPress with a block child theme of Frost, hosted on WP Engine. All custom code lives in one GitHub repository under Michael's account and deploys to WP Engine from there.

| Layer | Choice | Notes |
| :---- | :---- | :---- |
| CMS | WordPress, current release | Block editor and site editor only |
| Parent theme | Frost (WP Engine) | Installed, never edited |
| Child theme | `nsf` | Styles, templates, parts, patterns, fonts |
| Site plugin | `nsf` | Post types, taxonomies, custom blocks, REST endpoints, WP-CLI commands |
| Forms | Gravity Forms \+ Zoho CRM Add-On | License tier must include the Zoho add-on |
| CRM | Zoho CRM | One feed per form |
| Hosting | WP Engine | Staging first; production later |
| Code | GitHub, Michael's account | Repo name to be confirmed |
| Design source | Figma file `mVNfIISs9yQQurddJagkfU` | Read through the Figma MCP server |

**Environments**

| Environment | Where | Used for |
| :---- | :---- | :---- |
| Local | Developer machine or Claude Code cloud container (WSL works too) | Building and visual tests |
| Staging | WP Engine staging | Client review, Zoho tests, full visual QA |
| Production | WP Engine production | Launch, after client sign-off |

**Accounts needed before step 1:** GitHub repo, WP Engine staging access and SSH or Git push key, Gravity Forms license, Figma access, Zoho CRM API access (needed by step 16), and the Test Family and Open Sans font files.

## Repository structure and tooling

The repo holds only NSF's own code, docs, content exports and tests. WordPress core, Frost and third-party plugins are installed per environment and stay out of Git.

```
/
├─ CLAUDE.md                     project rules for Claude Code
├─ package.json                  build, start, lint, test:visual, mockups:pull
├─ docs/
│  ├─ implementation-plan.md     converted with pandoc -t gfm
│  ├─ build-spec.md              export of this spec
│  ├─ zoho-mapping.md, zoho-setup.md, deploy.md, visual-qa.md
├─ content/
│  ├─ pages/                     page docs from "NSF Website Pages"
│  ├─ content-plan.csv           CONTENT PLAN tab
│  ├─ site-outline.md            page tree (see Information architecture)
│  └─ migration-report.md
├─ wp-content/
│  ├─ themes/nsf/                style.css, theme.json, functions.php, parts/, templates/, patterns/, styles/, assets/fonts/
│  └─ plugins/nsf/               nsf.php, includes/, src/blocks/<name>/, build/, forms/*.json, cli/
└─ tests/visual/                 mockups.json, pages.json, mockups/, results/, Playwright + pixelmatch
```

**Rules for CLAUDE.md**

- Read `docs/implementation-plan.md` and this spec before building a feature.  
- Use theme.json tokens only. No hard-coded colors, sizes or font stacks.  
- Native blocks first. A custom block only where this spec lists one.  
- Blocks are built with `@wordpress/scripts` from `plugins/nsf/src/blocks` to `plugins/nsf/build`.  
- Commit after each build step passes its test.

**Visual test harness:** Playwright captures each entry in `pages.json` at 1440, 781 and 600 px. Pixelmatch compares it to the Figma export in `mockups/`. Default pass threshold is 10% mismatch, set per entry. Copy differences are ignored; layout, spacing, color and type are not. The HTML report shows screenshot, mockup and diff side by side.

## Plugins

The new site needs far fewer plugins, because the NSF plugin and native blocks replace most of the current ones. The list below is a proposal against the current site's 31 active plugins (as of 5/7/26). Please confirm it.

| Plugin | Proposal | Why |
| :---- | :---- | :---- |
| Gravity Forms \+ Zoho CRM Add-On | Keep | All forms and the CRM feed |
| Akismet | Keep | Form and comment spam |
| Redirection | Keep | Old-URL redirects from the content plan |
| SVG Support | Keep | Logo and icon SVGs |
| FluentSMTP | Keep | Reliable form notification email |
| MonsterInsights | Keep, or replace with a GA4 tag | Analytics; confirm with NSF |
| All in One SEO | Keep one SEO plugin | Titles and meta from the content plan; FAQ schema comes from the NSF plugin |
| Converter for Media | Keep | WebP and AVIF images |
| Yoast Duplicate Post, User Switching | Keep | Editor convenience |
| Advanced Custom Fields PRO | Drop | Block attributes and post meta cover it |
| Custom Post Type UI | Drop | Post types live in the NSF plugin |
| Genesis Custom Blocks | Drop | Custom blocks live in the NSF plugin |
| Accordions, WPB Accordion Menu, MHY Mobile Menu Injector | Drop | Native Details block and core Navigation |
| Contact Form 7 | Drop | Replaced by Gravity Forms |
| Popup Builder | Drop | Alert Banner and Header Flag replace it |
| Font Awesome | Drop | Icons ship as SVG in the theme |
| WPCode Lite | Drop | Snippets move into the NSF plugin |
| My Calendar | Open | Only if NSF still lists events |
| Better Search Replace, WordPress Importer, Import Export Menu | Migration only | Remove after launch |
| ManageWP Worker, Index WP MySQL For Speed, Plugin Notes Plus, WP Dashboard Notes, WP Hidden Password Protected Pages, WP Change Default From Email | Drop unless NSF uses them | WP Engine and FluentSMTP cover hosting and mail |

## Design system

Every value below becomes a theme.json token, and nothing in CSS may bypass it. Values are read from the Figma [Styling frame](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=362-219). Status: **Final**.

**Colors**

| Token | Name | Hex |
| :---- | :---- | :---- |
| `dark-blue` | Dark Blue | Read from swatch (not a Figma variable yet) |
| `primary-blue` | Primary Blue | \#00549E |
| `medium-blue` | Medium Blue | \#5A99D2 |
| `light-blue` | Light Blue | \#D4E5F3 |
| `lightest-blue` | Lightest Blue | \#F1F8FE |
| `primary-orange` | Primary Orange | \#F28411 |
| `medium-orange` | Medium Orange | \#F8C188 |
| `light-orange` | Light Orange | \#FEF3E7 |
| `gray` | Gray | \#707171 |
| `white` | White | \#FFFFFF |

**Section backgrounds** (Group block styles)

- Solids: Primary Blue, White, Lightest Blue, Light Orange.  
- Gradients: Primary Blue to Dark Blue, Light Blue to Light Orange, Light Blue to White, Light Orange to White.  
- Limited use: Announcement Bar (Medium Blue to Primary Blue) and Inner Page Heading (Primary Blue to Medium Blue to Primary Orange).

**Typography** (desktop sizes, px)

| Style | Font | Weight | Size / line height | Letter spacing |
| :---- | :---- | :---- | :---- | :---- |
| H1 | Test Family | 500 | 56 / 64 | 0 |
| H2 | Test Family | 500 | 48 / 56 | 0 |
| H3 | Open Sans | 600 | 32 / 40 | 0 |
| H4 | Open Sans | 400 | 32 / 40 | 0 |
| H5 | Open Sans | 700 | 24 / 32 | 8 |
| Eyebrow | Open Sans | 700 | 24 / 32 | 8 |
| Paragraph 1 | Open Sans | 400 | 32 / 40 | 0 |
| Paragraph 2 | Open Sans | 400 | 24 / 32 | 0 |
| Paragraph 3 (body) | Open Sans | 400 | 16 / 24 | 0 |
| Caption | Open Sans | 400 italic | 16 / 24 | 0 |
| Meta text | Open Sans | 400 | 14 / 20 | 0 |
| Button | Open Sans | 700 | 16 / 24 | 0 |

Test Family stands in for Klim's Family until Shift buys the license; swapping it must be a one-line font change. Fonts are self-hosted from `assets/fonts`. Mobile sizes use fluid type between 600 and 1440, down to sizes taken from the 600 mockups.

**Layout and breakpoints**

- Content and wide width: 1200 px, with 120 px side spacing at 1440\.  
- Design widths: 1440 (desktop), 781 (tablet), 600 (mobile). Every Final item must pass at all three.

**Components**

- Buttons, pill shaped: Primary is orange fill, hover turns to orange outline. Secondary is blue outline, hover turns to blue fill.  
- Image style "Frame": 72 px radius on two opposite corners.  
- Separator: Light Blue rule by default.

## Content model

The site has three content types: Pages, Posts (the Sleep Learning Zone® blog) and a new Resource post type. All are registered in the NSF plugin and exposed to the REST API.

**Post types**

| Type | Slug | Supports | Used for |
| :---- | :---- | :---- | :---- |
| Page | `page` | Core | All site pages, nested by the outline |
| Post | `post` | Core, categories, tags | Sleep Learning Zone® articles |
| Resource | `resource` | Title, editor, author, excerpt, featured image, revisions | Reports, polls, infographics, PDFs |

**Taxonomies**

| Taxonomy | Slug | Type | On | Drives |
| :---- | :---- | :---- | :---- | :---- |
| Topic | `topic` | Hierarchical | Resource, Post | Hub Topic facet and table column, card meta line |
| Resource Type | `resource_type` | Hierarchical | Resource | Hub Type facet and column, breadcrumbs |
| Audience | `audience` | Flat | Resource, Post | Hub Audience facet and column |
| Resource Tag | `resource_tag` | Flat | Resource | Search filters only |
| Category | `category` | Core | Post | Blog eyebrow and topic archives |

Topic is new in this spec, as Michael decided. Its starting terms are an open question; a sensible seed is the current blog categories (for example Sleep Disorders).

**Resource meta**

| Field | Key | Notes |
| :---- | :---- | :---- |
| Attached file | `nsf_file_id` | Media library attachment ID |
| File type, size, pages | computed | Helper returns e.g. "PDF · 2.4 MB · 28 pages" |
| Subtitle | `nsf_subtitle` | Shown in the title band |
| Gated | `nsf_gated` | When on, the download goes through the Gated Download form |

A Sponsor post type is not built now. The plan says to decide once NSF says what top-tier sponsors need to show.

## Information architecture

The page tree follows the NSF Web Outline V2 and the content plan index (00 to 80). The main menu carries National Programs, Sleep Health Resources, Research, SleepTech® and SleepMark®; About Us, Contact and Media Center sit in the utility menu. Only Home and Sleep Health Resources have final mockups.

- **Home (00)**  
  - **National Programs (10):** Sleep Awareness Week®; Drowsy Driving Prevention Week® (child: Drowsy Driving Prevention Resources); Best Slept Self®; Reshaping Employee Wellness; Key Issues  
  - **Sleep Health Resources (20):** Sleep Learning Zone® (blog), with posts, topic archives and Resource singles  
  - **Research (30)**  
    - NSF Sleep Measures: Sleep Health Index®, SST, BSSQ  
    - NSF Publications: Foundations of Sleep Health™, Sleep Health journal, Guidelines, Position Statements  
    - NSF Research Reports: Sleep in America® Polls, Drowsy Driving Reports, Understanding Sleep Apnea, Sleep Health During a Presidential Election, Sleep Health and the COVID-19 Pandemic, Topical Reports  
  - **SleepTech® (40):** NSF / CTA / ANSI Standards; SleepTech® Network (child: SleepTech® Network Membership); SleepTech® Award  
  - **SleepMark® (50):** SleepMark® Application  
  - **Media Center (60)**  
  - **About Us (70):** Boards and Committees; Lifetime Achievement Award; Sponsorship Opportunities  
  - **Utility pages (80):** Contact Us; Terms of Use; Copyright; Privacy Policy

Page numbers match the doc titles in NSF Website Pages, so migration can set each page's parent from its number. This tree is saved to `content/site-outline.md` in the repo.

## Global parts

These appear on every template. Header, sign-up row and footer have 1440 mockups in [Shared components](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=464-2); their 781 and 600 versions and the alert banner are still to come.

| Part | Status | Contents and behavior | Done when |
| :---- | :---- | :---- | :---- |
| Alert Banner (custom block) | Provisional | Editable text and link, on/off toggle, Announcement Bar gradient, sits above the header. Example: "Drowsy Driving Forum | October 29 in Washington, DC | Register Now" | Turning it off in the editor removes it site-wide |
| Header (template part) | Final at 1440 | Concept 1A logo; utility menu About Us, Contact, Media Center, search icon; main menu National Programs, Sleep Health Resources, Research, SleepTech®, SleepMark®; mobile menu per the 600 mockup | Visual test passes at all three widths |
| Header search | Provisional | Search icon opens a field in the header; Enter submits to the search page | Typing and pressing Enter lands on results |
| Newsletter sign-up row (synced pattern) | Final at 1440 | Eyebrow, heading, short text, email field, Sign up button, "We'll never share your email address." Uses the Newsletter form | Present above the footer on every template |
| Footer (template part) | Final at 1440 | Logo, tagline "The leading voice of sleep health", Contact Us, Terms of Use, Copyright, Privacy Policy, 35th anniversary seal, disclaimer, copyright, social icons for Instagram, Facebook, X, LinkedIn, YouTube, Bluesky | Visual test passes at all three widths |
| Breadcrumbs (block) | Provisional | Page ancestry on pages, posts and archives; Resources show their taxonomy, with middle terms linking to the hub pre-filtered | Each link resolves; Resource terms open the filtered hub |
| Header Flag (custom block) | Provisional | Tab that hangs from the header after scroll; page-level on/off, label, link to an anchor, a media-library PDF or a page. Example: "Drowsy Driving Forum" on DDPW | Each link type works; shows after scroll |

## Blocks and patterns

The NSF plugin ships 13 custom blocks; everything else is a pattern of core blocks in the child theme. Wireframes for items without mockups are on the [Plan items sheet](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=489-2).

**Custom blocks (NSF plugin)**

| Block | Status | Fields and behavior |
| :---- | :---- | :---- |
| Alert Banner | Provisional | See Global parts |
| Header Flag | Provisional | See Global parts; port the current site's JavaScript, made page-agnostic |
| Breadcrumbs | Provisional | See Global parts |
| Content Card | Final (featured image), Provisional (other two) | Variations: Outline and icon, Navy fill, Featured image. Fields: eyebrow, title, excerpt, link, image or icon, meta line (Topic · Audience · Date). Works with a picked post or inside a Query Loop |
| Featured Resources | Final | Editor picks 3 items; shows featured image cards |
| Resource Filter Controls | Final | Search box; Topic, Audience, Type facets from terms with posts, with counts; \+/– collapse; "Show more" after 6; active chips with "Clear all"; sort (default newest); result count; Cards/Table toggle kept in a cookie |
| Resource Results | Final | Cards view or Table view (Title, Type, Topic, Audience, Date, each sortable with an arrow); AJAX pagination; URL keeps filter state |
| Related Content | Provisional | Editor picks 3 posts or pages; text items (top rule, type eyebrow, title, Read more) as in the mockup |
| General CTA Row | Provisional | Heading, text, one button to a page or a mailto |
| Flexible CTA with Link | Provisional | Heading, copy, button link (e.g. donation page) |
| Flexible CTA with Form | Provisional | Heading, copy, Gravity Form picker |
| Gated Download | Provisional | Cover, title, file details, form picker. Submit leads to a success page with cover and download button. File URL is never in the page source before submit |
| Home Hero | Final | H1 over six rotating images, auto-advance, no indicators, fits above the fold at 1440 × 800, stops under prefers-reduced-motion |

**Patterns (child theme)**

| Pattern | Status | Notes |
| :---- | :---- | :---- |
| Card grid, 3-up and 4-up | Final (featured image) | One per card variation |
| Resource Hub | Final | Intro, Featured Resources, filter controls, results |
| Campaign band × 3 | Open | Best Slept Self® (A, B or C still to choose), Drowsy Driving Prevention Week®, Sleep Awareness Week®; editor swaps by hand |
| Contact Us CTA | Provisional | Uses the Contact Us form |
| Statistics row | Provisional | Big-number grid, 2 or 4 across |
| Pull quote | Provisional | Block style on core Pullquote |
| Participation Toolkit | Provisional | Heading, text, Toolkit form |
| FAQ accordion | Provisional | Core Details blocks; keyboard accessible; outputs FAQPage JSON-LD |
| Sponsor/Collaborator grid | Provisional | Tiered rows or untiered grid; logos in a fixed box; add, reorder, remove |
| Title band | Provisional | Breadcrumb, H1, subtitle; Inner Page Heading gradient |
| Poll entry | Provisional | Cover on the left, works without a cover |
| Expert card, Press mention, Press release list | Provisional | Media Center sections; press releases use "Load more" |

## Templates and pages

Two pages are Final (Home and Sleep Health Resources); the other twelve are built from wireframes and restyled when mockups arrive. Each one is done when its visual test passes at 1440, 781 and 600, with copy differences ignored.

| Template or page | Status | Figma | Sections and rules |
| :---- | :---- | :---- | :---- |
| Home (front-page) | Final at 1440 | [Mockup](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=464-67), [wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=101-2) | Home Hero; What we do; campaign band; 3 editor-picked resource cards; Research row and 3 panels; For business (SleepMark® panel with SleepMark form, SleepTech® panel); featured collaboration |
| Sleep Health Resources | Final | [Cards](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-431), [table](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-681), [781](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=182-2), [600](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=187-185) | Resource Hub pattern. Test states: cards, table, two filters with chips. Filtering never reloads the page |
| Resource single | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=229-2) | Title band with breadcrumb, H1, subtitle, byline; overview (cover, download, file details, summary); Statistics row for key findings; Related Content; disclaimer |
| Search results | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=211-2) | Title band with prefilled search; "42 results for …"; multi-select filter buttons from terms with results; pages show site section as eyebrow, posts and Resources show type; dates on posts only; pagination |
| Sleep Learning Zone® archive | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=215-2) | H1, intro, blog-only search, "96 posts", 3-column cards (category, title, date), pagination |
| Topic archive (category) | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=219-2) | Breadcrumb, H1, description, blog search, count, cards without category eyebrow, pagination |
| 404 | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=220-2) | Title band, short copy, site search, "Where to go instead" in three columns (9 links) |
| National Programs (parent) | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=155-2) | Outline-and-icon card 3-up to child pages |
| Sleep Awareness Week® (child) | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=155-103) | Featured image 4-up grid, Participation Toolkit |
| Drowsy Driving Prevention Week® | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=339-2) | Header Flag to the forum section; resource grid; sponsor grid |
| Drowsy Driving Prevention Resource Center | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=226-2) | Event, blog and download cards |
| SleepTech® Network Membership (grandchild) | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=207-2) | Membership application form; FAQ accordion |
| Sleep in America® Polls | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=224-2) | Poll entry pattern, curated list, additional topics |
| Media Center | Provisional | [Wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=488-2) | In order: title band with media contact box; key facts (Statistics row); experts; press mentions; press releases with "Load more" |
| All other pages | Provisional | None | Default page template: title band plus core blocks and existing patterns |

## Forms and Zoho CRM

The site has six Gravity Forms, defined as JSON in `plugins/nsf/forms` and created by `wp nsf forms import`. Running the import twice must not duplicate a form. Each form gets one Zoho CRM feed.

| Form | Fields (\* required) | Used on | Zoho module |
| :---- | :---- | :---- | :---- |
| Newsletter sign-up | Email\* | Sign-up row, every page | Open |
| SleepMark® lead | Name, Work email, Company | Home | Open |
| Contact Us | First Name\*, Last Name\*, Email Address\*, Phone\*, Business or Organization Name, Title, I'd like to talk about...\* (4 options), Tell us why you'd like to get in touch…\* | Contact Us CTA | Open |
| Sponsorship Prospectus | Company\*, Website, First Name\*, Last Name\*, Title\*, Email\*, I'm interested in\* (5 checkboxes), Tell us why you'd like to get in touch | Flexible CTA with Form, Gated Download | Open |
| Participation Toolkit | Name, Email, Organization, How you plan to use it | Sleep Awareness Week® | Open |
| SleepTech® Network Membership Application | From the [wireframe](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=207-2) | SleepTech® Network Membership | Open |

**Integration rules**

- The Gravity Forms Zoho CRM Add-On sends entries; no custom API code.  
- The module and field mapping for each form lives in `docs/zoho-mapping.md`, supplied by NSF or Shift.  
- Feed settings are exported so they can be re-applied on staging and production.  
- Done when one test submission per form lands in the right Zoho module with every mapped field filled, and the test records are deleted afterwards.

## SEO, structured data, accessibility, performance

The plan names structured data explicitly; the accessibility and performance targets below are proposed defaults for Shift to confirm.

**SEO and structured data**

- SEO title (60 to 80 characters) and meta description (under 156\) come from the content plan for each page.  
- FAQ sections output FAQPage JSON-LD that matches the visible questions and answers and passes Google's Rich Results Test.  
- The Media Center outputs JSON-LD for the organization and its experts (Person), so AI search can find them. Proposed; the plan calls for schema there but does not name the types.  
- Each page has one H1, then H2 and H3 in order.

**Accessibility (proposed: WCAG 2.2 AA)**

- Facets, accordions, header search, mobile menu and the Cards/Table toggle work by keyboard and announce their state.  
- The Home Hero stops rotating under prefers-reduced-motion.  
- Text on every background token meets AA contrast. Check orange buttons with white text in particular.

**Performance (proposed)**

- Lighthouse performance 90 or higher on mobile for Home and Sleep Health Resources on staging.  
- Fonts preloaded and served as WOFF2; images in WebP or AVIF with set sizes.

## Content migration

Page copy comes from the Google Docs in [NSF Website Pages](https://drive.google.com/drive/folders/1H8wiaZXujn8ubgcp7juqV52xP3o5jSYV), tracked in the CONTENT PLAN tab of [NSF Website Content Sheets](https://docs.google.com/spreadsheets/d/1J6mCbs_Ff8Pn2TEYZbhfuL-43dZPO2MM7OEyUvXD5nQ/edit). The folder holds 42 page docs, and about 12 of them are still empty (Research, NSF Publications, Best Slept Self, Topical Reports and others).

1. Export each doc to `content/pages/` and the CONTENT PLAN tab to `content/content-plan.csv`.  
2. Convert to HTML with pandoc, keeping headings, links and lists.  
3. Map each page onto its patterns, or core blocks where it has no mockup. Buttons and form labels become Button blocks and form placements.  
4. Create or update each page by WP-CLI: title, slug from New URL, parent from the outline, meta from the content plan. Re-running updates pages and never duplicates them.  
5. Fill the REDIRECTS tab (old URL to new URL) and import it into Redirection.  
6. Write `content/migration-report.md`: each page, the pattern used, and anything that did not map.

**Not covered by the page docs:** existing Sleep Learning Zone® posts and Resources. Proposed default: a WordPress export (WXR) of the current site, imported and re-tagged with Topic, Audience and Resource Type.

**Done when** the report lists every row in the content plan and five pages without mockups pass a browser spot-check.

## Deployment and QA

Code deploys from GitHub to WP Engine; only the `nsf` theme and `nsf` plugin go up, without `node_modules` or source maps.

- **Deploy:** the WP Engine GitHub Action on pushes to `main` deploys to staging. Production deploys are manual, after client sign-off. Steps go in `docs/deploy.md`.  
- **Data:** the database and uploads move local to staging once, with URL replacement. After that, staging content is edited on staging.  
- **On staging after each data move:** run `wp nsf forms import`, re-apply the Zoho feeds, run `wp nsf seed --delete`.  
- **Visual QA:** the harness runs every `pages.json` entry against staging at all three widths. Failures are grouped by cause (spacing, type, color, layout, copy only) and fixed, except copy-only ones. Whatever remains goes in `docs/visual-qa.md` with the reason.  
- **Release gate:** every comparison passes or is logged as copy only; one test submission per form reaches Zoho; staging shows the `nsf` theme active and six forms.

## Open questions and decisions

**Decided (October 14, 2026, Michael)**

| Decision | Outcome |
| :---- | :---- |
| Stack | WordPress, Frost child theme, NSF plugin, Gravity Forms, WP Engine |
| Pages without mockups | Spec and build from wireframes, marked Provisional |
| Topic facet | New hierarchical Topic taxonomy |
| Spec format | Shared doc, with this copy in 04\_Development |
| Repository | NSF 2026 Refresh (`nsf-2026-refresh`), under Michael's GitHub account |
| Best Slept Self® band | Option A |
| Taxonomy terms | Terms from the mockups and wireframes (`content/taxonomy-terms.json`) |
| Zoho CRM | Deferred |
| Plugin list | Keep/drop proposal accepted as is |
| Everything else | Defaults in `docs/decisions.md`, or deferred |

**Open**

- [ ] Best Slept Self® band: Option [A](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-60), [B](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-74) or [C](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=471-88)? Needed before the Home build.  
- [ ] Starting terms for the Topic taxonomy.  
- [ ] Source for existing blog posts and Resources (proposed: WXR export of the current site).  
- [ ] Where the current Header Flag JavaScript lives.  
- [ ] Repository name.  
- [ ] Zoho module and field mapping per form.  
- [ ] Plugin list: confirm the keep and drop proposal, the SEO plugin, MonsterInsights or GA4, and My Calendar.  
- [ ] Dark Blue hex: add it as a Figma variable.  
- [ ] What top-tier sponsors need to show, which decides whether a Sponsor post type is built.  
- [ ] Accessibility and performance targets: confirm WCAG 2.2 AA and Lighthouse 90\.  
- [ ] Copy for the 12 empty page docs.  
- [ ] Mockups still to come: 781 and 600 for Home and the shared parts, alert banner, content cards, campaign bands, CTAs, Header Flag, FAQ, sponsor grid, Resource single, search, archives, 404 and the seven interior pages.