<header>
    <h1 class="logotipo">
        <a href="../" target="_self">Cine PAW</a>
    </h1>
    <nav>
        <ul class="menu_user">
            <?php foreach($this->userOptions as $uOpt):?>
                <li><a href="<?= $uOpt['href']?>" target="_self" class="user_opt"><?=$uOpt['name']?></a></li>
            <?php endforeach; ?>
        </ul>
        <ul class="main_menu">
            <?php foreach($this->menuOptions as $mOpt):?>
                <li class="main_menu_opt"><a href="<?= $mOpt['href']?>" target="_self" ><?=$mOpt['name']?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

</header>
