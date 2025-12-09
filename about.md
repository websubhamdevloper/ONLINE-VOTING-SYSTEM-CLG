# 🗳️ Online Voting System

A secure, web-based voting platform that allows users to register, authenticate, cast votes, and view real-time election results. Built with PHP, MySQL, and vanilla JavaScript.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [Installation & Setup](#installation--setup)
- [Database Schema](#database-schema)
- [File Descriptions](#file-descriptions)
- [Security Features](#security-features)
- [Known Bugs & Issues](#known-bugs--issues)
- [Contributing](#contributing)

## 🎯 Overview

This Online Voting System is a full-stack web application designed to facilitate democratic elections in a digital environment. Users can create accounts, securely log in, cast their votes for candidates, and view aggregated results with visual representations including vote percentages and rankings.

The system prevents duplicate voting and maintains data integrity through session management and database constraints.

## ✨ Features

- **User Registration**: New users can create accounts with email verification
- **Secure Authentication**: Password hashing using PHP's `password_hash()` function
- **Session Management**: Maintains user login state throughout the voting process
- **One Vote Per User**: Prevents duplicate voting through database flags
- **Real-time Results**: Dynamic result page showing winner and runners-up
- **Visual Feedback**: Animated success/error messages for all user actions
- **Responsive Design**: Clean, centered UI with hover effects and animations
- **Vote Tracking**: Complete audit trail of all votes cast
- **Auto-redirect**: Seamless navigation between pages after actions

## 🛠️ Technologies Used

### Frontend
- **HTML5**: Semantic markup for page structure
- **CSS3**: Custom styling with animations, transitions, and flexbox layouts
- **JavaScript (Vanilla)**: Form validation and client-side interactivity

### Backend
- **PHP 7.4+**: Server-side logic and business rules
- **PDO (PHP Data Objects)**: Secure database interactions with prepared statements
- **Session Management**: PHP sessions for user authentication state

### Database
- **MySQL**: Relational database for storing users, candidates, and votes
- **Port**: 3307 (custom port configuration)

### Server
- **XAMPP/WAMP/MAMP**: Local development environment (recommended)
- **Apache**: Web server
- **phpMyAdmin**: Database management interface

## 📁 Project Structure

```
online-voting-system/
│
├── index.html                  # Landing page with login/register options
├── login.html                  # User login form
├── login.php                   # Login authentication logic
├── login-success.html          # Successful login confirmation
├── login-unsuccess.html        # Failed login message
├── registration.html           # New user registration form
├── register.php                # Registration processing logic
├── registration-sucess.html    # Successful registration confirmation
├── vote.html                   # Voting interface with candidate options
├── submit_vote.php             # Vote submission and processing
├── vote-success.html           # Vote confirmation page
├── already-voted.html          # Message for users who already voted
├── result.php                  # Live results display with rankings
├── style.css                   # Global styles and animations
│
└── assets/                     # Images and logos (not shown in files)
    ├── image.webp
    ├── 15584897.webp
    ├── vote-button.webp
    ├── Python_(programming_language)-Logo.wine.webp
    ├── php-logo-png_seeklogo-108601.png
    └── javascript-web-development-for-app-mobile-4.png
```

## 💾 Database Schema

### Tables Required

#### 1. `users` Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    has_voted TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 2. `candidates` Table
```sql
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    symbol VARCHAR(255) NOT NULL,
    votes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3. `votes` Table
```sql
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_name VARCHAR(255) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Sample Data for `candidates` Table
```sql
INSERT INTO candidates (name, symbol, votes) VALUES
('Candidate 1', 'Python_(programming_language)-Logo.wine.webp', 0),
('Candidate 2', 'php-logo-png_seeklogo-108601.png', 0),
('Candidate 3', 'javascript-web-development-for-app-mobile-4.png', 0);
```

## 🚀 Installation & Setup

### Prerequisites
- XAMPP/WAMP/MAMP installed
- MySQL running on port 3307 (or modify connection strings to port 3306)
- PHP 7.4 or higher

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/online-voting-system.git
   cd online-voting-system
   ```

2. **Setup Database**
   - Open phpMyAdmin
   - Create a new database named `voting_system`
   - Import the SQL schema or run the CREATE TABLE statements from above
   - Insert sample candidate data

3. **Configure Database Connection**
   - If using MySQL on port 3306, update the connection strings in:
     - `register.php`
     - `login.php`
     - `submit_vote.php`
     - `result.php`
   - Change `port=3307` to `port=3306` or remove the port parameter

4. **Start Server**
   - Place project folder in `htdocs` (XAMPP) or `www` (WAMP)
   - Start Apache and MySQL services
   - Navigate to `http://localhost/online-voting-system/`

5. **Test the System**
   - Register a new user
   - Login with credentials
   - Cast a vote
   - View results

## 📄 File Descriptions

### Frontend Files

**`index.html`**
- Landing page of the application
- Provides two main options: Login or Register
- Features a centered container with voting logo

**`login.html`**
- User authentication form
- Requires: Email/Username, Voter's Name, Password
- Client-side validation before submission

**`registration.html`**
- New user registration form
- Collects: Full Name, Email, Password, Confirm Password
- JavaScript validation for password matching

**`vote.html`**
- Main voting interface
- Displays three candidates with their symbols
- Radio button selection for candidate choice
- Form validation ensures a candidate is selected

**`login-success.html`, `login-unsuccess.html`**
- Visual feedback pages with animated checkmark/cross
- Auto-redirect after 2-4 seconds

**`registration-sucess.html`**
- Registration confirmation with animated checkmark
- Redirects to login page

**`vote-success.html`**
- Vote confirmation page
- Redirects to results page after 2 seconds

**`already-voted.html`**
- Displayed when a user attempts to vote twice
- Redirects to results page

**`result.php`**
- Dynamic results display
- Shows winner with trophy emoji and 🥇 badge
- Displays first and second runners-up with 🥈 and 🥉
- Animated progress bars showing vote percentages
- Real-time vote counts and total votes cast

### Backend Files

**`register.php`**
- Processes new user registrations
- Validates password matching
- Checks for duplicate email addresses
- Hashes passwords using `PASSWORD_DEFAULT` algorithm
- Inserts new user into database

**`login.php`**
- Authenticates users against database
- Verifies email, voter name, and password
- Uses `password_verify()` for secure password checking
- Checks if user has already voted
- Creates PHP session for authenticated users
- Redirects based on authentication result

**`submit_vote.php`**
- Handles vote submission
- Verifies user is logged in via session
- Double-checks voting status (prevents race conditions)
- Uses database transactions for data integrity
- Updates three tables: `votes`, `candidates`, `users`
- Marks user as voted in session and database

### Styling

**`style.css`**
- Consistent design language across all pages
- Centered flex-based layout
- Hover effects with translateY transforms
- Animated success/error indicators
- Responsive design considerations
- Vote bar animations with smooth transitions
- Color-coded sections for winner and runners-up

## 🔒 Security Features

1. **Password Hashing**: All passwords stored using PHP's `password_hash()` with bcrypt
2. **Prepared Statements**: PDO with parameter binding prevents SQL injection
3. **Session Management**: Secure session handling for user authentication
4. **Duplicate Vote Prevention**: Database flag and session checks
5. **Transaction Integrity**: Database transactions ensure atomic operations
6. **Input Sanitization**: `htmlspecialchars()` used on output to prevent XSS
7. **Error Handling**: Try-catch blocks for database operations

## 🐛 Known Bugs & Issues

1. **Session Timeout**: No automatic session expiration handling - users remain logged in indefinitely until browser closes

2. **Browser Back Button**: Users can navigate back after voting using browser's back button (though they cannot vote again due to database checks)

3. **Concurrent Voting**: Potential race condition if the same user submits votes simultaneously from multiple browser tabs

4. **Email Validation**: Only basic HTML5 validation; no actual email verification sent to user's inbox

5. **Password Requirements**: No enforced complexity rules (minimum length, special characters, uppercase, etc.)

6. **Image Loading**: No fallback UI if candidate symbol images fail to load or are missing

7. **Mobile Responsiveness**: Some layout issues on very small screens (< 480px width)

8. **Database Port**: Hardcoded port 3307 may cause connection issues on standard MySQL installations (which use port 3306)

9. **No Logout Feature**: Users cannot manually log out; must close browser to end session

10. **Hardcoded Candidates**: Candidate list is hardcoded in `vote.html`; cannot add/remove candidates without modifying source code

11. **Generic Error Messages**: Login/registration errors don't specify whether email, password, or name was incorrect (this is by design for security, but could frustrate legitimate users)

12. **No Database Connection Validation**: If database is down, error messages may expose database details to users

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Areas for Contribution
- Bug fixes for issues listed above
- UI/UX improvements
- Additional security features
- Admin panel development
- Mobile responsiveness enhancements
- Documentation improvements

## 📧 Contact

For questions, issues, or suggestions, please open an issue on GitHub or contact the maintainers.

---

**Note**: This is an educational project. For production use, additional security measures and testing are strongly recommended.