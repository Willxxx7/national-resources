# HTML Templates

Standalone HTML templates with corresponding CSS files for the Spark Studio Application.

## ⚠️ NOTE

**_These templates are for reference only and are not integrated into the application. You are free to modify and use them as needed or discard them entirely._**

## Template Files

### Admin Pages (with sidebar navigation)

1. **categories.html** / categories.css - Settings: Category management
2. **dashboard.html** / dashboard.css - Main dashboard with statistics
3. **event-access.html** / event-access.css - Event access code management
4. **events.html** / events.css - Events listing page
5. **orders.html** / orders.css - Orders listing page
6. **order-show.html** / order-show.css - Individual order details
7. **pictures.html** / pictures.css - Pictures listing page
8. **picture-sizes.html** / picture-sizes.css - Picture sizes management
9. **settings.html** / settings.css - Settings hub page
10. **users.html** / users.css - User management page

### Guest Pages (without sidebar)

11. **event-show.html** / event-show.css - Public event gallery view
12. **public-events.html** / public-events.css - Public events listing

### Other

13. **forms.html** / forms.css - Modal forms reference (all app forms in one page)
14. **login.html** / login.css - Login page

## Features

- Each HTML file is standalone (no dependencies between files)
- Minimal JavaScript (only for modal interactions in forms.html)
- Responsive design
- All resources are local
  - Local FontAwesome icons (fontawesome folder)
  - Custom Quicksand fonts (fonts folder)
  - Logo and favicons (images folder)
- Consistent color scheme and styling
- Forms template consolidates all modal forms for easy reference

## Resources

These are a copy of the very same resources from **dist/assets**:

- **fontawesome/** - Local FontAwesome CSS and webfonts
- **fonts/** - Quicksand-Regular.ttf and Quicksand-Bold.ttf
- **images/** - logo.svg, logo.png, and favicon folder

## Layout Structure

### Admin Pages

All admin pages (dashboard, events, orders, pictures, settings, categories, users, picture-sizes, event-access, order-show) follow the same layout:

- **Header**: Logo, welcome message, logout button
- **Sidebar**: Dark navigation with Dashboard, Events, Pictures, Orders, Settings
- **Content**: Page-specific content
- **Footer**: Copyright notice

### Guest Pages

Guest pages (public-events, event-show) have a simpler layout:

- **Header**: Logo and "Admin Login" button
- **Content**: Full-width content (no sidebar)
- **Footer**: Copyright notice

## Modal Forms

All modal forms used throughout the application are available in **forms.html** for reference:

- Create Event
- Edit Event
- Create Category
- Create Picture Size
- Create User
- Create Access Code
