<article style="text-align: center;">
    <h2>Rejestracja</h2>
    <?php if(isset($errorField)): ?>
    <div class="errorBox">
        <?= $errorField . ": " . $error ?>
    </div>
    <?php endif; ?>
    <form method="POST" action="/index.php/user/register">
        <label>Login</label>
        <br />
        <input type="text" class="form-input" placeholder="Login" name="username"/>
        <br />
        <label>Email</label>
        <br />
        <input type="email" class="form-input" placeholder="Email" name="email"/>
        <br />
        <label>Hasło</label>
        <br />
        <input type="password" class="form-input" placeholder="Hasło" name="password"/>
        <br />
        <label>Powtórz hasło</label>
        <br />
        <input type="password" class="form-input" placeholder="Powtórz hasło" name="repeat_password"/>
        <br />

        <div class="buttons">
            <input class="btn" type="submit" name="register" value="Zarejestruj"/>
        </div>
    </form>
</article>