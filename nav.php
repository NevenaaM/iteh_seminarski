<nav id="menu">
    <ul class="links">
        <li><a href="index.php">Home</a></li>
        <li><a href="onama.php">O nama</a></li>
        <?php
            if($_SESSION['user'] != null){
                ?>
                <li><a href="mojeNarudzbine.php">Moje narudzbine</a></li>
        <?php
                if($_SESSION['user']->rola == 'Administrator'){
                    ?>
                    <li><a href="admin.php">Admin</a></li>

                    <?php
                }
            }
        ?>
    </ul>
    <ul class="actions stacked">
        <?php
            if($_SESSION['user'] != null){
                ?>
                <li><a href="logout.php" class="button primary fit">Log Out</a></li>
        <?php
            }else{
                ?>
                <li><a href="registracija.php" class="button primary fit">Registracija</a></li>
                <li><a href="login.php" class="button fit">Log In</a></li>
                <?php
            }
        ?>

    </ul>
</nav>