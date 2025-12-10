# submit_vote.php Documentation

## File Purpose
`submit_vote.php` is the **core vote processing engine** that handles the actual voting operation. It validates user sessions, prevents double voting, records votes in the database, updates candidate counts, and ensures data integrity through database transactions.

## File Type
PHP (Backend - Vote Processing with Transaction Management)

## Key Components

### 1. Session Management
```php
session_start();
```
- **Purpose**: Continues existing user session
- **Requirement**: User must have logged in
- **Data Access**: Can read $_SESSION variables
- **Timing**: Must be first in script

### 2. Error Reporting
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```
- **E_ALL**: Shows all error types
- **display_errors**: Outputs errors to screen
- **Development**: Useful for debugging
- **Production**: Should be disabled

### 3. Session Authentication Check
```php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
```

**Functionality**:
- **Check**: Is user_id in session?
- **!isset()**: Returns true if NOT set
- **Action**: Redirect to login page
- **exit()**: Stop script execution
- **Purpose**: Ensures only logged-in users can vote

## Database Transaction Process

### 1. Database Connection
```php
$conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```
- **PDO**: PHP Data Objects (secure)
- **Host**: localhost, port 3307
- **Database**: voting_system
- **Error mode**: Throws exceptions

### 2. Begin Transaction
```php
$conn->beginTransaction();
```

**What is a Transaction?**
- **Definition**: Group of database operations treated as single unit
- **Purpose**: All operations succeed together or all fail
- **ACID Properties**:
  - **Atomic**: All or nothing
  - **Consistent**: Database stays valid
  - **Isolated**: Operations don't interfere
  - **Durable**: Changes are permanent

**Why Use Transaction Here?**
- Voting requires THREE operations:
  1. Insert vote record
  2. Update candidate votes count
  3. Mark user as voted
- If any fails, ALL must be reversed
- Prevents partial votes

### 3. Get User ID from Session
```php
$user_id = $_SESSION['user_id'];
```
- **Source**: Session data (from login.php)
- **Type**: Integer (user's database ID)
- **Usage**: Link vote to specific user

## Double-Vote Prevention

### Security Check
```php
$check_sql = "SELECT has_voted FROM users WHERE id = :user_id";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bindParam(":user_id", $user_id);
$check_stmt->execute();
$user = $check_stmt->fetch(PDO::FETCH_ASSOC);

if ($user['has_voted'] == 1) {
    $conn->rollBack();
    header("Location: already_voted.html");
    exit();
}
```

**Process**:
1. **Query**: Get has_voted status from database
2. **Check**: Is has_voted = 1?
3. **If Yes**:
   - Rollback transaction (cancel)
   - Redirect to error page
   - Stop execution
4. **Purpose**: Server-side verification (don't trust client)

**Why Double Check?**
- Session could be manipulated
- Race conditions possible
- Extra security layer

## Form Data Processing

### Request Method Validation
```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
```
- **Checks**: Is this a POST request?
- **Security**: Prevents GET access
- **Purpose**: Only process form submissions

### Candidate Selection Validation
```php
if (!isset($_POST['candidate']) || empty($_POST['candidate'])) {
    $conn->rollBack();
    echo "<script>alert('Please select a candidate!'); window.location.href='vote.html';</script>";
    exit();
}
```

**Validation Steps**:
1. **isset()**: Check if 'candidate' exists
2. **empty()**: Check if value is not empty
3. **If Invalid**:
   - Rollback transaction
   - Show alert
   - Return to vote page
   - Stop execution

### Extract Candidate Name
```php
$candidate_name = trim($_POST['candidate']);
```
- **$_POST['candidate']**: Form data (e.g., "Candidate 1")
- **trim()**: Remove extra spaces
- **Storage**: In $candidate_name variable

## Database Operations (Transaction)

### Operation 1: Insert Vote Record
```php
$vote_sql = "INSERT INTO votes (user_id, candidate_name) VALUES (:user_id, :candidate_name)";
$vote_stmt = $conn->prepare($vote_sql);
$vote_stmt->bindParam(":user_id", $user_id);
$vote_stmt->bindParam(":candidate_name", $candidate_name);
$vote_stmt->execute();
```

**Purpose**:
- **Table**: votes (stores individual vote records)
- **Data Inserted**:
  - user_id: Who voted (e.g., 5)
  - candidate_name: Who they voted for (e.g., "Candidate 1")
- **Why**: Maintains voting history/audit trail

**Example Record**:
```
| id | user_id | candidate_name | voted_at            |
|----|---------|----------------|---------------------|
| 23 | 5       | Candidate 1    | 2025-12-10 14:30:25 |
```

### Operation 2: Update Candidate Vote Count
```php
$update_candidate_sql = "UPDATE candidates SET votes = votes + 1 WHERE name = :candidate_name";
$update_candidate_stmt = $conn->prepare($update_candidate_sql);
$update_candidate_stmt->bindParam(":candidate_name", $candidate_name);
$update_candidate_stmt->execute();
```

**Purpose**:
- **Table**: candidates (stores candidate information)
- **Action**: Increment votes by 1
- **Logic**: votes = votes + 1
- **Condition**: WHERE name matches candidate_name

**Example**:
```
Before: Candidate 1 has 10 votes
After: Candidate 1 has 11 votes
```

**SQL Explanation**:
```sql
-- If candidate has 10 votes
UPDATE candidates SET votes = votes + 1 WHERE name = 'Candidate 1'
-- Result: votes becomes 11 (10 + 1)
```

### Operation 3: Mark User as Voted
```php
$update_user_sql = "UPDATE users SET has_voted = 1 WHERE id = :user_id";
$update_user_stmt = $conn->prepare($update_user_sql);
$update_user_stmt->bindParam(":user_id", $user_id);
$update_user_stmt->execute();
```

**Purpose**:
- **Table**: users
- **Action**: Set has_voted = 1
- **Effect**: Prevents user from voting again
- **Condition**: WHERE id matches user_id

**Example**:
```
Before: has_voted = 0
After: has_voted = 1
```

### Update Session
```php
$_SESSION['has_voted'] = 1;
```
- **Updates**: Session variable
- **Purpose**: Client-side tracking
- **Sync**: Matches database value

### Commit Transaction
```php
$conn->commit();
```

**What Happens**:
- **Finalizes**: All three operations
- **Makes Permanent**: Changes saved to database
- **Cannot Undo**: After commit, changes are permanent

**Transaction Flow**:
```
BEGIN TRANSACTION
    ↓
