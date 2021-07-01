<header>
    <ul class="menu_user">
        <li><a href="<?= $this->contact['href']?>" class="telefono"><?= $this->contact['name']?></a></li>
        <?php foreach($this->userOptions as $uOpt):?>
            <li><a href="<?= $uOpt['href']?>" target="_self" class="user_opt"><?=$uOpt['name']?></a></li>
        <?php endforeach; ?>
    </ul>
    <nav>
        <h1 class="logotipo">
            <a href="../" target="_self">Dental<br>Medical<br>Group</a>
        </h1>
        <ul class="main_menu">
            <?php foreach($this->menuOptions as $mOpt):?>
                <li class="main_menu_opt"><a href="<?= $mOpt['href']?>" target="_self" ><?=$mOpt['name']?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

</header>
