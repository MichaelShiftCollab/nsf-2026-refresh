"""Generates wp-content/themes/nsf/patterns/style-guide.php from the Figma Styling frame (362:219).

Vertical positions are the frame's own y values, so the page lines up with the mockup in the
visual harness. Re-run after changing the layout: python3 bin/dev/style-guide-pattern.py
"""
import json
import pathlib

OUT = pathlib.Path(__file__).resolve().parents[2] / 'wp-content/themes/nsf/patterns/style-guide.php'


def attrs(d):
    return ' ' + json.dumps(d, separators=(',', ':')) if d else ''


def css(d):
    return ';'.join(f'{k}:{v}' for k, v in d.items())


def para(text, style=None, color=None, extra=None, align=None, size=None, mt=None):
    a, cls, st = {}, ['wp-block-paragraph'] if False else [], {}
    if style:
        a['className'] = f'is-style-{style}'
        cls.append(f'is-style-{style}')
    if color:
        a['textColor'] = color
        cls += [f'has-{color}-color', 'has-text-color']
    if align:
        a['align'] = align
        cls.append(f'has-text-align-{align}')
    s = {}
    if size:
        s.setdefault('typography', {})['fontSize'] = size
        st['font-size'] = size
    if extra:
        for k, v in extra.items():
            s.setdefault('typography', {})[k] = v
            st[{'lineHeight': 'line-height', 'fontWeight': 'font-weight', 'fontFamily': 'font-family'}[k]] = v
    if mt is not None:
        s.setdefault('spacing', {}).setdefault('margin', {})['top'] = f'{mt}px'
        st['margin-top'] = f'{mt}px'
    if s:
        a['style'] = s
    c = f' class="{" ".join(cls)}"' if cls else ''
    sa = f' style="{css(st)}"' if st else ''
    return f'<!-- wp:paragraph{attrs(a)} -->\n<p{c}{sa}>{text}</p>\n<!-- /wp:paragraph -->'


def heading(level, text):
    a = {} if level == 2 else {'level': level}
    return f'<!-- wp:heading{attrs(a)} -->\n<h{level} class="wp-block-heading">{text}</h{level}>\n<!-- /wp:heading -->'


def group(inner, mt=0, layout=None, cls=None, style=None, bg=None, tag='div', extra_css=None):
    a, classes, st = {}, ['wp-block-group'], {}
    if cls:
        a['className'] = cls
        classes.append(cls)
    if bg:
        a['backgroundColor'] = bg
        classes += [f'has-{bg}-background-color', 'has-background']
    s = dict(style or {})
    s.setdefault('spacing', {})
    s['spacing'] = dict(s['spacing'])
    s['spacing']['margin'] = {'top': f'{mt}px'}
    s['spacing'].setdefault('blockGap', '0')
    st['margin-top'] = f'{mt}px'
    pad = s['spacing'].get('padding')
    if pad:
        for k, v in pad.items():
            st[f'padding-{k}'] = v
    dims = s.get('dimensions', {})
    if 'minHeight' in dims:
        st['min-height'] = dims['minHeight']
    border = s.get('border')
    if border:
        st['border-width'] = border['width']
        st['border-style'] = 'solid'
        st['border-color'] = border['color']
    if extra_css:
        st.update(extra_css)
    a['style'] = s
    a['layout'] = layout or {'type': 'default'}
    return (f'<!-- wp:group{attrs(a)} -->\n<{tag} class="{" ".join(classes)}" style="{css(st)}">'
            f'\n{inner}\n</{tag}>\n<!-- /wp:group -->')


def section_header(text, mt):
    rule = ('<!-- wp:separator {"backgroundColor":"dark-blue","style":{"layout":{"selfStretch":"fill"}}} -->\n'
            '<hr class="wp-block-separator has-text-color has-dark-blue-color has-alpha-channel-opacity '
            'has-dark-blue-background-color has-background"/>\n<!-- /wp:separator -->')
    return group(para(text, 'eyebrow', 'dark-blue') + '\n' + rule, mt,
                 {'type': 'flex', 'flexWrap': 'nowrap', 'verticalAlignment': 'center'},
                 style={'spacing': {'blockGap': '24px'}})


