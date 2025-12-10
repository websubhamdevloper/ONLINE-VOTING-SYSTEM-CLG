# vote.html Documentation

## File Purpose
`vote.html` is the **main voting interface** where authenticated users can view candidates and cast their vote. This is the core functionality page of the voting system where the actual voting happens.

## File Type
HTML (Frontend - Voting Interface)

## Key Components

### 1. HTML Document Structure
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting-area</title>
    <link rel="stylesheet" href="style.css">
</head>
```
- **HTML5 standard** structure
- **UTF-8 encoding** for character support
- **Responsive viewport** for mobile devices
- **Title**: "Voting-area"
- **Stylesheet**: Links to style.css

### 2. Main Container
```html
<div class="container">
    <h1>VOTING AREA</h1>
    <p class="subtitle">Make Your Choice Wisely</p>
</div>
```
- **Container class**: White background with rounded corners
- **Heading**: Clearly identifies the page purpose
- **Subtitle**: Provides guidance to users

### 3. Voting Image
```html
<div class="image-voting">
    <img src="vote-button.webp" alt="vote-logo">
</div>
```
- **Image**: Visual representation of voting
- **File**: vote-button.webp
- **Size**: 120x120 pixels (from CSS)
- **Purpose**: Enhances visual appeal

### 4. Voting Form
```html
<form action="submit_vote.php" method="POST">
```
- **Action**: Submits vote to `submit_vote.php`
- **Method**: POST (secure data transmission)
- **Purpose**: Handles vote submission

## Candidates Section

### Vote Options Container
```html
<div class="vote-options">
```
- **Class**: vote-options
- **Display**: Flexbox layout (horizontal arrangement)
- **Gap**: 20px spacing between candidates
- **Purpose**: Holds all candidate options

### Candidate 1 - Python
```html
<label class="candidates">
    <input type="radio" name="candidate" value="Candidate 1">
    <img src="Python_(programming_language)-Logo.wine.webp" class="symbol">
    <span>Candidate 1</span>
</label>
```

**Components**:
- **Label**: Clickable area (entire card)
- **Radio Input**: 
  - Type: radio (only one selectable)
  - Name: candidate (groups all options)
  - Value: "Candidate 1" (sent to PHP)
  - Display: none (hidden via CSS)
- **Symbol**: Python logo image (80x80 pixels)
- **Text**: "Candidate 1" name display

### Candidate 2 - PHP
```html
<label class="candidates">
    <input type="radio" name="candidate" value="Candidate 2">
    <img src="php-logo-png_seeklogo-108601.png" class="symbol">
    <span>Candidate 2</span>
</label>
```

**Components**:
- Radio input for Candidate 2
- PHP logo as symbol
- Candidate name display

### Candidate 3 - JavaScript
```html
<label class="candidates">
    <input type="radio" name="candidate" value="Candidate 3">
    <img src="javascript-web-development-for-app-mobile-4.png" class="symbol">
    <span>Candidate 3</span>
</label>
```

**Components**:
- Radio input for Candidate 3
- JavaScript logo as symbol
- Candidate name display

### Submit Button
```html
<button type="submit" class="btn">Submit Vote</button>
```
- **Type**: submit (triggers form submission)
- **Class**: btn (orange button with hover effects)
- **Text**: "Submit Vote"
- **Action**: Sends selected candidate to submit_vote.php

## JavaScript Validation

### Form Submission Validation
```javascript
document.querySelector('form').addEventListener('submit', function(e) {
    const selected = document.querySelector('input[name="candidate"]:checked');
    if (!selected) {
        e.preventDefault();
        alert('Please select a candidate before voting!');
    }
});
```

**Functionality Breakdown**:

1. **Event Listener**: Monitors form submission
   ```javascript
   document.querySelector('form').addEventListener('submit', ...)
   ```

2. **Check Selection**: Looks for checked radio button
   ```javascript
   const selected = document.querySelector('input[name="candidate"]:checked');
   ```
   - `:checked` pseudo-selector finds selected radio
   - Returns null if none selected

3. **Validation Logic**: 
   ```javascript
   if (!selected) {
       e.preventDefault();
       alert('Please select a candidate before voting!');
   }
   ```
   - **!selected**: No candidate chosen
   - **preventDefault()**: Stops form submission
   - **alert()**: Shows error message

4. **User Experience**: Prevents submission without selection

## Radio Button Behavior

### How Radio Buttons Work
```html
<input type="radio" name="candidate" value="Candidate 1">
<input type="radio" name="candidate" value="Candidate 2">
<input type="radio" name="candidate" value="Candidate 3">
```

**Properties**:
- **Same name attribute**: Groups buttons together
- **Only one selectable**: Selecting one deselects others
- **Value attribute**: Data sent to server
- **Hidden**: CSS hides actual radio button

### Visual Selection
- **Clicking card**: Selects that candidate
- **Hover effect**: Card lifts up (translateY)
- **Visual feedback**: User knows selection made

## Data Flow

### 1. User Interaction
```
User views three candidates
    ↓
