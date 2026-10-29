# Kinsmen Modern - WHMCS v8 Modern Dashboard Client Area Theme

## Overview
A modernized WHMCS v8 client area theme based on the Twenty-One template, featuring an admin dashboard layout with a fixed left sidebar, modern styling via CSS custom properties, and dark mode toggle support.

## Theme Structure
- **Template Files (.tpl)**: Smarty template files for WHMCS client area pages
- **CSS**: Custom styling using CSS custom properties for theming
- **JS**: Dark mode toggle + sidebar toggle functionality with localStorage persistence

## Layout Architecture
- **Fixed Left Sidebar** (`<aside class="admin-sidebar">`): 260px dark navy sidebar with logo, primary/secondary navbar rendered vertically, submenu expand/collapse
- **Main Wrapper** (`<div class="admin-main-wrapper">`): Content area offset from sidebar with `margin-left: 260px` on desktop
- **Sticky Top Bar** (`<header class="admin-topbar-header">`): Notifications, search, cart icon, dark mode toggle, user info
- **Mobile**: Sidebar hidden off-screen, toggled via hamburger button with overlay backdrop

## Key Files Modified
- `header.tpl` - Admin sidebar layout with `<aside>` sidebar, sticky topbar, sidebar toggle
- `footer.tpl` - Closes `admin-main-wrapper`, footer with `admin-content-padding`
- `includes/head.tpl` - Includes custom.css and darkmode.js assets
- `includes/breadcrumb.tpl` - Enhanced breadcrumb with wallet balance
- `includes/sidebar.tpl` - Page-specific sidebar cards (unchanged structure)
- `includes/navbar.tpl` - Navigation menus (unchanged, rendered by sidebar loop)
- `clientareahome.tpl` - Dashboard tiles and panels
- `homepage.tpl` - Homepage with icon cards
- `login.tpl` - Centered login card with icon header

## Key Files Created
- `css/custom.css` - Comprehensive CSS (~900 lines) with admin sidebar, topbar, input-group fixes, cards, tiles, buttons, forms, tables, dark mode variables
- `js/darkmode.js` - Dark mode toggle + sidebar toggle/submenu accordion with localStorage persistence
- `preview.html` - Static HTML preview showing full admin dashboard layout

## Dark Mode
- Class-based toggle: `.dark` class on `<html>` element
- CSS custom properties swap all colors between light and dark palettes
- Toggle button in topbar (moon/sun icon, `#darkModeToggle`)
- Persists preference in localStorage (`whmcs_dark_mode`)
- Falls back to system color scheme preference

## Design System
- **Colors**: Blue (#3b82f6) primary, Orange (#f48413) accent, gradient buttons
- **Typography**: Poppins/Inter font stack
- **Sidebar**: Dark navy (#0f172a) with translucent white text, orange badges
- **Borders**: Rounded corners with CSS variable `--radius-*`
- **Shadows**: Subtle elevation system `--shadow-sm/md/lg/xl`
- **Transitions**: Smooth color transitions on theme switch
- **Input Groups**: Fixed `input-group-prepend`/`input-group-append` alignment with matching height/border-radius

## CSS Custom Properties
- `--sidebar-width: 260px` - Sidebar width
- `--topbar-height: 60px` - Top bar height
- `--bg-sidebar` - Sidebar background color
- `--bg-topbar` - Topbar background color
- All color, shadow, radius, and transition variables for light/dark themes

## Dependencies
- Bootstrap 4.5.3 (provided by WHMCS)
- Font Awesome 5 (provided by WHMCS)
- Poppins & Inter Google Fonts (loaded via CDN)