def swatch(slug, name, light):
    return group(para(name, color='dark-blue' if light else 'white', size='20px', extra={'lineHeight': '24px'}),
                 0, cls=None, bg=slug,
                 style={'spacing': {'padding': {'top': '15px', 'left': '20px'}}, 'dimensions': {'minHeight': '129px'},
                        'layout': {'selfStretch': 'fixed', 'flexSize': '295px'}},
                 extra_css={'width': '295px', 'flex': '0 0 295px'})


def swatch_row(items, mt):
    return group('\n'.join(swatch(*i) for i in items), mt,
                 {'type': 'flex', 'flexWrap': 'nowrap'}, style={'spacing': {'blockGap': '30px'}})


def block_sample(cls, label, light, border=False):
    s = {'spacing': {'padding': {'bottom': '15px', 'left': '20px'}}, 'dimensions': {'minHeight': '391px'},
         'layout': {'selfStretch': 'fill'}}
    if border:
        s['border'] = {'width': '1px', 'color': 'var(--wp--preset--color--gray)'}
    return group(para(label, color='dark-blue' if light else 'white', size='20px', extra={'lineHeight': '24px'}),
                 0, {'type': 'flex', 'orientation': 'vertical', 'verticalAlignment': 'bottom'},
                 cls=f'is-style-{cls}', style=s, extra_css={'flex': '1 1 0'})


def sample_row(a, b, mt):
    return group(a + '\n' + b, mt, {'type': 'flex', 'flexWrap': 'nowrap'}, style={'spacing': {'blockGap': '30px'}})


def button(text, style, hover):
    cls = 'wp-block-button' + (f' is-style-{style}' if style else '') + (' nsf-is-hover' if hover else '')
    a = {}
    if style or hover:
        a['className'] = ' '.join(x for x in [f'is-style-{style}' if style else '', 'nsf-is-hover' if hover else ''] if x)
    return (f'<!-- wp:button{attrs(a)} -->\n<div class="{cls}"><a class="wp-block-button__link wp-element-button">'
            f'{text}</a></div>\n<!-- /wp:button -->')


def button_stack(text, style, hover, label, ml):
    btns = f'<!-- wp:buttons -->\n<div class="wp-block-buttons">\n{button(text, style, hover)}\n</div>\n<!-- /wp:buttons -->'
    return group(btns + '\n' + para(label, color='dark-blue', size='20px', extra={'lineHeight': '24px'}),
                 0, {'type': 'flex', 'orientation': 'vertical', 'justifyContent': 'center'},
                 style={'spacing': {'blockGap': '17px', 'margin': {}}}, extra_css={'margin-left': f'{ml}px'})


def gradient_band(gradient, inner, height, pad):
    return (f'<!-- wp:group {{"gradient":"{gradient}","style":{{"spacing":{{"padding":{json.dumps(pad)},"margin":{{"top":"0"}}}},'
            f'"dimensions":{{"minHeight":"{height}px"}}}},"layout":{{"type":"default"}}}} -->\n'
            f'<div class="wp-block-group has-{gradient}-gradient-background has-background" style="'
            + css({**{f'padding-{k}': v for k, v in pad.items()}, 'min-height': f'{height}px', 'margin-top': '0'})
            + f'">\n{inner}\n</div>\n<!-- /wp:group -->')


def frame(w, h, ml):
    return group('', 0, cls='nsf-frame-sample', style={'dimensions': {'minHeight': f'{h}px'}},
                 extra_css={'width': f'{w}px', 'flex': f'0 0 {w}px', 'margin-left': f'{ml}px',
                            'background-color': 'rgba(112,113,113,0.2)',
                            'border-radius': '0 var(--wp--custom--radius--frame) 0 var(--wp--custom--radius--frame)'})


