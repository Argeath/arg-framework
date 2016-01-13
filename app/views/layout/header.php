<div class="content">
    <div id="user-box">
        <?php if ( ! $isLogged ) { ?>
            <a href="/index.php/user/login">Zaloguj</a> |
            <a href="/index.php/user/register">Zarejetruj</a>
        <?php } else { ?>
            Witaj <?= $user->username ?>.
            <a href="/index.php/user/logout">Wyloguj</a>
        <?php } ?>
    </div>
</div>

<header>
    <svg width="550" height="300" viewBox="0 0 550 300">
        <text class="title" x="75" y="175" fill="#FFFFFF">Lotnictwo</text>
        <path id="planePath" fill="none" stroke="none"
              d="M50,150
                    a 225,75 0 1,0 450,0
                    a 225,75 0 1,0 -450,0" />

        <g id="plane" fill="#FFFFFF">
            <image height="30" width="30" xlink:href="assets/images/plane.svg" transform="rotate(45, 15, 15)" />
        </g>

        <animateMotion
            xlink:href="#plane"
            dur="3s"
            begin="0s"
            fill="freeze"
            repeatCount="indefinite"
            rotate="auto"
        >
            <mpath xlink:href="#planePath" />
        </animateMotion>
    </svg>
</header>