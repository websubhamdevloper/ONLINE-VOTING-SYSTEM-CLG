# style.css Documentation

## File Purpose
`style.css` is the **master stylesheet** that defines all visual styling, layouts, animations, and responsive design for the entire Online Voting System. It creates a cohesive, modern, and professional user interface.

## File Type
CSS (Cascading Style Sheets)

---

## Global Body Styling

```css
body {
    margin: 0;
    padding: 0;
    background: #EBF8FF;
    font-family: Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
```

### Properties Explained

**Margin & Padding**: 
- `margin: 0; padding: 0;` - Removes default browser spacing

**Background**:
- `#EBF8FF` - Light blue color (calm, professional)
- RGB: (235, 248, 255)

**Font Family**:
- Arial - Clean, readable sans-serif font
- sans-serif - Fallback font family

**Min-Height**:
- `100vh` - 100% of viewport height
- Ensures full-screen coverage

**Flexbox Layout**:
- `display: flex` - Enables flexbox
- `justify-content: center` - Centers horizontally
- `align-items: center` - Centers vertically
- **Result**: Perfect centering on all screen sizes

---

## Container Styles

### Main Container (.container)

```css
.container {
    width: 600px;
    margin: 0;
    text-align: center;
    padding: 25px;
    background: white;
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
```

**Dimensions**:
- Width: 600px (fixed, but responsive via flexbox)
- Padding: 25px all around

**Appearance**:
- Background: white (clean contrast)
- Border-radius: 20px (rounded corners)
- Text-align: center (centered content)

**Transition**:
- `transform 0.3s ease` - Smooth movement animation
- `box-shadow 0.3s ease` - Smooth shadow animation
- Duration: 0.3 seconds
- Easing: ease (natural acceleration/deceleration)

### Container Hover Effect

