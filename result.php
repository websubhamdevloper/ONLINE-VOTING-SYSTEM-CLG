<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch all candidates with their votes, ordered by votes (descending)
    $sql = "SELECT name, symbol, votes FROM candidates ORDER BY votes DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate total votes
    $totalVotes = array_sum(array_column($candidates, 'votes'));
    
    // Calculate percentages for each candidate
    foreach ($candidates as &$candidate) {
        if ($totalVotes > 0) {
            $candidate['percentage'] = number_format(($candidate['votes'] / $totalVotes) * 100, 1);
        } else {
            $candidate['percentage'] = 0;
        }
    }
    
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="result-container">
        <h1>🗳️ VOTING RESULTS 🗳️</h1>
        <p class="subtitle">Final Results are Here!</p>

        <?php if ($totalVotes > 0 && count($candidates) > 0): ?>
        
        <!-- Winner Section -->
        <div class="winner-section">
            <div class="winner-title">🏆 WINNER 🏆</div>
            <img src="<?php echo htmlspecialchars($candidates[0]['symbol']); ?>" alt="Winner Symbol" class="winner-symbol">
            <div class="winner-name"><?php echo htmlspecialchars($candidates[0]['name']); ?></div>
            <div class="winner-votes"><?php echo $candidates[0]['votes']; ?> Votes</div>
            <div class="vote-bar-container">
                <div class="vote-bar winner-bar" style="width: 0%;" data-width="<?php echo $candidates[0]['percentage']; ?>%">
                    <span><?php echo $candidates[0]['percentage']; ?>%</span>
                </div>
            </div>
        </div>

        <!-- Runners-Up Section -->
        <div class="runner-up-section">
            
            <!-- First Runner-Up -->
            <?php if (isset($candidates[1])): ?>
            <div class="runner-up first">
                <div class="runner-up-left">
                    <div class="runner-up-badge">🥈</div>
                    <img src="<?php echo htmlspecialchars($candidates[1]['symbol']); ?>" alt="First Runner-Up" class="runner-up-symbol">
                    <div class="runner-up-info">
                        <div class="runner-up-name"><?php echo htmlspecialchars($candidates[1]['name']); ?></div>
                        <div class="runner-up-votes"><?php echo $candidates[1]['votes']; ?> Votes</div>
                        <div class="vote-bar-container">
                            <div class="vote-bar first-runner-bar" style="width: 0%;" data-width="<?php echo $candidates[1]['percentage']; ?>%">
                                <span><?php echo $candidates[1]['percentage']; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Second Runner-Up -->
            <?php if (isset($candidates[2])): ?>
            <div class="runner-up second">
                <div class="runner-up-left">
                    <div class="runner-up-badge">🥉</div>
                    <img src="<?php echo htmlspecialchars($candidates[2]['symbol']); ?>" alt="Second Runner-Up" class="runner-up-symbol">
                    <div class="runner-up-info">
                        <div class="runner-up-name"><?php echo htmlspecialchars($candidates[2]['name']); ?></div>
                        <div class="runner-up-votes"><?php echo $candidates[2]['votes']; ?> Votes</div>
                        <div class="vote-bar-container">
                            <div class="vote-bar second-runner-bar" style="width: 0%;" data-width="<?php echo $candidates[2]['percentage']; ?>%">
                                <span><?php echo $candidates[2]['percentage']; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Total Votes -->
        <div class="total-votes">
            <strong>Total Votes Cast:</strong> <span><?php echo $totalVotes; ?></span>
        </div>

        <?php else: ?>
        
        <!-- No Votes Yet Message -->
        <div class="no-votes-message">
            <p style="font-size: 24px; color: #555; margin-top: 50px;">
                No votes have been cast yet. Be the first to vote!
            </p>
        </div>
        
        <?php endif; ?>

        <!-- Back Button -->
        <div class="back-button">
            <a href="index.html" class="btn">Back to Home</a>
        </div>
    </div>

    <script>
        // Animate bars after page load
        setTimeout(() => {
            const winnerBar = document.querySelector('.winner-bar');
            const firstRunnerBar = document.querySelector('.first-runner-bar');
            const secondRunnerBar = document.querySelector('.second-runner-bar');
            
            if (winnerBar) {
                winnerBar.style.width = winnerBar.getAttribute('data-width');
            }
            if (firstRunnerBar) {
                firstRunnerBar.style.width = firstRunnerBar.getAttribute('data-width');
            }
            if (secondRunnerBar) {
                secondRunnerBar.style.width = secondRunnerBar.getAttribute('data-width');
            }
        }, 500);
    </script>
</body>
</html>

