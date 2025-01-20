<?php include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODERS TEAM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero">
        <nav class="navbar">
            <div class="logo">
                <img src="isru web.png" alt="Coders Team Logo">
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#register">Register</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#languages">Languages</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </nav>
        <div class="hero-content">
            <h1>Welcome to CODERS TEAM</h1>
            <p>Join a community of collaborators. Share your journey, grow together, and achieve your goals with the coders team!</p>
        </div>
    </header>
    
    <main>
        <section id="register" class="registration-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>REGISTER HERE</h2>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br>
                
                <input type="submit" name="submit" value="Register">
            </form>
        </section>

        <section id="about" class="about">
            <h2>Why Join coders team?</h2>
            <p>coders team is a platform designed for those who want to connectand grow together. Whether you're looking to enhance your skills or find a supportive team, coders team is the place to be.</p>
            <p>Our team of experts are here to guide you on your journey. Join us today and take the first step towards your goals!</p>
        </section>

        <section id="languages" class="languages">
            <h2>Languages We Use</h2>
            <div class="language-icons">
                <div class="language-item">
                    <img src="IMAGES/html.png" alt="HTML5 Icon">
                    <p>HTML5</p>
                </div>
                <div class="language-item">
                    <img src="IMAGES/css.png" alt="CSS3 Icon">
                    <p>CSS3</p>
                </div>
                <div class="language-item">
                    <img src="IMAGES/javascript.png" alt="JavaScript Icon">
                    <p>JavaScript</p>
                </div>
                <div class="language-item">
                    <img src="IMAGES/php.png" alt="PHP Icon">
                    <p>PHP</p>
                </div>
            </div>
        </section>

        <section id="faq" class="faq">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <h3>How can I join coders team?</h3>
                <p>Simply fill out the registration form above with a username and password, and you’ll be part of our community!</p>
            </div>
            <div class="faq-item">
                <h3>Is there a fee to join?</h3>
                <p>No, joining coders team is completely free.</p>
            </div>
            <div class="faq-item">
                <h3>What skills do I need?</h3>
                <p>Any programming languages,Only available for experienced coders!!!</p>
            </div>
        </section>
    </main>
</body>
</html>

<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username)) {
            echo "Please enter a username.";
        } elseif (empty($password)) {
            echo "Please enter a password.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                $stmt = $conn->prepare("INSERT INTO users (user, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $hash);

                if ($stmt->execute()) {
                    echo "<p>You are now registered! Welcome to the coders team community!</p>";
                }

                $stmt->close();
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    echo "<p>That username is already taken. Please choose another.</p>";
                } else {
                    echo "<p>An error occurred: " . $e->getMessage() . "</p>";
                }
            }
        }
    }
    mysqli_close($conn);
?>
