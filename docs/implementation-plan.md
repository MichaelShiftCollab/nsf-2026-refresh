# Implementation Plan

## National Sleep Foundation

Updated October 14, 2026. Adds the wireframe elements that were missing from the previous plan and the decisions made while reviewing the wireframes. Items added in this version are marked New.

Wireframes: [<u>Wireframe detailed</u>](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=2-21), including the "Plan items — added wireframes" sheet and the Media Center page. Mockups: [<u>Mockups</u>](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=154-430). Styling: [<u>Styling guide</u>](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=362-2).

## Summary

## Major Features

### Content Types **DONE**

- Page

- Post

- Media: PDFs, photos, icons

#### Custom Post Types (CPTs)

Resource (see Resource Hub below for use)

- Taxonomy: Resource Type (hierarchical), Resource Tag (tag, nonhierarchical), Audience (tag)

- Capabilities

  - Post date

  - Content

  - Author

  - Featured image/thumbnail

  - Attachment

- Examples: Report with infographic and PDF; Infographic (no report)

Sponsor – If the client provides information associated with certain top tier sponsors, we’ll decide if it’s worth creating a CPT for them to keep all the information and logo together (6/23/2026)

### Resource Hub **DONE**

A centralized location for viewing post content on the site is called the Sleep Health Resources Hub. There is a featured post display at the top and then a full-featured posts search. Along with the normal term search box, there are filters that are prepopulated with the tags and categories attributes to posts, which one or many may be selected. There is a sort box and a card/table toggle for organizing the results display. The filter parameters being applied to the search are displayed with toggleboxes at the top of the results display, along with a “Clear all” button. There is a Cards view and a Table view for the results.

The featured banner is a block where we pick 3 posts to display as featured, converged on the related posts/content.

Define the CPT within the site-specific plugin, named “NSF”, which will hold the functions and Wordpress definitions for the revamped site. Define the tags and categories within this CPT definition.

The block display should be a two part affair, consisting of a custom block Resource Filter Controls using a custom php function to reach the resource CPT and regular posts, and filter the display below it. Then, a pattern is made starting with this custom block, followed by the query loop it filters, using AJAX calls to filter and redisplay the query loop.

Filters are populated into the controls via an initial page query for tags and categories that have associated posts, or, we display all and have a number alongside in parentheses that count the number of posts with that tag from the current results scope. Clicking the filters adds or removes a parameter to the AJAX post. Toggleboxes at the top of the display remove these parameters as well.

The sort box adds a parameter to the AJAX post, with the default value of querying by time descending.

The Cards/Table display toggles a class on the results display to toggle between two different flex-grid displays for the content. This is default cards view and can be made to be table view. This selection is tracked via a cookie.

In the table view, results sort ascending or descending by Title, Type, Topic, Audience or Date, with an arrow denoting ascending or descending next to each column title, which is also the control to initiate the sort. This matches the table view on the Mockups page.

**Added from wireframes (New):**

- The filter facets (Topic, Audience, Type) expand and collapse with a +/– control. Long lists show six options and a “Show more” link.

- The Topic facet is populated from a taxonomy.

- A result count sits above the results (“128 results”) and updates as filters change.

- Each card shows a meta line under the title: Topic · Audience · Date.

- Pagination below the results works with the AJAX filtering.

**Deliverables:**

- featured post block

- custom post type, (see above)

  - with defined tags/categories

- custom function lending the controls to the results display and AJAX post to retrieve results

- card/table toggle and associated flex-grid styles to view the results differently, cookie to track user selection

- ascending/descending results sort in the table view for Title, Type, Topic, Audience and Date

- query loop pattern for the display of the resources

- collapsible facet groups with “Show more”

- result count and AJAX-aware pagination

### Sleep in America Polls page **DONE**

The Sleep in America Polls page will be constructed of a number of custom patterns and styled blocks. A pattern for the most recent polls places the cover image on the left, with normal blocks and some custom styles where necessary for the SiA poll archive. The pattern also works without a cover image, as with the 2024 entry.

**Deliverables:**

- Some styling for the additional topics section

- Editor curated list of Polls and whatever else we want on this page

### Resource CPT Single **DONE**

This is a single post view. Linked breadcrumbs at the top of the post show the taxonomy. The rest of this is editor content with a couple patterns made to facilitate this. There’s a related content query loop or block.

