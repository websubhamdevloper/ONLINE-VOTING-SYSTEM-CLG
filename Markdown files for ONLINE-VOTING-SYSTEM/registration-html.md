# registration.html Documentation

## File Purpose
`registration.html` is the **user registration page** where new voters create their accounts in the voting system. It collects necessary information (name, email, password) to register new users in the database.

## File Type
HTML (Frontend - Registration Interface)

## Key Components

### 1. HTML Document Structure
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Voter ID</title>
    <link rel="stylesheet" href="style.css">
</head>
```
- **DOCTYPE**: HTML5 standard
- **Language**: English
- **Charset**: UTF-8 encoding
- **Viewport**: Responsive design for mobile
- **Title**: "Create Voter ID"
- **Stylesheet**: Links to style.css

### 2. Main Container
```html
<div class="container">
    <h1>Create ID</h1>
    <p class="subtitle">Register to Vote</p>
</div>
```
- **Container class**: White box with rounded corners
- **Heading**: Clearly states purpose
- **Subtitle**: Additional context for users

### 3. Registration Form
```html
<form action="register.php" method="POST">
```
- **Action**: Submits data to `register.php`
- **Method**: POST (secure data transmission)
- **Purpose**: Collects and sends user registration data

## Form Fields

### 1. Full Name Field
```html
<div class="input-group">
    <label for="fullname">Full Name</label>
    <input type="text" id="fullname" placeholder="Full Name" name="fullname" required>
</div>
```

**Details**:
- **Type**: text
- **Name**: `fullname` (used by PHP)
- **ID**: fullname (links to label)
- **Placeholder**: "Full Name" (hints at expected input)
- **Required**: Cannot submit without this
- **Purpose**: Stores user's complete name for verification

### 2. Email Field
```html
<div class="input-group">
    <label for="email">Email</label>
    <input type="email" id="email" placeholder="Email" name="email" required>
</div>
```

**Details**:
- **Type**: email (validates email format)
- **Name**: `email` (used by PHP)
- **ID**: email (links to label)
- **Placeholder**: "Email"
- **Required**: Mandatory field
- **Validation**: Browser checks for valid email format (user@domain.com)
- **Purpose**: Unique identifier and login credential

### 3. Create Password Field
```html
<div class="input-group">
    <label for="password">Create Password</label>
    <input type="password" id="password" placeholder="Create Password" name="password" required>
</div>
```

**Details**:
- **Type**: password (masks input with dots)
- **Name**: `password` (used by PHP)
- **ID**: password (for JavaScript validation)
- **Placeholder**: "Create Password"
- **Required**: Cannot be empty
- **Security**: Characters hidden from view

### 4. Confirm Password Field
```html
<div class="input-group">
    <label for="confirm">Confirm Password</label>
    <input type="password" id="confirm" placeholder="confirm Password" name="confirm" required>
</div>
```

**Details**:
- **Type**: password (masked)
- **Name**: `confirm` (used by PHP)
- **ID**: confirm (for JavaScript validation)
- **Placeholder**: "confirm Password"
- **Required**: Must match password field
- **Purpose**: Prevents typos in password

### 5. Submit Button
```html
<button type="submit" class="btn">Register</button>
```
- **Type**: submit (triggers form submission)
- **Class**: btn (styling)
- **Text**: "Register"
- **Action**: Sends form data to register.php

### 6. Login Link
```html
<p style="margin-top: 15px;">
    Already have an account?
    <a href="login.html" class="log-link">Login</a>
