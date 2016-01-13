<article style="text-align: center;">
    <h2>Logowanie</h2>
    <?php if(isset($errorField)): ?>
        <div class="errorBox">
            <?= $errorField . ": " . $error ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="/index.php/user/login">
        <label>Login</label>
        <br />
        <input type="text" class="form-input" placeholder="Login" name="username"/>
        <br />
        <label>Hasło</label>
        <br />
        <input type="password" class="form-input" placeholder="Hasło" name="password"/>
        <br />

        <div class="buttons">
            <input class="btn" type="submit" name="login" value="Zaloguj"/>
        </div>
    </form>
</article>