Site breadcrumbs function for the site should be extended such that single posts of type Resource show a taxonomical hierarchy. Middling terms direct to the archive with search filter parameters prepopulated to display the relevant category. Midpage content are custom patterns which reflect the featured image and associated file. At the bottom, the related content block needs to either allow us to set 3 posts or pages to display, or is determined programmatically and delivered by a query loop.

**Added from wireframes:**

- File details sit under the download button: file type, size and page count (ex: “PDF · 2.4 MB · 28 pages”).

- Related content can mix types (ex: a news release, a page, a Sleep Learning Zone post). Each item shows its type as an eyebrow.

- Related content uses content cards with featured image.

**Deliverables:**

- Site breadcrumbs extended to display taxonomy on resource posts

- Custom patterns

- A custom block displaying 3 picked posts or pages - to be determined by the client

### Search Page **DONE**

An extended Wordpress search results page. Notable features include a custom pattern for the results query loop, and a taxonomy filter which populates with the categories, tags and taxonomies that have posts associated with them. The results display is particular to the result given.

Create the template in the editor for the results view, you can tie the results display to the search box by configuring the Query Loops block to “use current search query”. The taxonomy filter is default unselected and is a series of clickable selectors that add parameters to the search. More than one can be selected.

The results display treats different result types differently - notably, posts have their publish date displayed, where that is not displayed for pages. Results have an eyebrow categorizing their function within the site’s information architecture. Pages show their site section as their eyebrow. Posts and resources show their post type.

**Added from wireframes (New):**

- The title band holds the search field and button, prefilled with the current query.

- A result count sits above the filters (“42 results for “drowsy driving””).

- Pagination below the results.

**Deliverables:**

- Custom Search Results template with custom pattern and some css for it to match the mockup

- Results template accounting for different post type and exploration to determine that treatment

- Taxonomy filter buttons that are populated by pulling categories, tags and taxonomies with posts associated, which add a parameter to the search to filter by the given taxonomy or taxonomies (multi-select)

### Header Flag **DONE**

Scroll-to sticky header button for download CTAs. This needs to be editable to toggle visibility on a page, change the language, and change the link to either an anchor link, a PDF download from the media library, or a separate page. To be built as a custom block with page-level controls. Javascript ported over from existing implementation and rewritten to be page-agnostic.

**Added from wireframes (New):**

- Example on the Drowsy Driving Prevention Week® page: a “Drowsy Driving Forum” tab that hangs from the header and jumps to the forum section.

**Deliverables:**

- custom block with editable language/link,

- javascript to power the thing,

- any needed stylistic updates.

### General Call to Action **DONE**

A generally usable CTA row, styled and including a button for jumping to a form page or sending an email. This is a separate block from the Flexible CTA with link.

**Added from wireframes (New):**

- Two versions are wireframed on the “Plan items — added wireframes” sheet: the button goes to a form page, or the button sends an email.

### Gated Download **DONE**

A means of gathering visitor information in return for downloading a resource PDF (survey results, report).

**Added from wireframes (New):**

- Used for the Sponsorship Prospectus and the survey PDFs.

- Example form, from the Sponsorship Opportunities page: Company\*, Website, First Name\*, Last Name\*, Title\*, Email\*, I’m interested in\* (Sleep Awareness Week®, Drowsy Driving Prevention Week®, SleepTech Network®, Custom Partnership Opportunities, Other; check all that apply), Tell us why you’d like to get in touch.

- The form and the success page are wireframed on the “Plan items — added wireframes” sheet.

**Deliverables:**

- Custom block with the Gravity Form -\> success page

- Success page with download

### Sponsor/Collaborator Grid **DONE**

Business logos with optional accompanying text (award winner and year for example).

- Option to display tiered rows of logos

- Option to display untiered grid of logos

Need to be able to easily add, rearrange, and remove logos.

Client question: What additional info would you like to show for top tier sponsors?

**Deliverables:**

- unsynced patterns for Sponsors, Collaborators, and any other logo clouds by collection,

- specifically styled to allow for a flow layout that keeps height and width standardized in some way (we discussed this a bit, need to land on an appropriate approach).

### Media Center **DONE**

Include key facts about the information, notable press mentions, information about NSF’s experts available for interview, past press releases.

New content: everything beyond press releases

**Added from wireframes (New):**

- Page sections, in order, per the Media Center wireframe:

  - Title band with an intro and a media contact box (name, title, email, phone)

  - Key facts, using the Statistics row

  - Experts available for interview: cards with photo, name, title and organization, and topics

  - Press mentions: outlet, date, headline and a link to the story

  - Press releases: date, title and a link, with a “Load more” button

