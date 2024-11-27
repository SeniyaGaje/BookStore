<form action="./actions/login.php" method="post" class="login__form grid" id="loginForm"
    <?php
    // Check if the 'logged' session variable is set and not empty
    if (isset($_SESSION["logged"]) && $_SESSION["logged"] != "") {
        echo "style='display: none;'";
    }
    ?>>
    <h3 class="login__title">Log In</h3>
    <div class="login__group grid">
        <div>
            <label for="login-email" class="login__label">Email</label>
            <input type="email" placeholder="Write your email" id="login-email" name="login-email" class="login__input" maxlength="45" required>
        </div>

        <div style="position: relative;">
            <label for="login-pass" class="login__label">Password</label>
            <input type="password" placeholder="Enter your password" id="login-pass" name="login-pass" class="login__input" maxlength="16" required>

            <!-- Eye Icon for toggling password visibility -->
            <span class="toggle-password" onclick="togglePassword('login-pass', 'togglePasswordLogin')" style="position: absolute; right: 10px; top: 40px; cursor: pointer;">
                <i class="ri-eye-line" id="togglePasswordLogin"></i>
            </span>
        </div>
    </div>
    <div>
    </div>
    <div>
        <span class="login__signup">
            You do not have an account? <a href="#" onClick="authChange('register');">Sign up</a>
        </span>
        <a href="forgotPassword.php" class="login__forgot">
            You forgot your password
        </a>

        <button type="submit" class="login__button button" name="submit">Log In</button>
    </div>
</form>