Clicks on a candidate card
    ↓
Radio button selected (hidden but functional)
    ↓
Clicks "Submit Vote" button
```

### 2. JavaScript Validation
```
Form submission triggered
    ↓
JavaScript checks for selection
    ↓
IF no selection:
    - Show alert
    - Prevent submission
    ↓
IF selection exists:
    - Allow submission
    - Continue to server
```

### 3. Data Submission
```
POST → submit_vote.php
{
    candidate: "Candidate 1"  // or 2, or 3
}
```

### 4. Server Processing
```
submit_vote.php receives data
    ↓
Validates user session
    ↓
Checks if already voted
    ↓
Records vote in database
    ↓
Updates candidate vote count
    ↓
Marks user as voted
    ↓
Redirects to vote-success.html
```

## Styling Features

### Candidate Cards
```css
.candidates {
    width: 200px;
    padding: 20px;
    background: #fafafa;
    border: 2px solid #ddd;
    border-radius: 15px;
    cursor: pointer;
    transition: 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
```

**Visual Effects**:
- Light grey background
- Rounded corners
- Shadow for depth
- Pointer cursor on hover

### Hover Animation
```css
.candidates:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
}
```
- Card lifts 5px upward
- Shadow increases
- Smooth transition

### Active State
```css
.candidates:active {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -5px rgba(0, 0, 0, 0.1);
}
```
- Click feedback
- Slightly reduced shadow

### Symbol Styling
```css
.candidates .symbol {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
    object-fit: contain;
}
```
- Fixed size (80x80)
- Maintains aspect ratio
- Centered in card

### Layout
```css
.vote-options {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}
```
- Flexbox layout
- Horizontal arrangement
- 20px spacing between cards
- Centered on page

## Security Considerations

### Client-Side Protection
1. **Radio button grouping**: Only one vote possible
2. **JavaScript validation**: Prevents empty submission
3. **POST method**: Data not in URL

### Server-Side (submit_vote.php)
1. **Session verification**: User must be logged in
2. **Double-vote prevention**: Checks has_voted status
3. **Database transaction**: Ensures data integrity

## User Experience Features

### Visual Feedback
1. **Hover effects**: Cards lift on hover
2. **Cursor change**: Pointer indicates clickable
3. **Shadow animation**: Depth perception
4. **Image symbols**: Easy identification

### Error Prevention
1. **JavaScript alert**: Warns if no selection
2. **Form blocked**: Cannot submit empty
3. **Clear instruction**: "Make Your Choice Wisely"

### Accessibility
1. **Labels**: Entire card clickable
2. **Alt text**: Images have descriptions
3. **Clear layout**: Easy to understand
4. **Large click targets**: 200px wide cards

## Integration with System

### Prerequisites
- User must be logged in (session active)
- User must not have voted yet
- Accessed via login-success.html

### Input
- User selection via radio button
- One of three candidates

### Processing
- JavaScript validates selection
- POST data to submit_vote.php

### Output
- Success: vote-success.html → result.php
- Error: Stays on page with alert
- Already voted: already-voted.html

## File Dependencies

### CSS
- **style.css**: All visual styling

### Images
- **vote-button.webp**: Voting icon
- **Python logo**: Candidate 1 symbol
- **PHP logo**: Candidate 2 symbol
- **JavaScript logo**: Candidate 3 symbol

### PHP Backend
- **submit_vote.php**: Processes vote submission

### Related Pages
- **login-success.html**: Previous page
- **vote-success.html**: Success redirect
- **already-voted.html**: If already voted

## Candidate Configuration

### Current Setup
```
Candidate 1: Python (Programming Language)
Candidate 2: PHP (Programming Language)
Candidate 3: JavaScript (Programming Language)
```

### Customization
To change candidates:
1. Update value attribute
2. Change symbol image
3. Update span text
4. Ensure database has matching entries

## Form Structure

### Complete Form Code
```html
<form action="submit_vote.php" method="POST">
    <div class="vote-options">
        <!-- 3 candidate labels with radio inputs -->
    </div>
    <button type="submit" class="btn">Submit Vote</button>
</form>
```

**Components**:
- Form wrapper with action and method
- Vote options container
- Three candidate choices
- Submit button

## Best Practices Implemented

1. **Semantic HTML**: Proper use of form elements
2. **Accessibility**: Labels for clickable areas
3. **Validation**: JavaScript prevents errors
4. **User Feedback**: Hover effects and alerts
5. **Security**: POST method, server validation
6. **Responsive**: Mobile-friendly layout
7. **Visual Design**: Clear, attractive interface

## Technical Specifications

- **Form Method**: POST
- **Form Action**: submit_vote.php
- **Input Type**: radio
- **Validation**: JavaScript client-side
- **Layout**: CSS Flexbox
- **Images**: WebP and PNG formats
- **JavaScript**: Event listener validation