**Deliverables:**

this probably needs a JSON-DL schema for reliable search to match the FAQs, posted informative media is expert-denoting in agentic search

### FAQ **DONE**

Robust FAQ pattern for building different FAQ sections in different locations across the site. Structured data, parsable by search engines and agentic search. Content additionally structured in JSON-LD schema for reliable agentic search.

**Added from wireframes (New):**

- The SleepTech Network FAQs are copied from the current site. Questions expand and collapse.

**Deliverables:**

- async FAQ pattern,

- JSON-LD schema generated for the content after it is created. The schema requires to match the content in the FAQ so we will need that content. This can be handled with a plugin like [<u>https://wordpress.org/plugins/structured-content/</u>](https://wordpress.org/plugins/structured-content/) or perhaps Yoast

### Alert Banner **NEW**

An optional banner above the header for time-sensitive announcements, with a link (ex: “National Sleep Foundation’s Drowsy Driving Forum \| October 29 in Washington, DC \| Register Now”). Editors can change the text and link and turn the banner on or off. It uses the Announcement Bar gradient (Medium Blue \> Primary Blue).

### Home Hero **NEW**

H1 with rotating images, like the current thensf.org home hero but shorter, so it fits above the fold in a 1440 × 800 viewport. Six images that advance automatically. No slide indicators.

### Header Search **NEW**

The search icon in the utility menu opens a search field in the header. Submitting goes to the Search results page.

### Newsletter Sign-up Row **NEW**

The “Stay Connected” row above the footer on every page: eyebrow, heading, short text, an email field with a Sign up button, and the line “We’ll never share your email address.”

### Forms **NEW**

All forms are Gravity Forms. This includes the newsletter sign-up, the SleepMark lead form on Home (Name, Work email, Company), the Sleep Awareness Week® Participation Toolkit, the SleepTech® Network Membership Application, the Contact Us CTA, the Flexible CTA and the Gated Download.

### Sleep Learning Zone Archive **NEW**

Blog archive template: H1 and intro, a search box limited to the Sleep Learning Zone, a post count (“96 posts”), a 3-column grid of post cards (category eyebrow, title, date) and pagination.

### Topic Archive **NEW**

Category archive template (ex: Sleep Disorders): breadcrumb (Sleep Learning Zone / topic), H1, category description, Sleep Learning Zone search box, post count, post cards without the category eyebrow, and pagination.

### 404 Page **NEW**

Title band with H1, a short line of copy, a site search field and button, and “Where to go instead” links in three columns: Sleep Health Resources, Sleep Learning Zone®, National Programs, Research, SleepTech®, SleepMark®, About Us, Media Center, Contact Us.

## Web Styling Details

### Brand **NEW**

Brand guide: [<u>Styling guide</u>](https://www.figma.com/design/mVNfIISs9yQQurddJagkfU/NSF-2026?node-id=362-2&p=f&t=DaQnvizrvJY7xEKt-0)

### Fade Ins & Animation **NEW**

TBD

### Backgrounds **NEW**

See styling guide

**Added from wireframes (New):**

- Solids: Primary Blue, White, Lightest Blue, Light Orange.

- Gradients: Primary Blue \> Dark Blue, Light Blue \> Light Orange, Light Blue \> White, Light Orange \> White.

- Limited-use gradients: Announcement Bar (Medium Blue \> Primary Blue) and Inner Page Heading (Primary Blue \> Medium Blue \> Primary Orange).

### Parallax & Active Backgrounds **NEW**

None

### Font Licensing **NEW**

- Family font ([<u>https://klim.co.nz/fonts/family/</u>](https://klim.co.nz/fonts/family/?srsltid=AU7gw4WCuBfdGefbJAEYxncHxwqM5Bv30g6XEQbj2BgC2NqAWVE5JV4_#information))

**Added from wireframes (New):**

- Open Sans, used for H3–H5, eyebrows and body text in the styling guide. Free to use (Google Fonts).

### Buttons **NEW**

- Primary: orange fill; hover changes to an orange outline.

- Secondary: blue outline; hover changes to a blue fill.

### Image Frames **NEW**

72px rounded corners on opposite corners of the frame.

### Rules **NEW**

Light Blue.

## Custom Blocks & Patterns

### Blocks **NEW**

- Featured Content Cards:

  - Content cards with outline and icon (ex: links to main parent pages). Used for the National Programs 3-up.

  - Content cards with navy fill (ex: links to related content child pages). Wireframed on the “Plan items — added wireframes” sheet.

  - Content cards with featured image (ex: links to blog posts). Used for the Home Sleep Health Resources 3-up and research panels, the Sleep Awareness Week® 4-up grid, the Drowsy Driving Prevention Resource Center event, blog and download cards, the Drowsy Driving Prevention Week® resource grid and Resource related content.

  - The Home Sleep Health Resources cards are picked by an editor. The other card sets are query loops.

- Callouts:

  - Pull quote row (standard block editor block)

  - Statistics row: big-number grid (ex: Resource Key findings, Media Center Key facts)

- CTAs:

  - Contact Us CTA with Gravity Form. Fields from the current Contact page: First Name\*, Last Name\*, Email Address\*, Phone\*, Business or Organization Name, Title, I’d like to talk about...\* (Business or educational partnerships; Sleep research, methodologies, and data; Sleep health information for healthcare professionals; Other), Tell us why you’d like to get in touch…\*

  - Flexible CTA with Gravity Form (ex: Sponsorship Prospectus form on the Sponsorship Opportunities page)

  - Flexible CTA with link (ex: links to donation page)

- Body Content:

  - Accordions (ex: FAQs, pulled over as the Robust CTA pattern from bottom of [<u>https://www.thensf.org/sleeptech-network/</u>](https://www.thensf.org/sleeptech-network/))

### Patterns **NEW**

- Header

  - Logo; utility menu (About Us, Contact, Media Center, search); main menu (National Programs, Sleep Health Resources, Research, SleepTech®, SleepMark®) (New)

- Footer

  - Logo and tagline (“The leading voice of sleep health”); utility links (Contact Us, Terms of Use, Copyright, Privacy Policy); 35th anniversary seal; disclaimer; copyright; social icons for Instagram, Facebook, X, LinkedIn, YouTube and Bluesky (New)

- Breadcrumbs

- Sponsor/Collaborator grid (brought over as a pattern based on the existing custom block on [<u>thensf.org</u>](http://thensf.org) [<u>Drowsy Driving Prevention 2026 - National Sleep Foundation</u>](https://www.thensf.org/drowsy-driving-prevention/) )

- Campaign band (New): eyebrow, H2, text, button and image. Three versions: Best Slept Self® (default), Drowsy Driving Prevention Week® and Sleep Awareness Week®. An editor swaps in the campaign version by hand before and during each campaign.

- Participation Toolkit (New): heading and text with a Gravity Form (Name, Email, Organization, How you plan to use it). Used on the Sleep Awareness Week® page.

# Plug-ins list

## Active plugins as of 5/7/26

Accordions

Advanced Custom Fields PRO

Akismet Anti-spam: Spam Protection

All in One SEO

Better Search Replace

Contact Form 7

Converter for Media

Custom Post Type UI

FluentSMTP

Font Awesome

Genesis Custom Blocks

Google Analytics for WordPress by MonsterInsights

Gravity Forms

Import Export Menu

Index WP MySQL For Speed

ManageWP - Worker

MHY Mobile Menu Injector

My Calendar - Accessible Event Manager

Plugin Notes Plus

Popup Builder

Redirection

SVG Support

User Switching

WordPress Importer

WP Change Default From Email

WP Dashboard Notes

WP Hidden Password Protected Pages

WPB Accordion Menu or Category

WPCode Lite

Yoast Duplicate Post

**Accordions**

Fully responsive and mobile-ready accordion grid for WordPress.

Version 2.3.23 \| By PickPlugins

**Advanced Custom Fields PRO**

Customize WordPress with powerful, professional, and intuitive fields.

Version 6.8.0.1 \| By WP Engine

**Akismet Anti-spam: Spam Protection**

Used by millions, Akismet is quite possibly the best way in the world to protect your blog from spam. Your site is fully configured and being protected, even while you sleep.

Version 5.7 \| By Automattic - Anti-spam Team

**All in One SEO**

SEO for WordPress. Features like XML Sitemaps, SEO for custom post types, SEO for blogs, business sites, ecommerce sites, and much more. More than 100 million downloads since 2007.

Version 4.9.6.2 \| By All in One SEO Team

**Better Search Replace**

A small plugin for running a search/replace on your WordPress database.

Version 1.4.10 \| By WP Engine

**Contact Form 7**

Just another contact form plugin. Simple but flexible.

Version 6.1.5 \| By Rock Lobster Inc.

**Converter for Media**

Speed up your website by using our WebP & AVIF Converter. Optimize images and serve

Version 6.5.5 \| By matt plugins

**Custom Post Type UI**

Admin UI panel for registering custom post types and taxonomies

Version 1.19.1 \| By WebDevStudios

**FluentSMTP**

The Ultimate SMTP Connection Plugin for WordPress.

Version 2.2.95 \| By FluentSMTP & WPManageNinja Team

**Font Awesome**

The official way to use Font Awesome Free or Pro icons on your site, brought to you by the Font Awesome team.

Version 5.1.4 \| By Font Awesome

*There is a new version of Font Awesome available. View version 5.1.5 details or update now.*

**Genesis Custom Blocks**

The easy way to build custom blocks for Gutenberg.

Version 1.7.2 \| By Genesis Custom Blocks

*There is a new version of Genesis Custom Blocks available. View version 1.7.3 details or update now.*

**Google Analytics for WordPress by MonsterInsights**

The best Google Analytics plugin for WordPress. See how visitors find and use your website, so you can keep them coming back.

Version 10.1.3 \| By MonsterInsights

**Gravity Forms**

Easily create web forms and manage form entries within the WordPress admin.

Version 2.10.1 \| By Gravity Forms

**Import Export Menu**

This plugin allows you to export and import menus in WordPress, making it easier to manage and migrate menu structures between sites.

Version 2.0.3 \| By Yuky Hendiawan

**Index WP MySQL For Speed**

Speed up your WordPress site by adding high-performance keys (database indexes) to your MySQL database tables.

Version 1.5.6 \| By Oliver Jones, Rick James

**ManageWP - Worker**

We help you efficiently manage all your WordPress websites. Updates, backups, 1-click login, migrations, security and more, on one dashboard. This service comes in two versions: standalone ManageWP service that focuses on website management, and GoDaddy Pro that includes additional tools for hosting, client management, lead generation, and more.

Version 4.9.33 \| By GoDaddy

**MHY Mobile Menu Injector**

Replaces a placeholder navigation item with the WPB Accordion Menu shortcode in Gutenberg navigation.

Version 1.1.0 \| By MHY

**My Calendar - Accessible Event Manager**

Accessible WordPress event calendar plugin. Show events from multiple calendars on pages, in posts, or in widgets.

Version 3.7.9 \| By Joe Dolson

**Plugin Notes Plus**

Adds a column for plugin notes.

Version 1.2.10 \| By Jamie Bergen

**Popup Builder**

The most complete popup plugin. Html, image, iframe, shortcode, video and many other popup types. Manage popup dimensions, effects, themes and more. Create highly converting, mobile friendly marketing popups.

Version 4.4.3 \| By Looking Forward Software Incorporated.

**Redirection**

Manage all your 301 redirects and monitor 404 errors

Version 5.7.5 \| By John Godley

**SVG Support**

Upload SVG files to the Media Library and render SVG files inline for direct styling/animation of an SVG's internal elements using CSS/JS.

Version 2.5.14

**User Switching**

Instant switching between user accounts in WordPress and WooCommerce.

Version 1.11.2 \| By John Blackbourn

**WordPress Importer**

Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.

Version 0.9.5 \| By wordpressdotorg \|

**WP Change Default From Email**

A simple and easy way to change the from email address and from email name that appear on emails sent from WordPress.

Version 1.1.6 \| By Subodh Ghulaxe

**WP Dashboard Notes**

Working in a team? Want to make notes? You can do just that with WP Dashboard Notes. Create beautiful notes with a nice user experience.

Version 1.0.13 \| By Jeroen Sormani

**WP Hidden Password Protected Pages**

The plugin is for hiding the password protected pages (posts) in WordPress.

Version 1.2.5 \| By Kimiya Kitani

**WPB Accordion Menu or Category**

You may display the WordPress menu or any categories in a nice accordion with submenu and subcategory support by using the WPB Accordion Menu or Category Plugin. For WooCommerce websites, it can be really helpful.

Version 1.8.4 \| By WPBean

**WPCode Lite**

Easily add code snippets in WordPress. Insert scripts to the header and footer, add PHP code snippets with conditional logic, insert ads pixel, custom content, and more.

Version 2.3.5 \| By WPCode

**Yoast Duplicate Post**

The go-to tool for cloning posts and pages, including the powerful Rewrite & Republish feature.

Version 4.6 \| By Enrico Battocchi & Team Yoast
