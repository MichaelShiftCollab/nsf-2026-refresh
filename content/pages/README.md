# Page docs

The 42 page docs from the Drive folder [NSF Website Pages](https://drive.google.com/drive/folders/1H8wiaZXujn8ubgcp7juqV52xP3o5jSYV), exported on 2026-10-15 for build plan step 17. `../content-plan.csv` is the CONTENT PLAN tab of NSF Website Content Sheets, exported the same day.

Each file is the Google Docs Markdown export of one doc, unedited, so pandoc reads it the same way it would read the .docx (`pandoc -f markdown -t html`). File names start with the doc number, which matches `../site-outline.md` and the NEW INDEX column of the content plan.

Every doc opens with a header block (Page title, Old title, Old URL, New URL, Audience, Meta), then a non-breaking-space line, then the page body.

## What step 17 needs to know

- **New URL is blank in every doc**, and the content plan's New Page Url column is blank too. Slugs need another source, or default to the old URL's slug.
- **Meta is blank** in the 12 empty docs and in 30.20.20, 30.20.30, 30.30.30, 40.20.10, 70.00, 80.10, 80.20, 80.30 and 80.40. The content plan's Meta Description column is blank for every page.
- **12 docs have no body yet**: 10.00, 10.30, 20.00, 30.00, 30.10, 30.10.20, 30.10.30, 30.20, 30.20.40, 30.30, 30.30.20, 30.30.60.
- **10.20.10 Drowsy Driving Prevention Resources** is in the content plan and the outline but has no doc.
- **Placeholders in the copy** stand in for blocks: `[BUTTON]`, `[LOGO GRID — member logos]` (40.20), `[LOGO GRID — winner logos]` (40.30), `[ARTICLE LISTING — auto-populated from posts]` (20.12), `[NEWS LISTING — auto-populated]` (60.00). 30.30.30 ends with a "Related Content (optional)" list of One, Two, Three.
- **Zoho form links** appear in 10.10, 40.20.10, 50.10 and 70.30; these become Gravity Forms placements.
- **Escapes from the export**: backslashes before some characters (`https\://www\.`, `\$`, `\!`, `\[`). pandoc removes them.
- **Title mismatches**: 10.20's page title says 2025 and its H1 says 2026; 70.00's H1 is "Mission and Goals"; 30.20.10 uses ™ in the title and ® in the meta.

## Index

| No. | Page | Old URL | Status | Source |
| :-- | :--- | :------ | :----- | :----- |
| 00 | [National Sleep Foundation (home page)](00-home.md) | https://www.thensf.org/ | copy, 633 words | [doc](https://docs.google.com/document/d/1JGNFXkVdoSsKHyaLS0hKbvfqMgPbsGKh4Xsslgy98HQ/edit) |
| 10.00 | [National Programs](10.00-national-programs.md) |  | empty | [doc](https://docs.google.com/document/d/1m907CsxzKzRn3LmEkM3TwwdOSzBytyEgp2YKKhV17rY/edit) |
| 10.10 | [Sleep Awareness Week 2026](10.10-sleep-awareness-week.md) | https://www.thensf.org/sleep-awareness-week/ | copy, 45 words | [doc](https://docs.google.com/document/d/1kpF_M1U_pQk059vHBcz2_WXdBFsn8xtaKiTnfCatRrQ/edit) |
| 10.20 | [Drowsy Driving Prevention 2025](10.20-drowsy-driving-prevention.md) | https://www.thensf.org/drowsy-driving-prevention/ | copy, 1118 words | [doc](https://docs.google.com/document/d/1qlUVkp8ECLMETC_a0cGo6b6pBY7HRIbsa857rl0xCi4/edit) |
| 10.30 | [Best Slept Self](10.30-best-slept-self.md) |  | empty | [doc](https://docs.google.com/document/d/12LzwpCLVppZV-dvPp0d9xRaP4XOr04Sc1OYh8iI87pI/edit) |
| 10.40 | [Reshaping Employee Wellness](10.40-reshaping-employee-wellness.md) | https://www.thensf.org/employee-wellness/ | copy, 477 words | [doc](https://docs.google.com/document/d/1gaS_0HNzfz2TIppTzwC9FgOr9v0JJEUtlrIm9R_HiJw/edit) |
| 10.50 | [Key Issues](10.50-key-issues.md) | https://www.thensf.org/issues/ | copy, 522 words | [doc](https://docs.google.com/document/d/17RZ0WAMVhC35B8XpGWMRFMIkKFZKKRzrs_P9nfVIqdY/edit) |
| 20.00 | [Sleep Health Resources (Resource Hub)](20.00-sleep-health-resources.md) |  | empty | [doc](https://docs.google.com/document/d/1mjez1OXF1HJXq-M2PLrOxUbO9k_FRSJ8_i_4Op4iBrY/edit) |
| 20.12 | [Sleep Learning Zone ® (blog)](20.12-sleep-learning-zone.md) | https://www.thensf.org/sleep-health-topics/ | copy, 105 words | [doc](https://docs.google.com/document/d/16vHM-3FkpSxMI55NplzR2dDQmg4-GaGS3cNfOy5uucY/edit) |
| 30.00 | [Research](30.00-research.md) |  | empty | [doc](https://docs.google.com/document/d/1zHlVyv7MPGRE0unGKhMqAxN4wyJk3W2CNvkoH2UqGIY/edit) |
| 30.10 | [NSF Sleep Measures](30.10-nsf-sleep-measures.md) |  | empty | [doc](https://docs.google.com/document/d/1bNEjIch2_6vt2e9ZPk40okyQYdIoUSpsesTqkrjpAw0/edit) |
| 30.10.10 | [Sleep Health Index®](30.10.10-sleep-health-index.md) | https://www.thensf.org/sleep-health-index/ | copy, 75 words | [doc](https://docs.google.com/document/d/1jx3E2tfXiL_xSZaIDkm3_1bwDXVd0MXvsfuKsvKOFzU/edit) |
| 30.10.20 | [SST](30.10.20-sst.md) |  | empty | [doc](https://docs.google.com/document/d/1rHPHjibGLUszFK3lQpZMU5-MsYSqSAiSrsvtLVcZbZQ/edit) |
| 30.10.30 | [BSSQ](30.10.30-bssq.md) |  | empty | [doc](https://docs.google.com/document/d/1Z9JfkqTFI5oX2E2LbSAemre-b2v2Ic3HJGtysCFZASQ/edit) |
| 30.20 | [NSF Publications](30.20-nsf-publications.md) |  | empty | [doc](https://docs.google.com/document/d/1J-f2LcV9ySva_vpnQOCLldnxuS41gzJ0Yl7QF_pCy1s/edit) |
| 30.20.10 | [Foundations of Sleep Health™](30.20.10-foundations-of-sleep-health.md) | https://www.thensf.org/foundations-of-sleep-health/ | copy, 378 words | [doc](https://docs.google.com/document/d/1sY5Ve45BQr9UdsE4A6Kx3LCkI6S1vddIDCnlUL4jtWw/edit) |
| 30.20.20 | [Sleep Health®️: Journal of the National Sleep Foundation](30.20.20-sleep-health-journal.md) | https://www.thensf.org/sleep-health-journal/ | copy, 141 words | [doc](https://docs.google.com/document/d/1tIZZVMuuDR0tq2PSFJLomwTXEMN8VZcA76FKrCVy0_0/edit) |
| 30.20.30 | [Guidelines](30.20.30-guidelines.md) | https://www.thensf.org/guidelines/ | copy, 75 words | [doc](https://docs.google.com/document/d/1oJPPaj19G79Ohi-6zQRQDfvv5xDmKycx_3Rjqf5ld64/edit) |
| 30.20.40 | [Position Statements](30.20.40-position-statements.md) |  | empty | [doc](https://docs.google.com/document/d/1QBPzJN7wJddfJnk0FOCFrq0ISYwXIJ07RSsAd5WT9SE/edit) |
| 30.30 | [NSF Research Reports](30.30-nsf-research-reports.md) |  | empty | [doc](https://docs.google.com/document/d/1FAr07tPvhro92f5zKroAIwxTQuT0ztYQZbmd6OMrW-Q/edit) |
| 30.30.10 | [Sleep in America® Polls](30.30.10-sleep-in-america-polls.md) | https://www.thensf.org/sleep-in-america-polls/ | copy, 631 words | [doc](https://docs.google.com/document/d/1lcyxy01_U0pRR_FYwLuyj8JxbcW7e2U8kzPOQh2dJOQ/edit) |
| 30.30.20 | [Drowsy Driving Reports](30.30.20-drowsy-driving-reports.md) |  | empty | [doc](https://docs.google.com/document/d/1vNYnzH8aWs911p0tKVwQK6N4SZOVBZwWynJTkNEFgfM/edit) |
| 30.30.30 | [Understanding Sleep Apnea](30.30.30-understanding-sleep-apnea.md) | https://www.thensf.org/sleepapneasurvey/ | copy, 240 words | [doc](https://docs.google.com/document/d/1_Jhb6iMmdU6DWVcKy9ebHFYk4VYZfsuYknbL6RX1uDQ/edit) |
| 30.30.40 | [Sleep Health During a Presidential Election](30.30.40-sleep-health-during-a-presidential-election.md) | https://www.thensf.org/sleep-health-during-a-presidential-election/ | copy, 238 words | [doc](https://docs.google.com/document/d/1rU31W3-Q0FPNH4jPG5AXeDwkyWnPUoNrarKTHBa96qY/edit) |
| 30.30.50 | [Sleep Health and the COVID-19 Pandemic](30.30.50-sleep-health-and-the-covid-19-pandemic.md) | https://www.thensf.org/sleep-health-and-the-covid-19-pandemic/ | copy, 221 words | [doc](https://docs.google.com/document/d/1KU30GMOuEg7-ABW7BnicYU7-sbPgJwJoRVdEnPeNnaU/edit) |
| 30.30.60 | [Topical Reports](30.30.60-topical-reports.md) |  | empty | [doc](https://docs.google.com/document/d/1xdxLWJuK5m6ygYgnEMRieg8Yrdka-RlmrCX30LuQFh8/edit) |
| 40.00 | [SleepTech®](40.00-sleeptech.md) | https://www.thensf.org/about-sleeptech/ | copy, 492 words | [doc](https://docs.google.com/document/d/1CMxWM5YmZUvLVDs8zyKiv8BAL4uOAi0X35EskrkhfiA/edit) |
| 40.10 | [NSF / CTA / ANSI Standards](40.10-nsf-cta-ansi-standards.md) | https://www.thensf.org/nsf-cta-ansi-standards/ | copy, 106 words | [doc](https://docs.google.com/document/d/1tefY3MFABnJfoh6B3EAu8BjruSJh_DzdEI_64scD6sI/edit) |
| 40.20 | [SleepTech® Network](40.20-sleeptech-network.md) | https://www.thensf.org/sleeptech-network/ | copy, 646 words | [doc](https://docs.google.com/document/d/1hE5AnARBVnstxz0Lrn5cLACZJ6yMcevNQjM2cP1gwY8/edit) |
| 40.20.10 | [SleepTech® Network Membership](40.20.10-sleeptech-network-membership.md) | https://www.thensf.org/sleeptech-network/membership-application/ | copy, 78 words | [doc](https://docs.google.com/document/d/1Iu-L4tQL1ZiGG7A3Vob4Vj7PQiFwtdCrUMMWU_uo24c/edit) |
| 40.30 | [SleepTech® Award](40.30-sleeptech-award.md) | https://www.thensf.org/sleeptech-award/ | copy, 579 words | [doc](https://docs.google.com/document/d/1HH6JNX_OsPxKIwwEyIiksQD1c7AF6JC2bWN1mZ34V7E/edit) |
| 50.00 | [SleepMark](50.00-sleepmark.md) | https://www.thensf.org/sleepmark/ | copy, 487 words | [doc](https://docs.google.com/document/d/1NpIGspNZfeEmg3BJATudtYnbUaAZ1g6qBAMZlSQYk78/edit) |
| 50.10 | [SleepMark™ Application](50.10-sleepmark-application.md) | https://www.thensf.org/sleepmark-application/ | copy, 28 words | [doc](https://docs.google.com/document/d/1VWQfAPYpMtPqN9WW4IKXU28Nb8LcFCDA6ZUpuZ-ii_E/edit) |
| 60.00 | [Media Center](60.00-media-center.md) | https://www.thensf.org/media-center/ | copy, 1607 words | [doc](https://docs.google.com/document/d/1LW3qpoZ4F_6Cevdl8eixXsRAp9ESXS6ulvMNhHyQb-s/edit) |
| 70.00 | [About Us](70.00-about-us.md) | https://www.thensf.org/mission-and-goals/ | copy, 97 words | [doc](https://docs.google.com/document/d/1Jhz9SaJAMwB9y35lt7MBV4widhOdMuEX0QouK2lhHEA/edit) |
| 70.10 | [Boards and Committees](70.10-boards-and-committees.md) | https://www.thensf.org/boards-and-committees/ | copy, 385 words | [doc](https://docs.google.com/document/d/1foph9czPCZ31AMf97TqSJ2dTf_L_acqiFZiR5H-DrwQ/edit) |
| 70.20 | [Lifetime Achievement Award](70.20-lifetime-achievement-award.md) | https://www.thensf.org/about/lifetime-achievement-award/ | copy, 6171 words | [doc](https://docs.google.com/document/d/15l6cAjQsWsqoqNJkC2klmW02kH1yzubk4fUeuPMv4g0/edit) |
| 70.30 | [Sponsorship Opportunities](70.30-sponsorship-opportunities.md) | https://www.thensf.org/sponsorship-opportunities/ | copy, 49 words | [doc](https://docs.google.com/document/d/1ouQqIQPuDNxrLKSiRa1RhLw_LefBgAVIGCiJu5YpY10/edit) |
| 80.10 | [Contact Us](80.10-contact-us.md) | https://www.thensf.org/contact/ | copy, 149 words | [doc](https://docs.google.com/document/d/1wtPBc2vmIiIjVmP5Tl9UPDXdrou-Xlz89J9r6fshiOo/edit) |
| 80.20 | [Terms of Use](80.20-terms-of-use.md) | https://www.thensf.org/terms-of-use/ | copy, 206 words | [doc](https://docs.google.com/document/d/1g-Bf4c6tLJCjC8s6ElwWAkcQKewBQ42S0d3dn2xbHxc/edit) |
| 80.30 | [Copyright](80.30-copyright.md) | https://www.thensf.org/copyright/ | copy, 96 words | [doc](https://docs.google.com/document/d/1MFMAESdBM3etKXe8PMnjJJQXcxXKmLk_23TH1r1Rrtw/edit) |
| 80.40 | [Privacy Policy](80.40-privacy-policy.md) | https://www.thensf.org/privacy-policy/ | copy, 1694 words | [doc](https://docs.google.com/document/d/1T8uKXr5LuPz3_wokU50aL8ZD12PZCVOyYb2xrhzhwuM/edit) |
