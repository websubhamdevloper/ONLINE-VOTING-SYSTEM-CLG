# register.php Documentation

## File Purpose
`register.php` is the **server-side registration handler** that processes new user registrations. It validates input data, checks for duplicate emails, hashes passwords securely, and inserts new users into the database.

## File Type
PHP (Backend - Registration Processing)

## Key Components

### 1. Error Reporting Configuration
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```
- **E_ALL**: Reports all error types
- **display_errors**: Shows errors on screen
- **Purpose**: Debugging during development
- **Production**: Should be disabled in live environment

### 2. Database Connection
```php
$conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

**Connection Parameters**:
- **Technology**: PDO (PHP Data Objects)
- **Host**: localhost
- **Port**: 3307 (MySQL port)
- **Database**: voting_system
- **Username**: root
- **Password**: empty string
- **Error Mode**: ERRMODE_EXCEPTION (throws exceptions on errors)

**Why PDO?**
- Secure (prevents SQL injection)
- Supports prepared statements
- Database-independent

### 3. Form Data Retrieval
```php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$confirm = $_POST['confirm'];
```

**Explanation**:
- **$_POST**: Superglobal array containing form data
- **Keys**: Match the `name` attributes from registration.html
- **Variables**: Store data in PHP variables for processing

**Data Retrieved**:
1. `fullname` - User's full name
2. `email` - User's email address
3. `pass` - Password (plain text, temporarily)
4. `confirm` - Confirmation password

### 4. Password Matching Validation
```php
if ($pass !== $confirm) {
    echo "<script>alert('Passwords do not match!'); window.location.href='registration.html';</script>";
    exit();
}
```

**Functionality**:
- **Comparison**: Checks if password and confirm match
- **!==**: Strict comparison (type and value)
- **If Mismatch**: Shows JavaScript alert
- **Redirect**: Returns user to registration page
- **exit()**: Stops script execution

**Security Note**: This is a server-side double-check even though JavaScript validates on client-side.

### 5. Password Hashing
```php
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
```

**Explanation**:
- **password_hash()**: PHP function for secure hashing
- **$pass**: Plain text password
- **PASSWORD_DEFAULT**: Uses bcrypt algorithm (current best practice)
- **Result**: One-way encrypted hash

**Example**:
```
Plain: "MyPassword123"
Hashed: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
```

**Security Benefits**:
- Cannot reverse hash to get original password
- Each hash is unique (salt added automatically)
- Secure against rainbow table attacks

### 6. Email Duplication Check

#### Query Preparation
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
```

**Breakdown**:
- **prepare()**: Creates prepared statement
- **SELECT ***: Retrieves all columns
- **WHERE email = ?**: Placeholder prevents SQL injection
- **execute([$email])**: Binds and runs query
- **Purpose**: Checks if email already registered

#### Duplicate Check Logic
```php
if ($stmt->rowCount() > 0) {
    echo "<script>alert('Email already registered!'); window.location.href='registration.html';</script>";
}
```
- **rowCount()**: Returns number of matching rows
- **> 0**: Email found in database
- **Action**: Alert user and redirect back
- **Purpose**: Prevents duplicate accounts

### 7. User Insertion

#### Insert Query
```php
else {
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$fullname, $email, $hashed_password]);
    
    header("Location: registration-sucess.html");
    exit();
}
```

**Breakdown**:
- **INSERT INTO**: SQL command to add data
- **users**: Target table
- **Columns**: fullname, email, password
- **VALUES (?, ?, ?)**: Placeholders for data
- **execute()**: Binds data and inserts
- **Data**: Full name, email, hashed password

**After Success**:
- Redirects to registration-success.html
- exit() stops further execution

### 8. Error Handling
```php
catch(PDOException $e) {
    echo "PHP Error: " . htmlspecialchars($e->getMessage());
}
```

**Functionality**:
- **catch**: Handles database exceptions
- **PDOException**: Specific to database errors
- **getMessage()**: Gets error description
- **htmlspecialchars()**: Prevents XSS attacks
- **Purpose**: Graceful error handling

## Complete Registration Flow

### Step-by-Step Process

```
1. User submits registration form
   ↓
2. PHP receives POST data
   ↓
3. Extract form values
   ↓
4. Check if passwords match
   YES → Continue
   NO → Alert + Redirect to registration.html
   ↓
5. Hash the password
   ↓
6. Connect to database
   ↓
7. Check if email exists
   EXISTS → Alert + Redirect to registration.html
   NOT EXISTS → Continue
   ↓
8. Insert new user record
   ↓
9. Redirect to registration-success.html
   ↓
