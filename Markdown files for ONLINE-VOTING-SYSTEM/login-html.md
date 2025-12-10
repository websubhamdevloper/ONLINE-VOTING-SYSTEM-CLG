# login.html Documentation

## File Purpose
`login.html` is the authentication page where registered voters enter their credentials to access the voting system. It collects email, voter name, and password to verify user identity.

## File Type
HTML (Frontend - Authentication Interface)

## Key Components

### 1. HTML Structure
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN-PAGE</title>
    <link rel="stylesheet" href="style.css">
</head>
```
- HTML5 standard structure
- UTF-8 character encoding
- Responsive viewport for mobile devices
- Page title: "LOGIN-PAGE"
- Links to `style.css` for styling

### 2. Container Section
```html
<div class="container-login">
    <h1>VOTER LOGIN</h1>
    <p class="subtitle">Enter Your Personal Details</p>
</div>
```
- Uses `container-login` class for styling
- Header clearly identifies purpose
- Subtitle provides user guidance

### 3. Login Image
```html
<div class="image-login">
    <img src="15584897.webp" alt="image of Login">
</div>
```
- Displays visual representation (login icon/illustration)
- Image file: `15584897.webp`
- Size: 120x120 pixels (defined in CSS)
- Improves visual appeal and user experience

### 4. Login Form
```html
<form action="login.php" method="POST">
```
- **Action**: Submits data to `login.php` for server-side processing
- **Method**: POST (secure transmission of credentials)
- Form data is not visible in URL

#### Form Fields

##### Email/Username Field
```html
<div class="input-group">
    <label for="email">Email / Username</label>
    <input type="text" id="email" placeholder="Email" name="email" required>
</div>
```
- **Type**: text
- **Name**: `email` (used by PHP)
- **Label**: Clearly identifies field purpose
- **Placeholder**: "Email" for user guidance
- **Required**: Form cannot submit without this field

##### Voter's Name Field
```html
<div class="input-group">
    <label for="votername">Voter's Name</label>
    <input type="text" id="votername" placeholder="Voter's Name" name="votername" required>
</div>
```
- **Type**: text
- **Name**: `votername` (used by PHP)
- **Purpose**: Additional verification layer
- **Required**: Must match registered full name

##### Password Field
```html
<div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" placeholder="Password" name="password" required>
</div>
```
- **Type**: password (characters hidden with dots)
- **Name**: `password` (used by PHP)
- **Security**: Input masked for privacy
- **Required**: Cannot login without password

### 5. Submit Button
```html
<button type="submit" class="btn-login">Login</button>
```
- **Type**: submit (triggers form submission)
- **Class**: `btn-login` for styling
- **Action**: Sends form data to `login.php`
- Styled with hover effects for better UX

### 6. Registration Link
```html
<p style="margin-top: 15px">
    Don't have an account? 
    <a href="registration.html" class="regis-link">Create ID</a>
</p>
```
- Provides navigation for new users
- Links to `registration.html`
- Styled with `regis-link` class
- Grey text with underline on hover

## Data Flow

### 1. User Input
User enters three pieces of information:
- Email/Username
- Voter's Name
- Password

### 2. Form Validation
- HTML5 `required` attribute prevents empty submission
- All three fields must be filled

### 3. Form Submission
When user clicks "Login" button:
```
Form Data (POST) → login.php
{
    email: "user@example.com",
    votername: "John Doe",
    password: "userPassword123"
}
```

### 4. Server Processing
`login.php` receives data and:
- Validates credentials against database
- Checks if user has already voted
- Creates session if successful
- Redirects to appropriate page

## Security Features

### 1. Password Masking
```html
<input type="password">
```
- Hides password characters
- Prevents shoulder surfing

### 2. POST Method
- Credentials not visible in URL
- More secure than GET method

### 3. Required Fields
- Prevents empty submissions
- Client-side validation

### 4. Multi-Factor Verification
- Email + Name + Password
- Reduces unauthorized access

## User Experience Features

### Visual Design
1. **Centered Layout**: Clean, professional appearance
2. **Login Image**: Visual representation of action
3. **Clear Labels**: Each field clearly identified
4. **Placeholder Text**: Guides user input
5. **Hover Effects**: Interactive feedback

### Navigation
1. **Registration Link**: Easy access for new users
2. **Clear Call-to-Action**: "Login" button stands out

### Responsive Design
- Works on desktop and mobile
- Container adjusts to screen size
- Inputs scale appropriately

## Styling (from style.css)

### Container
```css
.container-login {
    width: 600px;
    background: white;
    border-radius: 20px;
    padding: 25px;
    /* Hover effects and shadows */
}
```

### Input Groups
```css
.input-group {
    max-width: 400px;
    margin: 12px auto;
    text-align: left;
}
```

### Button
```css
.btn-login {
    background: rgb(243, 162, 96); /* Orange */
    /* Hover: rgb(95, 192, 95) - Green */
}
```

## Error Handling

### Client-Side
- HTML5 validation (required fields)
- Browser prevents empty submission

### Server-Side (login.php handles)
- Invalid credentials → `login-unsuccess.html`
- Already voted → `already-voted.html`
- Correct credentials → `login-success.html`

## File Dependencies

### CSS
- `style.css` - All styling

### Images
- `15584897.webp` - Login illustration

### PHP Backend
- `login.php` - Processes authentication

### Navigation Links
- `registration.html` - For new users

## Integration with System

### Input Flow
```
User → login.html → login.php → Database
```

### Output Flow
```
Success: → login-success.html → vote.html
Failure: → login-unsuccess.html → back to login.html
Already Voted: → already-voted.html → result.php
```

## Best Practices Implemented

1. **Semantic HTML**: Proper use of form elements
2. **Accessibility**: Labels linked to inputs
3. **Security**: Password field, POST method
4. **User Guidance**: Placeholders and clear labels
5. **Responsive**: Mobile-friendly viewport settings
6. **Navigation**: Easy path to registration

## Technical Specifications

- **Form Method**: POST
- **Form Action**: login.php
- **Input Types**: text (2), password (1)
- **Validation**: HTML5 required attribute
- **Character Encoding**: UTF-8
- **Viewport**: width=device-width, initial-scale=1.0

