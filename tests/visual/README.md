# Visual comparison harness

Compares the local site to Figma mockups with Playwright and pixelmatch.

- `mockups.json`: Figma frames to export (`name`, Figma `node` id, `width`).
- `mockups/<name>-<width>.png`: exported mockups at 1x. Committed.
- `pages.json`: what to capture. Fields: `name`, `url` (path on the site), `widths` (default 1440, 781, 600), optional `group` (for `--grep`), `mockup` (mockup name if different from `name`), `selector` (capture one section), `actions`, `auth` (log in first, for private pages; uses WP_USER and WP_PASS, default admin/admin), `threshold` (percent mismatch allowed, default 3), `note` (why an entry needs a higher threshold), `heightTolerance` (percent of mockup height, default 15), `fullPage` (default true), `ignore` (selectors whose boxes are blanked in both images before comparing, for photos that differ from the mockup).
- `actions`: run in order before capture. Each is one of `{ "click": sel }`, `{ "hover": sel }`, `{ "select": sel, "value": v }`, `{ "check": sel }`, `{ "fill": sel, "value": v }`, `{ "scroll": y }`, `{ "waitFor": sel }`, `{ "wait": ms }`.

## Commands

```sh
npm run mockups:pull                              # needs FIGMA_TOKEN; --force re-exports
npm run test:visual                               # every entry
npm run test:visual -- --grep home                # entries whose name or group contains "home"
npm run test:visual -- --base-url https://staging.example.com
```

Results go to `results/` (not committed): screenshot, mockup and diff per entry, `results.json`, and `report.html` with the three images side by side.

The overlapping area is compared when heights differ, and the height difference is reported. The default 3% leaves room only for text antialiasing and the stand-in heading font. An entry with a higher `threshold` says why in its `note`: the remaining difference must be the heading font or content (copy, sample posts, photos), never layout. An entry passes when the mismatch is within `threshold` and the height is within `heightTolerance`. Mockups use placeholder copy, so open the diff for a failing entry and fix layout, spacing, color and type; ignore copy.

Where `api.figma.com` is unreachable (as in the Claude Code cloud container), export through the Figma MCP server instead: `get_screenshot` with `maxDimension` equal to the frame's longer edge gives a 1x PNG; save it to `mockups/<name>-<width>.png`.