10. Auto-redirect to login.html (2 seconds)
```

## Database Operations

### Users Table Structure (Expected)
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    has_voted TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Operations Performed

#### 1. SELECT Query
```sql
SELECT * FROM users WHERE email = ?
```
- **Purpose**: Check for duplicate email
- **Returns**: User record if exists

#### 2. INSERT Query
```sql
INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)
```
- **Purpose**: Add new user
- **Inserts**: Name, email, hashed password
- **Auto-generated**: id, has_voted (default 0), created_at

## Security Features

### 1. SQL Injection Prevention
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
```
- **Prepared statements**: Separates SQL from data
- **Placeholders**: ? replaced safely
- **Protection**: Malicious input cannot alter query

### 2. Password Security
```php
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
```
- **One-way hashing**: Cannot decrypt
- **Bcrypt algorithm**: Industry standard
- **Automatic salting**: Each hash unique
- **Never stores**: Plain text passwords

### 3. Cross-Site Scripting (XSS) Prevention
```php
htmlspecialchars($e->getMessage())
```
- **Escapes**: HTML special characters
- **Prevents**: Malicious script injection
- **Protection**: Error messages safe to display

### 4. Double Password Verification
- Client-side: JavaScript validation
- Server-side: PHP validation
- **Redundancy**: Extra security layer

### 5. Email Uniqueness
- Database constraint (UNIQUE)
- PHP validation check
- Prevents duplicate accounts

## Error Scenarios and Responses

### 1. Passwords Don't Match
```
User Input: password="Pass123", confirm="Pass456"
Response: Alert "Passwords do not match!"
Action: Redirect to registration.html
```

### 2. Email Already Exists
```
User Input: email="existing@email.com"
Database: Email found
Response: Alert "Email already registered!"
Action: Redirect to registration.html
```

### 3. Database Connection Error
```
Error: Cannot connect to MySQL
Response: "PHP Error: SQLSTATE[HY000] [2002] Connection refused"
Action: Script stops
```

### 4. Successful Registration
```
User Input: Valid unique data
Database: User inserted successfully
Response: Redirect to registration-success.html
Action: Show success animation, redirect to login
```

## JavaScript Alerts Explained

### Alert Function
```php
echo "<script>alert('Message'); window.location.href='page.html';</script>";
```

**Components**:
1. **echo**: Outputs to browser
2. **<script>**: Embeds JavaScript
3. **alert()**: Shows popup message
4. **window.location.href**: Redirects page
5. **</script>**: Closes script tag

**User Experience**:
- Popup appears with message
- User clicks OK
- Browser redirects to specified page

## Data Sanitization

### Current Implementation
```php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
```

**Note**: No explicit sanitization, but:
- Prepared statements prevent SQL injection
- password_hash() handles password securely
- Email format validated on client-side

### Recommended Addition (Best Practice)
```php
$fullname = trim(htmlspecialchars($_POST['fullname']));
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
```

## Integration with System

### Input Source
- **File**: registration.html
- **Method**: POST
- **Data**: fullname, email, password, confirm

### Processing
- Validates password match
- Hashes password
- Checks email uniqueness
- Inserts user into database

### Output Destinations
- **Success**: registration-success.html
- **Failure**: registration.html (with alert)
- **Error**: Error message displayed

### Database Impact
- **Table**: users
- **Action**: INSERT new record
- **Fields**: fullname, email, hashed password

## Best Practices Implemented

1. **Prepared Statements**: SQL injection prevention
2. **Password Hashing**: Secure password storage
3. **Email Validation**: Duplicate prevention
4. **Error Handling**: Try-catch for exceptions
5. **User Feedback**: Alerts for errors
6. **Redirection**: Proper flow control
7. **Exit Commands**: Stop after redirect

## Configuration Requirements

### PHP Version
- **Minimum**: PHP 5.5+ (for password_hash)
- **Recommended**: PHP 7.4+ or 8.x

### PHP Extensions
- PDO extension
- PDO MySQL driver

### Database Requirements
- MySQL or MariaDB
- voting_system database created
- users table created

### Server Configuration
```
host: localhost
port: 3307
database: voting_system
username: root
password: (empty)
```

## File Dependencies

### Input
- **registration.html**: Provides form data

### Output
- **registration-success.html**: Success page
- **registration.html**: Return on error

### Database
- **Table**: users
- **Connection**: MySQL via PDO

## Technical Specifications

- **Language**: PHP
- **Database**: MySQL (via PDO)
- **Method**: POST
- **Security**: Prepared statements, password hashing
- **Validation**: Password match, email uniqueness
- **Redirection**: JavaScript location.href
- **Error Handling**: Try-catch with PDOException