</p>
```
- **Purpose**: Navigation for existing users
- **Link**: Goes to login.html
- **Class**: log-link (grey text with hover effect)

## JavaScript Validation

### Password Matching Script
```javascript
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm').value;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
    }
});
```

**Functionality**:
1. **Event Listener**: Listens for form submission
2. **Get Values**: Retrieves password and confirm values
3. **Comparison**: Checks if passwords match
4. **Prevention**: Stops submission if mismatch
5. **Alert**: Shows error message to user
6. **User Experience**: Prevents server round-trip for validation

## Data Flow

### 1. User Input
User fills in four fields:
```
Full Name: John Doe
Email: john@example.com
Password: SecurePass123
Confirm Password: SecurePass123
```

### 2. Client-Side Validation
**HTML5 Validation**:
- All fields required
- Email format checked
- Cannot submit with empty fields

**JavaScript Validation**:
- Passwords must match
- Alert shown if mismatch
- Form prevented from submitting

### 3. Form Submission
If validation passes:
```
POST → register.php
{
    fullname: "John Doe",
    email: "john@example.com",
    password: "SecurePass123",
    confirm: "SecurePass123"
}
```

### 4. Server Processing
`register.php` handles:
- Password matching check (double verification)
- Email uniqueness verification
- Password hashing
- Database insertion
- Success/failure response

## Validation Layers

### Layer 1: HTML5 Browser Validation
```html
required
type="email"
```
- Prevents empty fields
- Checks email format
- Built-in browser validation

### Layer 2: JavaScript Validation
```javascript
if (password !== confirm) {
    e.preventDefault();
    alert('Passwords do not match!');
}
```
- Client-side password matching
- Immediate user feedback
- Prevents unnecessary server requests

### Layer 3: Server-Side Validation (register.php)
- Password matching re-check
- Email duplication check
- SQL injection prevention
- Data sanitization

## Security Features

### 1. Password Masking
```html
<input type="password">
```
- Hides password characters
- Prevents shoulder surfing
- Visual security

### 2. POST Method
```html
method="POST"
```
- Data not in URL
- More secure than GET
- Cannot be bookmarked

### 3. Required Fields
```html
required
```
- Forces user input
- Prevents empty submissions
- Client-side enforcement

### 4. Email Validation
```html
type="email"
```
- Validates email format
- Browser-level checking
- Ensures proper format

### 5. Password Confirmation
- Prevents typing errors
- Double verification
- Reduces user mistakes

## User Experience Features

### Visual Design
1. **Clean Layout**: Centered white container
2. **Clear Labels**: Each field labeled
3. **Placeholders**: Guide user input
4. **Hover Effects**: Interactive feedback
5. **Button Styling**: Attractive call-to-action

### User Guidance
1. **Subtitle**: "Register to Vote" explains purpose
2. **Placeholders**: Show expected input
3. **Required Markers**: All fields mandatory
4. **Navigation Link**: Easy path to login

### Error Prevention
1. **Client-side validation**: Immediate feedback
2. **Required fields**: Cannot skip
3. **Format validation**: Email must be valid
4. **Password matching**: Alerts user immediately

## Styling (from style.css)

### Container
```css
.container {
    width: 600px;
    background: white;
    border-radius: 20px;
    padding: 25px;
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

### Submit Button
```css
.btn {
    background: rgb(243, 162, 96);  /* Orange */
}
.btn:hover {
    background: rgb(95, 192, 95);   /* Green on hover */
}
```

## Registration Flow

### Success Path
```
User fills form
    ↓
JavaScript validates (passwords match)
    ↓
Submits to register.php
    ↓
PHP validates (email unique, passwords match)
    ↓
Hashes password
    ↓
Inserts into database
    ↓
Redirects to registration-success.html
    ↓
Auto-redirects to login.html
```

### Failure Paths

**Client-Side Failures**:
1. Empty field → Browser prevents submission
2. Invalid email → Browser shows error
3. Passwords don't match → JavaScript alert

**Server-Side Failures**:
1. Email exists → JavaScript alert, stay on page
2. Passwords mismatch → JavaScript alert, stay on page

## File Dependencies

### CSS
- **style.css**: All visual styling

### PHP Backend
- **register.php**: Processes registration

### Navigation
- **login.html**: For existing users

### Success Page
- **registration-success.html**: Confirmation page

## Integration with System

### Input
- User-provided registration data
- Four fields of information

### Processing
- Client-side validation (JavaScript)
- Server-side processing (register.php)
- Database insertion

### Output
- Success: → registration-success.html → login.html
- Failure: Alert message, stay on page

## Best Practices Implemented

1. **Progressive Enhancement**: Works without JavaScript
2. **Validation Layers**: Multiple levels of checking
3. **Security**: Password masking, POST method
4. **Accessibility**: Labels linked to inputs
5. **User Feedback**: Clear error messages
6. **Responsive Design**: Mobile-friendly
7. **Clear Navigation**: Link to login page

## Technical Specifications

- **Form Method**: POST
- **Form Action**: register.php
- **Input Types**: text, email, password
- **Validation**: HTML5 + JavaScript
- **Character Encoding**: UTF-8
- **Viewport**: Responsive
- **JavaScript**: Event listener for validation

## Common User Scenarios

### New User Registration
1. Opens registration.html
2. Fills in name and email
3. Creates password
4. Confirms password
5. Clicks Register
6. Gets confirmation message
7. Redirected to login page

### Password Mismatch
1. Enters different passwords
2. Clicks Register
3. Sees alert: "Passwords do not match!"
4. Re-enters matching passwords
5. Successfully submits

### Email Already Exists
1. Enters existing email
2. Submits form
3. PHP checks database
4. Alert: "Email already registered!"
5. User must use different email

