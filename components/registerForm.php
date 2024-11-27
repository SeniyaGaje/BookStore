<form action="./actions/register.php" method="post" class="login__form grid" onSubmit="return registerValidate();" id="registerForm" style="display: none;">
    <h3 class="SignUp__title">SIGN UP</h3>
    <div class="SignUp__group grid">
        <div>
            <label for="SignUp-Name" class="SignUp__label">Name</label>
            <input type="text" placeholder="Write your name" id="SignUp-Name" name="SignUp-Name" class="SignUp__input" maxlength="45" required>
        </div>
        <div>
            <label for="SignUp-email" class="SignUp__label">Email</label>
            <input type="email" placeholder="Enter your email" id="SignUp-email" name="SignUp-email" class="SignUp__input" maxlength="45" required>
        </div>

        <div style="position: relative;">
            <label for="SignUp-pass" class="SignUp__label">Password</label>
            <input type="password" placeholder="Enter your password" id="SignUp-pass" name="SignUp-pass" class="SignUp__input" maxlength="16" required onkeyup="checkPasswordStrength()">
            <small id="passwordHelp" class="password__strength"></small>
            
            <span class="toggle-password" onclick="togglePassword('SignUp-pass', 'togglePassword1')" style="position: absolute; right: 10px; top: 40px; cursor: pointer;">
                <i class="ri-eye-line" id="togglePassword1"></i>
            </span>
        </div>

        <div style="position: relative;">
            <label for="SignUp-Conpass" class="SignUp__label">Confirm Password</label>
            <input type="password" placeholder="Confirm your password" id="SignUp-Conpass" class="SignUp__input" maxlength="16" required>

            <!-- Eye Icon for toggling visibility -->
            <span class="toggle-password" onclick="togglePassword('SignUp-Conpass', 'togglePassword2')" style="position: absolute; right: 10px; top: 40px; cursor: pointer;">
                <i class="ri-eye-line" id="togglePassword2"></i>
            </span>
        </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            function onSubmit(token) {
                if (token) {
                    // reCAPTCHA was verified successfully
                    const submitButton = document.getElementById("loginsubmit");
                    submitButton.disabled = false;
                    return true;
                } else {
                    // reCAPTCHA verification failed, prevent form submission
                    alert("Captcha failed");
                    return false; // Explicitly return false to prevent form submission
                }
            }
        </script>
        <div class="g-recaptcha"
            data-sitekey="6LfP0FwqAAAAAPD9IMCmikdzqEU_weMi_c6-z0wD"
            data-callback="onSubmit"
            data-size="normal"
            style="margin-inline: auto;"></div>

    </div>
    <div>
        <span class="SignUp__signIn">
            already have an account <a href="#" onClick="authChange('login');">Sign In</a>
        </span>
        <button type="submit" id="loginsubmit" class="SignUp__button button" name="submit" disabled>Submit</button>
    </div>
</form>