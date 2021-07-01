    <footer>
        <small>Cine PAW&trade; 2021</small>

        <ul>
            <?php foreach($this->footerLinks as $fl): ?>
                <li><a href="<?= $fl['href']?>"><i class="<?= "gg-" . $fl['name']?>"></i></a></li>
            <?php endforeach; ?>
        <ul>

    </footer>
