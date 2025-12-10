# login.php Documentation

## File Purpose
`login.php` is the **server-side authentication script** that verifies user credentials, checks voting status, and manages user sessions. It processes login form data from `login.html` and redirects users based on authentication results.

## File Type
PHP (Backend - Authentication Logic)

## Key Components

### 1. Session Management
```php
session_start();
```
- **Purpose**: Initiates or resumes PHP session
- **Function**: Allows storing user data across pages
- **Location**: Must be at the very beginning
- **Why Important**: Enables logged-in state tracking

### 2. Error Reporting Configuration
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```
- **E_ALL**: Reports all types of errors
- **display_errors**: Shows errors on page
- **Purpose**: Debugging during development
- **Production Note**: Should be disabled in live environment

### 3. Database Connection

#### Connection Setup
```php
$conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
```
- **Technology**: PDO (PHP Data Objects)
- **Host**: localhost (same server)
- **Port**: 3307 (MySQL port)
- **Database**: voting_system
- **Username**: root
- **Password**: empty string

#### Error Mode Configuration
```php
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```
- **Purpose**: Enables exception handling for database errors
- **Benefit**: Better error catching with try-catch

### 4. Form Data Processing

#### Request Method Check
```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
```
- **Purpose**: Ensures data came from form submission
- **Security**: Prevents direct URL access
- **Method**: Only processes POST requests

#### Data Retrieval and Sanitization
```php
$email = trim($_POST['email']);
$votername = trim($_POST['votername']);
$password = trim($_POST['password']);
```
- **$_POST**: Superglobal array containing form data
- **trim()**: Removes leading/trailing whitespace
- **Purpose**: Clean user input

### 5. Database Query - User Lookup

#### SQL Query
```php
$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->execute();
```

**Breakdown**:
- **SELECT ***: Retrieves all columns
- **FROM users**: From users table
- **WHERE email = :email**: Filters by email (placeholder prevents SQL injection)
- **LIMIT 1**: Returns maximum one record
- **prepare()**: Prepares statement (security)
- **bindParam()**: Binds parameter safely
- **execute()**: Runs the query

### 6. Authentication Logic

#### Step 1: Email Verification
```php
if ($stmt->rowCount() === 1) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
```
- **rowCount()**: Checks if email exists
- **fetch()**: Retrieves user data as associative array
- **FETCH_ASSOC**: Returns array with column names as keys

#### Step 2: Name Verification
```php
if (strtolower($user['fullname']) !== strtolower($votername)) {
    header("Location: login-unsuccess.html");
    exit();
}
```
- **strtolower()**: Case-insensitive comparison
- **Compares**: Database fullname with entered votername
- **Failure**: Redirects to error page
- **exit()**: Stops script execution

#### Step 3: Password Verification
```php
if (password_verify($password, $user['password'])) {
```
- **password_verify()**: Secure password checking
- **Function**: Compares plain text with hashed password
- **Security**: Uses PHP's built-in hashing algorithm
- **Returns**: true if match, false otherwise

#### Step 4: Voting Status Check
```php
if ($user['has_voted'] == 1) {
    header("Location: already-voted.html");
    exit();
}
```
- **has_voted**: Database column (0 or 1)
- **Purpose**: Prevents double voting
- **Action**: Redirects if already voted

### 7. Session Creation

#### Successful Login
```php
$_SESSION['user_id'] = $user['id'];
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['email'] = $user['email'];
$_SESSION['has_voted'] = $user['has_voted'];
```
- **$_SESSION**: Superglobal array for session data
- **Stores**: User ID, full name, email, voting status
- **Purpose**: Maintains logged-in state across pages
- **Persistence**: Available until session ends

### 8. Redirection Logic

#### Success Path
```php
header("Location: login-success.html");
exit();
```
- **Success page**: Shows success message
- **Auto-redirect**: Goes to voting page after 2 seconds

#### Failure Paths
1. **Wrong email**: → `login-unsuccess.html`
2. **Wrong name**: → `login-unsuccess.html`
3. **Wrong password**: → `login-unsuccess.html`
4. **Already voted**: → `already-voted.html`

### 9. Error Handling

#### Try-Catch Block
```php
try {
    // All database operations
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
```
- **try**: Attempts database operations
- **catch**: Handles any PDO exceptions
- **die()**: Stops execution and shows error
- **getMessage()**: Retrieves error details

## Authentication Flow

### Complete Process
```
1. User submits form (login.html)
   ↓
2. POST data received by login.php
   ↓
3. Connect to database
   ↓
4. Query user by email
   ↓
5. Email exists?
   NO → login-unsuccess.html
   YES → Continue
   ↓
6. Name matches?
   NO → login-unsuccess.html
   YES → Continue
   ↓
7. Password correct?
   NO → login-unsuccess.html
   YES → Continue
   ↓
8. Already voted?
   YES → already-voted.html
   NO → Continue
   ↓
9. Create session
   ↓
10. Redirect to login-success.html
    ↓
11. Auto-redirect to vote.html
```

## Security Features

### 1. SQL Injection Prevention
```php
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
```
- **Prepared statements**: Separates SQL from data
- **bindParam()**: Safely inserts user input
- **Protection**: Prevents malicious SQL code

### 2. Password Security
```php
password_verify($password, $user['password'])
```
- **Hashed passwords**: Stored encrypted in database
- **verify()**: Secure comparison method
- **Never stores**: Plain text passwords

### 3. Session Management
- **session_start()**: Secure session handling
- **Session variables**: Server-side storage
- **Protection**: Data not accessible to client

### 4. Input Sanitization
```php
$email = trim($_POST['email']);
```
- **trim()**: Removes extra whitespace
- **Clean input**: Reduces injection risks

### 5. Multi-Level Verification
- Email check
- Name verification
- Password validation
- Voting status check

## Database Interaction

### Users Table Structure (Expected)
```sql
users
- id (Primary Key)
- fullname (VARCHAR)
- email (VARCHAR, UNIQUE)
- password (VARCHAR, HASHED)
- has_voted (BOOLEAN/TINYINT, 0 or 1)
```

### Query Operations
1. **SELECT**: Retrieve user data
2. **No INSERT/UPDATE**: Read-only in this file
3. **Single query**: Efficient database usage

## Error Scenarios and Handling

### 1. Database Connection Failure
```php
catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
```
- **Shows**: Error message
- **Stops**: Script execution

### 2. Invalid Credentials
- **Email not found**: login-unsuccess.html
- **Wrong name**: login-unsuccess.html
- **Wrong password**: login-unsuccess.html

### 3. Already Voted
- **Redirect**: already-voted.html
- **Prevents**: Double voting
- **Shows**: Error message

### 4. Direct Access (No POST)
- **No action**: Script ends silently
- **Protection**: Prevents unauthorized access

## Session Data Storage

### Information Stored
```php
$_SESSION = [
    'user_id' => 1,
    'fullname' => 'John Doe',
    'email' => 'john@example.com',
    'has_voted' => 0
];
```

### Usage in Other Pages
- **vote.html**: Checks if user logged in
- **submit_vote.php**: Uses user_id to record vote
- **Any page**: Can access user information

## Best Practices Implemented

1. **Prepared Statements**: SQL injection prevention
2. **Password Hashing**: Secure password storage
3. **Session Management**: Proper authentication
4. **Error Handling**: Try-catch for exceptions
5. **Input Sanitization**: trim() on user input
6. **Case-Insensitive Comparison**: Name matching
7. **Exit After Redirect**: Prevents further execution

## File Dependencies

### Database
- **Database**: voting_system
- **Table**: users
- **Connection**: MySQL on port 3307

### PHP Extensions Required
- PDO (PHP Data Objects)
- MySQL PDO Driver

### Files Linked
- **Input**: login.html (form source)
- **Output**: 
  - login-success.html (success)
  - login-unsuccess.html (failure)
  - already-voted.html (already voted)

## Configuration Requirements

### Server Requirements
- PHP 7.0+ (password_verify support)
- MySQL/MariaDB database
- PDO extension enabled

### Database Configuration
- Host: localhost
- Port: 3307
- Database: voting_system
- User: root
- Password: (empty)

## Integration with System

### Input
- Receives data from `login.html` form
- POST method with 3 fields

### Processing
- Validates against database
- Creates session on success

### Output
- Redirects to appropriate page
- Stores session data for later use

## Technical Specifications

- **Language**: PHP
- **Database**: MySQL (via PDO)
- **Method**: POST
- **Security**: Prepared statements, password hashing
- **Session**: PHP sessions
- **Error Handling**: Try-catch blocks