1. INSERT into votes
    ↓
2. UPDATE candidates (increment votes)
    ↓
3. UPDATE users (set has_voted)
    ↓
COMMIT (All succeed)
```

### Success Redirect
```php
header("Location: vote-success.html");
exit();
```
- **Redirect**: To success page
- **Shows**: Success animation
- **Auto-redirect**: To results page

## Error Handling

### Transaction Rollback
```php
catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    die("Database Error: " . $e->getMessage());
}
```

**Functionality**:
1. **catch**: Handles database errors
2. **inTransaction()**: Check if transaction active
3. **rollBack()**: Undo all changes
4. **die()**: Stop and show error

**What Rollback Does**:
- **Reverses**: All database changes
- **Returns**: Database to state before BEGIN TRANSACTION
- **Example**: If vote insert succeeds but candidate update fails, vote insert is also undone

**Transaction Safety Example**:
```
BEGIN TRANSACTION
    ↓
1. INSERT vote ✓ (Success)
    ↓
2. UPDATE candidate ✗ (ERROR - duplicate key)
    ↓
ROLLBACK
    ↓
Result: Vote insert is UNDONE
Database unchanged as if nothing happened
```

## Complete Voting Flow

### Step-by-Step Process

```
1. User clicks "Submit Vote" on vote.html
   ↓
2. submit_vote.php receives POST data
   ↓
3. Check if user logged in (session exists)
   NO → Redirect to login.html
   YES → Continue
   ↓
4. Connect to database
   ↓
5. Begin transaction
   ↓
6. Double-check if user already voted (database)
   YES → Rollback, redirect to already_voted.html
   NO → Continue
   ↓
7. Check if candidate selected
   NO → Rollback, alert, redirect to vote.html
   YES → Continue
   ↓
8. Insert vote into votes table
   ↓
9. Update candidate votes count (+1)
   ↓
10. Mark user as voted (has_voted = 1)
    ↓
11. Update session variable
    ↓
12. Commit transaction (finalize all changes)
    ↓
13. Redirect to vote-success.html
    ↓
14. Auto-redirect to result.php (2 seconds)
```

## Security Features

### 1. Session Verification
```php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
```
- **Blocks**: Unauthenticated access
- **Requires**: Valid login session

### 2. Double-Vote Prevention
- Database check (has_voted column)
- Session check
- Transaction rollback on duplicate

### 3. SQL Injection Protection
```php
$stmt = $conn->prepare($sql);
$stmt->bindParam(":param", $value);
```
- **Prepared statements**: Separate SQL from data
- **No direct insertion**: User input sanitized

### 4. Transaction Integrity
```php
$conn->beginTransaction();
// ... operations ...
$conn->commit();
```
- **All or nothing**: Prevents partial votes
- **Data consistency**: Database always valid

### 5. POST Method Only
```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
```
- **Blocks**: Direct URL access
- **Requires**: Form submission

## Database Tables Involved

### 1. votes Table
```sql
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_name VARCHAR(255) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```
**Purpose**: Records individual votes

### 2. candidates Table
```sql
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    symbol VARCHAR(255),
    votes INT DEFAULT 0
);
```
**Purpose**: Stores candidate data and vote counts

### 3. users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    has_voted TINYINT DEFAULT 0
);
```
**Purpose**: User accounts and voting status

## Transaction Benefits

### Why Use Transactions?

**Without Transaction**:
```
1. Insert vote ✓ (Success)
2. Update candidate ✗ (Fails)
3. Update user ✓ (Success)

Result: Inconsistent database!
- Vote recorded but candidate not updated
- User marked as voted but vote not counted
```

**With Transaction**:
```
1. Begin Transaction
2. Insert vote ✓
3. Update candidate ✗ (Fails)
4. Rollback

Result: All operations undone, database unchanged
- No inconsistencies
- User can try again
```

## Best Practices Implemented

1. **Session Authentication**: Verify user login
2. **Transaction Management**: Data integrity
3. **Double-Vote Prevention**: Multiple checks
4. **Prepared Statements**: SQL injection protection
5. **Error Handling**: Try-catch with rollback
6. **Exit After Redirect**: Stop execution
7. **Input Validation**: Check candidate selection
8. **Atomic Operations**: All succeed or all fail

## File Dependencies

### Input
- **vote.html**: Source of form data
- **Session**: User authentication data

### Database
- **votes table**: Stores vote records
- **candidates table**: Updates vote counts
- **users table**: Marks users as voted

### Output
- **vote-success.html**: Success page
- **already_voted.html**: Error if already voted
- **vote.html**: Return on validation error
- **login.html**: Redirect if not logged in

## Technical Specifications

- **Language**: PHP
- **Database**: MySQL via PDO
- **Method**: POST
- **Transaction**: ACID compliant
- **Security**: Multiple validation layers
- **Error Handling**: Exception-based
- **Redirection**: Header location

