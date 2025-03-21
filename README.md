# WPBakery to Gutenberg Migration Script

## Overview
This script automates the migration of WordPress pages from WPBakery shortcodes to Gutenberg blocks. It:
✅ Scans all WordPress pages for WPBakery shortcodes.  
✅ Replaces WPBakery shortcodes with Gutenberg blocks.  
✅ Preserves the page structure (text, images, headings).  
✅ Removes unnecessary WPBakery shortcodes and cleans the content.  

---

## 📌 Steps to Use This Script
### 1. Backup Your Website!
Before running the script, **create a full backup of your WordPress database** to prevent data loss.

### 2. Run the Script
- Upload the `wpbakery-to-gutenberg` folder to your WordPress plugins directory.
- Go to **WordPress Dashboard → Plugins**.
- Find **"WPBakery to Gutenberg Migration"** and click **"Activate"**.
- Navigate to **Tools → WPBakery to Gutenberg**.
- Click **"Start Migration"** to convert all WPBakery shortcodes into Gutenberg blocks.

---

## **🛠️ What This Script Converts**

| WPBakery Shortcode | Converted to Gutenberg Block |
|----------------------|--------------------------------|
| `[vc_column_text]Lorem Ipsum[/vc_column_text]` | `<!-- wp:paragraph -->Lorem Ipsum<!-- /wp:paragraph -->` |
| `[vc_single_image image="123"]` | `<!-- wp:image {"id":123} --><img src="IMAGE_URL" /><!-- /wp:image -->` |
| `[vc_btn title="Click Here" link="https://example.com"]` | `<!-- wp:button --><a href="https://example.com">Click Here</a><!-- /wp:button -->` |

---

## 📢 Notes
- This script **only converts common WPBakery shortcodes** (text blocks, images, buttons). Custom shortcodes may require additional modifications.
- Ensure your WordPress installation is **updated** to the latest version before running the migration.

🚀 Enjoy a **clean, Gutenberg-friendly website** without WPBakery shortcodes!