```css
.container:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

**Transform**:
- `translateY(-5px)` - Moves up 5 pixels
- Creates floating effect

**Box-Shadow** (layered):
1. First shadow: Large, soft (20px blur)
2. Second shadow: Medium, subtle (10px blur)
3. Result: Depth perception

### Login Container (.container-login)

```css
.container-login {
    width: 600px;
    margin: 0;
    text-align: center;
    padding: 25px;
    background: white;
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.container-login:hover {
    /* Same hover effect as .container */
}
```

**Purpose**: Separate class for login page
**Styling**: Identical to `.container`
**Reason**: Allows future customization without affecting other pages

---

## Typography Styles

### Subtitle

```css
.subtitle {
    margin-top: -10px;
    font-style: italic;
}
```

- **Negative margin**: Pulls text closer to heading above
- **Italic**: Distinguishes from main heading
- **Usage**: Descriptive text below main headings

---

## Image Styles

### Logo Vote Image

```css
.logo-vote img {
    width: 150px;
    height: 150px;
    margin: 20px 0;
}
```

- **Size**: 150x150 pixels (square)
- **Margin**: 20px top and bottom spacing
- **Usage**: Main voting logo on index.html

### Login Image

```css
.image-login img {
    width: 120px;
    height: 120px;
    margin: 20px 0;
}
```

- **Size**: 120x120 pixels (smaller than logo)
- **Margin**: 20px top and bottom
- **Usage**: Login page illustration

### Voting Image

```css
.image-voting img {
    width: 120px;
    height: 120px;
    margin: 20px 0;
}
```

- **Size**: 120x120 pixels
- **Usage**: Voting page icon

---

## Button Styles

### Primary Button (.btn)

```css
.btn {
    display: inline-block;
    margin: 15px;
    padding: 15px 30px;
    border: 2px solid black;
    background: rgb(243, 162, 96);
    border-radius: 10px;
    text-decoration: none;
    color: black;
    font-weight: bold;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
```

**Dimensions**:
- Padding: 15px (top/bottom), 30px (left/right)
- Margin: 15px all sides
- Border-radius: 10px (rounded)

**Colors**:
- Background: `rgb(243, 162, 96)` - Orange
- Border: 2px solid black
- Text: black, bold

**Shadow**:
- Subtle: 4px offset, 6px blur
- Creates depth

### Button Hover

```css
.btn:hover {
    cursor: pointer;
    background: rgb(95, 192, 95);
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

**Changes on Hover**:
1. Cursor changes to pointer
2. Background turns green: `rgb(95, 192, 95)`
3. Button lifts up 5px
4. Shadow increases (more dramatic)

### Button Active (Click)

```css
.btn:active {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -5px rgba(0, 0, 0, 0.1), 
                0 5px 5px -5px rgba(0, 0, 0, 0.05);
}
```

**Click Feedback**:
- Maintains lifted position
- Reduces shadow slightly
- Gives tactile feedback

### Login Button (.btn-login)

```css
.btn-login {
    /* Identical to .btn properties */
}

.btn-login:hover {
    /* Same as .btn:hover */
}

.btn-login:active {
    /* Same as .btn:active */
}
```

**Purpose**: Separate class for login button
**Styling**: Identical to `.btn`

---

## Form Input Styles

### Input Group

```css
.input-group {
    max-width: 400px;
    margin: 12px auto;
    text-align: left;
}
```

- **Max-width**: 400px (readable width)
- **Margin**: 12px top/bottom, auto left/right (centered)
- **Text-align**: left (labels align left)

### Input Group Label

```css
.input-group label {
    font-weight: bold;
}
```

- Bold text for labels
- Clear field identification

### Input Group Input

```css
.input-group input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #aaa;
}
```

**Dimensions**:
- Width: 100% of parent
- Padding: 10px (comfortable input area)

**Appearance**:
- Border: 1px solid grey (#aaa)
- Border-radius: 8px (slightly rounded)
- Margin-top: 5px (space below label)

---

## Link Styles

### Registration Link

```css
.regis-link {
    text-decoration: none;
    color: grey;
}

.regis-link:hover {
    text-decoration: underline;
    cursor: pointer;
}
```

- **Default**: Grey, no underline
- **Hover**: Underlined, pointer cursor
- **Usage**: "Create ID" link on login page

### Login Link

```css
.log-link {
    text-decoration: none;
    color: grey;
}

.log-link:hover {
    text-decoration: underline;
    cursor: pointer;
}
```

- **Identical to regis-link**
- **Usage**: "Login" link on registration page

---

## Candidate Card Styles

### Candidates Container

```css
.candidates {
    background: #fafafa;
    border: 2px solid #ddd;
    padding: 20px;
    border-radius: 15px;
    margin: 15px 0;
    font-size: 20px;
    display: flex;
    flex-direction: column; 
    align-items: center;
    width: 200px;
    cursor: pointer;
    transition: 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
```

**Layout**:
- Flexbox: column direction
- Width: 200px fixed
- Padding: 20px
- Centered content

**Appearance**:
- Background: Light grey (#fafafa)
- Border: 2px solid light grey (#ddd)
- Border-radius: 15px
- Shadow for depth

**Interaction**:
- Cursor: pointer (clickable)
- Transition: 0.3s smooth animations

### Candidate Symbol

```css
.candidates .symbol {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
    object-fit: contain;
}
```

- **Size**: 80x80 pixels
- **object-fit: contain** - Maintains aspect ratio
- **Margin-bottom**: Space below image

### Candidate Hover Effect

```css
.candidates:hover {
    cursor: pointer;
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

- Lifts up 5px
- Increases shadow
- Pointer cursor

### Candidate Active (Click)

```css
.candidates:active {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -5px rgba(0, 0, 0, 0.1), 
                0 5px 5px -5px rgba(0, 0, 0, 0.05);
}
```

- Maintains lift
- Slightly reduced shadow
- Click feedback

### Vote Options Layout

```css
.vote-options {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}
```

- **Flexbox**: Horizontal layout
- **justify-content: center** - Centers cards
- **gap: 20px** - Spacing between candidates
- **Usage**: Container for all candidate cards

### Hidden Radio Button

```css
.candidate input[type="radio"] {
    display: none;
}
```

- Hides actual radio button
- Label makes entire card clickable
- Better UX than tiny radio buttons

---

## Success Animation Styles

### Success Container

```css
.success-container {
    width: 300px;
    margin: 80px auto;
    text-align: center;
}
```

- Width: 300px
- Centered with auto margins
- 80px top margin for vertical spacing

### Checkmark Circle

```css
.checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-block;
    border: 4px solid #4CAF50;
    position: relative;
    animation: pop 0.4s ease;
}
```

**Shape**:
- 80x80 pixels
- border-radius: 50% makes it circular
- Green border (#4CAF50)

**Animation**:
- `pop` animation (0.4 seconds)
- ease timing function

### Checkmark Tick (::after pseudo-element)

```css
.checkmark::after {
    content: '';
    position: absolute;
    left: 22px;
    top: 8px;
    width: 25px;
    height: 50px;
    border-right: 4px solid #4CAF50;
    border-bottom: 4px solid #4CAF50;
    transform: rotate(45deg);
    animation: draw 0.4s ease-out 0.4s forwards;
    opacity: 0;
}
```

**Positioning**:
- Absolute within circle
- Left: 22px, Top: 8px (placement)

**Shape**:
- Right border + Bottom border = L shape
- Rotated 45 degrees = Checkmark tick

**Animation**:
- `draw` animation
- Duration: 0.4s
- Delay: 0.4s (after circle appears)
- forwards: Keeps final state

### Pop Animation Keyframes

```css
@keyframes pop {
    0% { transform: scale(0.3); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
```

- **Start**: 30% size, invisible
- **End**: Full size, visible
- **Effect**: Growing/popping in

### Draw Animation Keyframes

```css
@keyframes draw {
    to { opacity: 1; }
}
```

- **Start**: opacity: 0 (invisible)
- **End**: opacity: 1 (visible)
- **Effect**: Fading in

### Success Text

```css
.success-text {
    font-size: 20px;
    margin-top: 15px;
    color: #4CAF50;
    font-weight: bold;
}
```

- Green color matching checkmark
- Bold, 20px font
- 15px margin above

---

## Error Animation Styles

### Unsuccess Container

```css
.unsuccess-container {
    width: 300px;
    margin: 80px auto;
    text-align: center;
}
```

- Identical to success-container
- Consistency in layout

### Crossmark Circle

```css
.crossmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-block;
    border: 4px solid #FF3B3B;
    position: relative;
    animation: pop-fail 0.4s ease;
}
```

**Differences from checkmark**:
- Red color: #FF3B3B
- Animation: pop-fail (same as pop)

### Crossmark X Lines (::before and ::after)

```css
.crossmark::before,
.crossmark::after {
    content: '';
    position: absolute;
    width: 45px;
    height: 4px;
    background: #FF3B3B;
    top: 38px;
    left: 18px;
    opacity: 0;
    animation: draw-fail 0.4s ease-out 0.4s forwards;
}

.crossmark::before {
    transform: rotate(45deg);
}

.crossmark::after {
    transform: rotate(-45deg);
}
```

**Structure**:
- Two lines (before and after pseudo-elements)
- Same position, opposite rotations
- Creates X shape

**Rotation**:
- ::before rotates 45 degrees (/)
- ::after rotates -45 degrees (\)
- Together form X

### Pop-Fail Animation

```css
@keyframes pop-fail {
    0% { transform: scale(0.3); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
```

- Identical to pop animation
- Separate name for clarity

### Draw-Fail Animation

```css
@keyframes draw-fail {
    to { opacity: 1; }
}
```

- Same as draw animation
- Applies to X lines

### Fail Text

```css
.fail-text {
    font-size: 20px;
    margin-top: 15px;
    color: #FF3B3B;
    font-weight: bold;
}
```

- Red color matching crossmark
- Same sizing as success-text
- Bold, prominent

---

## Result Page Styles

### Result Container

```css
.result-container {
    width: 650px;
    margin: 20px 0;
    text-align: center;
    padding: 20px;
    background: white;
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.result-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

- **Wider**: 650px (more content)
- **Same effects**: Hover animations
- **White background**: Clean appearance

### Winner Section

```css
.winner-section {
    background: linear-gradient(135deg, rgb(243, 162, 96) 0%, rgb(255, 140, 60) 100%);
    border: 3px solid rgb(200, 120, 60);
    padding: 20px;
    border-radius: 20px;
    margin: 15px 0;
    box-shadow: 0 8px 16px rgba(243, 162, 96, 0.4);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
```

**Gradient Background**:
- `linear-gradient(135deg, ...)` - Diagonal gradient
- Start: rgb(243, 162, 96) - Light orange
- End: rgb(255, 140, 60) - Darker orange

**Border & Shadow**:
- 3px solid border (darker orange)
- Shadow with orange tint

**Hover Effect**:

```css
.winner-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(243, 162, 96, 0.4), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

### Winner Section Trophy (::before pseudo-element)

```css
.winner-section::before {
    /* content: '🏆'; */
    position: absolute;
    font-size: 150px;
    opacity: 0.1;
    top: -30px;
    right: -20px;
}
```

- Commented out but available
- Large trophy emoji background
- Very faint (opacity: 0.1)
- Decorative element

### Winner Title

```css
.winner-title {
    font-size: 28px;
    font-weight: bold;
    color: rgb(80, 40, 20);
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.3);
}
```

- Large font (28px)
- Dark brown color
- Text shadow (white, subtle)
- Bold emphasis

### Winner Name & Votes

```css
.winner-name {
    font-size: 24px;
    font-weight: bold;
    color: rgb(40, 20, 10);
    margin: 8px 0;
}

.winner-votes {
    font-size: 20px;
    color: rgb(60, 30, 15);
    font-weight: bold;
}
```

- Progressively smaller fonts
- Dark brown shades
- Bold for emphasis

### Winner Symbol

```css
.winner-symbol {
    width: 100px;
    height: 100px;
    margin: 10px auto;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
}
```

- 100x100 pixels
- Drop shadow for depth
- Contains image proportions

---

## Runner-Up Styles

### Runner-Up Section

```css
.runner-up-section {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 20px;
}
```

- **Flexbox**: Vertical layout
- **Gap**: 12px spacing between runners-up
- **Container**: For 2nd and 3rd place

### Runner-Up Card

```css
.runner-up {
    background: #fafafa;
    border: 2px solid #ddd;
    padding: 15px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.runner-up:hover {
    transform: translateX(5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
}
```

**Layout**:
- Flexbox: Horizontal
- Aligned items
- Space between content

**Hover**: Moves right 5px (instead of up)

### First Runner-Up (2nd Place)

```css
.runner-up.first {
    background: linear-gradient(135deg, rgb(95, 192, 95) 0%, rgb(70, 170, 70) 100%);
    border: 2px solid rgb(60, 150, 60);
}
```

- **Green gradient** background
- Light to dark green
- Distinct from winner

### Second Runner-Up (3rd Place)

```css
.runner-up.second {
    background: linear-gradient(135deg, rgb(255, 200, 150) 0%, rgb(243, 162, 96) 100%);
    border: 2px solid rgb(220, 140, 80);
}
```

- **Orange/peach gradient** background
- Lighter than winner
- Visual hierarchy

### Runner-Up Layout Components

```css
.runner-up-left {
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 1;
}
```

- **Flexbox**: Horizontal layout
- **Gap**: 20px between elements
- **flex: 1**: Takes available space

### Runner-Up Badge

```css
.runner-up-badge {
    font-size: 40px;
    font-weight: bold;
    min-width: 60px;
}

.runner-up.first .runner-up-badge {
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.runner-up.second .runner-up-badge {
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}
```

- **Large**: 40px emoji (🥈 🥉)
- **Drop shadow**: Depth effect
- **Min-width**: Consistent spacing

### Runner-Up Symbol

```css
.runner-up-symbol {
    width: 80px;
    height: 80px;
    object-fit: contain;
}
```

- 80x80 pixels
- Maintains proportions

### Runner-Up Info

```css
.runner-up-info {
    text-align: left;
    flex: 1;
}
```

- Left-aligned text
- Takes available space

### Runner-Up Name & Votes

```css
.runner-up-name {
    font-size: 22px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.runner-up-votes {
    font-size: 18px;
    color: #666;
    font-weight: 600;
}
```

**Color Overrides for First**:
```css
.runner-up.first .runner-up-name,
.runner-up.first .runner-up-votes {
    color: rgb(20, 60, 20);
}
```

**Color Overrides for Second**:
```css
.runner-up.second .runner-up-name,
.runner-up.second .runner-up-votes {
    color: rgb(80, 40, 20);
}
```

---

## Progress Bar Styles

### Vote Bar Container

```css
.vote-bar-container {
    width: 100%;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    height: 30px;
    margin-top: 10px;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
```

- **Full width**: 100%
- **Semi-transparent**: White with 30% opacity
- **Height**: 30px
- **Rounded**: 10px border-radius
- **Overflow hidden**: Clips bar inside

### Vote Bar

```css
.vote-bar {
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(40, 20, 10);
    font-weight: bold;
    transition: width 1.5s ease-in-out;
    font-size: 14px;
}
```

**Key Property**:
- `transition: width 1.5s ease-in-out` 
- **Width animates**: Smoothly grows
- **Duration**: 1.5 seconds
- **Easing**: ease-in-out (natural motion)

**Layout**:
- Flexbox centers percentage text
- Full height of container

### Bar Color Variations

```css
.winner-section .vote-bar {
    background: rgba(255, 255, 255, 0.6);
}

.runner-up.first .vote-bar {
    background: rgba(255, 255, 255, 0.4);
}

.runner-up.second .vote-bar {
    background: rgba(255, 255, 255, 0.4);
}
```

- Different opacities for different ranks
- Winner has most opaque bar

---

## Total Votes Display

```css
.total-votes {
    margin-top: 20px;
    padding: 12px;
    background: #EBF8FF;
    border-radius: 10px;
    font-size: 18px;
    color: #333;
    border: 2px solid #ddd;
}
```

- Light blue background
- Rounded corners
- Bordered box
- Prominent display

### Back Button

```css
.back-button {
    margin-top: 20px;
}
```

- Simple spacing
- Uses `.btn` class for styling

---

## Responsive Design

### Tablet (768px and below)

```css
@media (max-width: 768px) {
    .result-container {
        width: 90%;
        padding: 20px;
    }

    .winner-title {
        font-size: 24px;
    }

    .winner-name {
        font-size: 22px;
    }

    .winner-symbol {
        width: 100px;
        height: 100px;
    }

    .runner-up {
        flex-direction: column;
        text-align: center;
    }

    .runner-up-left {
        flex-direction: column;
    }

    .runner-up-info {
        text-align: center;
    }

    .runner-up-symbol {
        width: 70px;
        height: 70px;
    }
}
```

**Changes for Tablets**:
- Container width becomes 90% (flexible)
- Smaller font sizes
- Runner-ups stack vertically
- Centered text alignment

### Mobile (480px and below)

```css
@media (max-width: 480px) {
    .result-container {
        width: 95%;
        padding: 15px;
    }

    .winner-section {
        padding: 20px;
    }

    .winner-title {
        font-size: 20px;
    }

    .winner-name {
        font-size: 18px;
    }

    .runner-up-badge {
        font-size: 30px;
    }
}
```

**Changes for Mobile**:
- Container: 95% width
- Smaller padding
- Reduced font sizes
- Smaller emoji badges

---

## Design Principles

### Color Scheme

**Primary Colors**:
- **Orange**: rgb(243, 162, 96) - Winner, buttons
- **Green**: rgb(95, 192, 95) - Success, 1st runner
- **Light Blue**: #EBF8FF - Background

**Accent Colors**:
- **Red**: #FF3B3B - Errors
- **Grey**: #fafafa, #ddd - Neutral elements

### Spacing System

**Margins**:
- Small: 5px, 10px
- Medium: 15px, 20px
- Large: 80px (containers)

**Padding**:
- Inputs: 10px
- Buttons: 15px 30px
- Containers: 20px, 25px

### Border Radius

- Small: 8px (inputs)
- Medium: 10px, 15px (buttons, cards)
- Large: 20px (containers)

### Shadows

**Light** (default):
```css
box-shadow: 0 4px 6px rgba(0,0,0,0.1);
```

**Heavy** (hover):
```css
box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15),
            0 10px 10px -5px rgba(0, 0, 0, 0.06);
```

### Transitions

**Standard**: 0.3s ease
**Animations**: 0.4s ease
**Progress bars**: 1.5s ease-in-out

---

## Animation Timing

### Success/Error Animations

1. **Circle pop**: 0.4s
2. **Symbol draw**: 0.4s (delayed 0.4s)
3. **Total**: 0.8s

### Hover Effects

- **Transform**: 0.3s
- **Shadow**: 0.3s
- **Simultaneous**: Smooth combined effect

### Progress Bars

- **Width animation**: 1.5s
- **Delay**: 500ms (JavaScript)
- **Easing**: ease-in-out

---

## Best Practices Implemented

1. **Consistent Spacing**: Regular margin/padding system
2. **Smooth Transitions**: All interactions animated
3. **Visual Feedback**: Hover and active states
4. **Accessibility**: Sufficient contrast


