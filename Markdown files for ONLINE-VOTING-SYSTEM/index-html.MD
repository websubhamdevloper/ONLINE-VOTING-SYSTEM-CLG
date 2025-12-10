# index.html Documentation

## File Purpose
`index.html` is the landing page and entry point of the Online Voting System. It serves as the home page where users can choose to either login as an existing voter or register as a new voter.

## File Type
HTML (Frontend)

## Key Components

### 1. HTML Structure
- **DOCTYPE**: HTML5 standard document type declaration
- **Language**: Set to English (`lang="en"`)
- **Character Set**: UTF-8 encoding for universal character support
- **Viewport**: Responsive meta tag for mobile compatibility

### 2. Head Section
```html
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ONLINE-VOTING-SYSTEM</title>
<link rel="stylesheet" href="style.css">
```
- Sets the page title as "ONLINE-VOTING-SYSTEM"
- Links to external CSS file `style.css` for styling
- Includes responsive design meta tags

### 3. Body Content

#### Main Container (`div.container`)
Acts as the central wrapper for all page content with white background and rounded corners.

#### Welcome Header
```html
<h1>Welcome!</h1>
<p class="subtitle">ONLINE VOTING MACHINE</p>
```
- **h1**: Main welcome heading
- **subtitle**: Descriptive text about the system

#### Logo Section
```html
<div class="logo-vote">
    <img src="image.webp" alt="voting-logo">
</div>
```
- Displays voting system logo/image
- Image source: `image.webp`
- Alt text for accessibility: "voting-logo"

#### Navigation Buttons
```html
<div class="buttons">
    <a href="login.html" class="btn">VOTER LOGIN</a>
    <a href="registration.html" class="btn">REGISTER</a>
</div>
```
- **VOTER LOGIN button**: Links to `login.html` for existing users
- **REGISTER button**: Links to `registration.html` for new user registration
- Both buttons use `btn` class for consistent styling

## Design Features

### Visual Elements
1. **Centered Layout**: All content is centered on the page
2. **White Container**: Clean white background with rounded corners
3. **Hover Effects**: Buttons and container have smooth hover animations
4. **Shadow Effects**: Subtle box shadows for depth

### Responsive Design
- Viewport meta tag ensures proper scaling on mobile devices
- Flexible container width (600px)
- Images scale appropriately

## User Flow
1. User lands on this page
2. Sees welcome message and voting logo
3. Chooses between two options:
   - **Login** → Goes to `login.html`
   - **Register** → Goes to `registration.html`

## Styling (from style.css)
- Container has hover effect (translateY and shadow)
- Buttons have orange background (`rgb(243, 162, 96)`)
- Buttons turn green on hover (`rgb(95, 192, 95)`)
- Logo image is 150x150 pixels

## File Dependencies
- **CSS**: `style.css` - Contains all styling
- **Image**: `image.webp` - Voting system logo
- **Links to**: 
  - `login.html` - Login page
  - `registration.html` - Registration page

## Technologies Used
- HTML5
- CSS3 (external stylesheet)
- Responsive Design principles

## User Experience Features
1. Clear call-to-action buttons
2. Simple, intuitive navigation
3. Visual appeal with logo
4. Smooth transitions and hover effects
5. Mobile-friendly responsive design

## Security Considerations
- No sensitive data on this page
- Acts as public-facing entry point
- No authentication required to view

## Page Purpose in System Flow
This is the **first page** users see when accessing the voting system. It acts as a router directing users to either:
- Authentication (login.html) for existing voters
- Registration (registration.html) for new voters

