<header class="header">
    <div class="logo">
        <!-- <img src="../app/Hidden/images/logo.jpeg" alt="" height="70px"   width="250px" > -->
        <a href="index"></a>
    </div>
    <nav class="nav">
        <input type="checkbox" id="nav-check">
        <ul class="nav-links">
            <?php
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, 'login') == false || strpos($url, 'signup') == false) {
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                    echo '<li><a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/project/' . 'createEvent' . '">Create Event</a></li>';

                    echo '<li><a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/project/' . 'logout' . '">Logout</a></li>';
                    echo '<li><a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/project/' . 'profile' . '">My Profile</a></li>';
                } else {
                    if (strpos($url, 'login')) {
                        echo '<li><a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/project/' . 'signup' . '">Signup</a></li>';
                    } elseif (strpos($url, 'signup')) {
                        echo '<li><a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/project/' . 'login' . '">Login</a></li>';
                    }
                }
            }
            ?>
            <li><a href="https://www.anubhutitrust.org/" target="_blank">About Us</a></li>
            <li><a href="contact">Contact Us</a></li>

        </ul>
    </nav>
    <div class="hamburger-container">
        <label class="hamburger" for="nav-check">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </label>
    </div>
</header>