# (top, bottom, markup) with tops/bottoms in mockup pixels; margins are the gaps between them.
items = [
    (108.5, 140.5, lambda m: section_header('Color Palette', m)),
    (191, 320, lambda m: swatch_row([('dark-blue', 'Dark Blue', False)], m)),
    (344, 473, lambda m: swatch_row([('primary-blue', 'Primary Blue', False), ('primary-orange', 'Primary Orange', False), ('gray', 'Gray', False)], m)),
    (497, 626, lambda m: swatch_row([('medium-blue', 'Medium Blue', False), ('medium-orange', 'Medium Orange', True)], m)),
    (650, 779, lambda m: swatch_row([('light-blue', 'Light Blue', True), ('light-orange', 'Light Orange', True)], m)),
    (803, 932, lambda m: swatch_row([('lightest-blue', 'Lightest Blue', True)], m)),
    (1054.5, 1086.5, lambda m: section_header('Typography', m)),
    (1193, 1257, lambda m: group(para('Eyebrow<br>SleepTech', 'eyebrow'), m)),
    (1321, 1513, lambda m: group(heading(1, 'Heading 1<br>Advancing Sleep Health<br>Through SleepTech Activities'), m)),
    (1565, 1677, lambda m: group(heading(2, 'Heading 2<br>Conducting Custom Research'), m)),
    (1735, 1815, lambda m: group(heading(3, 'Heading 3<br>SleepTech Network'), m)),
    (1887, 1967, lambda m: group(heading(4, 'Heading 4<br>Our Members'), m)),
    (2031, 2095, lambda m: group(heading(5, 'Heading 5<br>About Variowell'), m)),
    (2228.4, 2380.6, lambda m: group(para('Paragraph 1', 'paragraph-1') + '\n' + para('Want to know what we think will bring the next wave of growth in sleep health?', 'paragraph-1', mt=32), m, layout={'type': 'constrained', 'contentSize': '600px', 'justifyContent': 'left'})),
    (2436.6, 2804.4, lambda m: group(para('Paragraph 2', 'paragraph-2') + '\n' + para('As part of National Sleep Foundation’s (NSF) sleep health mission, a stated goal is that sleep science and insights are rapidly incorporated into accessible health products and services.', 'paragraph-2', mt=24) + '\n' + para('Sleep technology has incredible potential to improve consumers’ sleep and their health. NSF is committed to making science-based sleep technology more accessible and convenient so anyone and everyone can be their Best Slept Self®.', 'paragraph-2', mt=24), m, layout={'type': 'constrained', 'contentSize': '600px', 'justifyContent': 'left'})),
    (2862.7, 3246.3, lambda m: group('\n'.join([para('Paragraph 3'), para('Want to know more about your consumers’ thoughts on sleep technology? Do you have a technology product you want to test in the lab or home environment?', mt=16), para('NSF designs, executes, and analyzes custom research studies for organizations that want to know more about the public’s sleep. Using NSF’s validated, proprietary tools and survey instruments, NSF conducts US-based and global research to gather consumer insights about sleep &amp; technology, and to evaluate SleepTech performance. NSF uses our HIPAA-compliant SleepLife® platform and mobile application to build a custom platform for data collection and analysis and to integrate with wearables or other devices.', mt=16), para('As the leading independent source of information on the public’s sleep health, NSF’s research results and insights have broad reach and impact. In fact, study results have been used in multiple global markets.', mt=16)]), m, layout={'type': 'constrained', 'contentSize': '600px', 'justifyContent': 'left'})),
    (3305.7, 3369.3, lambda m: group(para('Caption', 'caption') + '\n' + para('Lorem ipsum dolor sit amet lorem ipsum dolor sit amet.', 'caption', mt=16), m, layout={'type': 'constrained', 'contentSize': '600px', 'justifyContent': 'left'})),
    (3430, 3470, lambda m: group(para('Meta Text<br>September 2026', 'meta'), m)),
    (3543, 3631, lambda m: group('\n'.join([button_stack('Primary Button', None, False, 'Normal State', 10), button_stack('Primary Button', None, True, 'Hover State', 21), button_stack('Secondary Button', 'secondary', False, 'Normal State', 107), button_stack('Secondary Button', 'secondary', True, 'Hover State', 24)]), m, {'type': 'flex', 'flexWrap': 'nowrap', 'verticalAlignment': 'top'})),
    (4674.6, 4706.6, lambda m: section_header('Backgrounds', m)),
    (4743, 4767, lambda m: group(para('<strong>Solids</strong>', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (4782, 5173, lambda m: sample_row(block_sample('section-primary-blue', 'Primary Blue', False), block_sample('section-white', 'White', True, border=True), m)),
    (5203, 5594, lambda m: sample_row(block_sample('section-lightest-blue', 'Lighest Blue', True), block_sample('section-light-orange', 'Light Orange', True), m)),
    (5652, 5676, lambda m: group(para('<strong>Gradients</strong>', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (5691, 6082, lambda m: sample_row(block_sample('section-primary-blue-to-dark-blue', 'Primary Blue  &gt; Dark Blue', False), block_sample('section-light-blue-to-light-orange', 'Light Blue &gt; Light Orange', True), m)),
    (6112, 6503, lambda m: sample_row(block_sample('section-light-blue-to-white', 'Light Blue &gt; White', True), block_sample('section-light-orange-to-white', 'Light Orange &gt; White', True), m)),
    (6677, 6701, lambda m: group(para('<strong>Limited Use Gradients</strong>', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (6726, 6774, lambda m: group(gradient_band('announcement-bar', para('<strong>Announcement Bar</strong>', color='white', align='center', size='20px', extra={'lineHeight': '32px'}), 48, {'top': '8px', 'bottom': '8px'}), m)),
    (6779, 6803, lambda m: group(para('Medium Blue &gt; Primary Blue', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (6838, 6962, lambda m: group(gradient_band('inner-page-heading', para('Inner Page Heading One', color='white', size='56px', extra={'lineHeight': '60px', 'fontWeight': '500', 'fontFamily': 'var(--wp--preset--font-family--test-family)'}), 124, {'top': '34px', 'left': '21px'}), m)),
    (6967, 6991, lambda m: group(para('Primary Blue &gt; Medium Blue &gt; Primary Orange', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (7162.6, 7194.6, lambda m: section_header('Rules', m)),
    (7291, 7294, lambda m: group('<!-- wp:separator {"className":"is-style-wide"} -->\n<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>\n<!-- /wp:separator -->', m)),
    (7312, 7336, lambda m: group(para('Light Blue', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
    (7502.6, 7534.6, lambda m: section_header('Image Frames', m)),
    (7579, 7982, lambda m: group(frame(620, 324, 0) + '\n' + frame(403, 403, 71), m, {'type': 'flex', 'flexWrap': 'nowrap', 'verticalAlignment': 'bottom'})),
    (8017, 8041, lambda m: group(para('72px Rounded Corner Radii on Opposite Ends', color='dark-blue', size='20px', extra={'lineHeight': '24px'}), m)),
]

parts, prev = [], 0
for top, bottom, make in items:
    parts.append(make(round(top - prev, 1)))
    prev = bottom
inner = '\n'.join(parts)
page = (
    '<!-- wp:group {"align":"full","className":"nsf-style-guide","style":{"spacing":{"padding":{"top":"0","bottom":"'
    + str(8510 - prev) + 'px","left":"85px","right":"85px"},"blockGap":"0","margin":{"top":"0"}}},'
    '"layout":{"type":"constrained","contentSize":"1270px","wideSize":"1270px"}} -->\n'
    '<div class="wp-block-group alignfull nsf-style-guide" style="margin-top:0;padding-top:0;padding-right:85px;'
    f'padding-bottom:{8510 - prev}px;padding-left:85px">\n{inner}\n</div>\n<!-- /wp:group -->'
)

header = '''<?php
/**
 * Title: Style Guide
 * Slug: nsf/style-guide
 * Description: Reproduces the Figma Styling frame (362:219) with core blocks. Used by the Style Guide page and the visual test. Generated by bin/dev/style-guide-pattern.py.
 * Categories: nsf
 * Inserter: no
 */
?>
'''
OUT.write_text(header + page + '\n')
print(f'wrote {OUT} ({len(page)} bytes)')
