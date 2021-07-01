    <footer>

        <address>
            <p>El Grito de Alcorta N°110</p>
            <p>B6620 Chivilcoy</p>
            <p>Provincia de Buenos Aires</p>
        </address>

        <small>Dental Medical Group&trade; 2021</small>

        <ul>
            <?php foreach($this->footerLinks as $fl): ?>
                <li><a href="<?= $fl['href']?>"><i class="<?= "gg-" . $fl['name']?>"></i></a></li>
            <?php endforeach; ?>
        <ul>

    </footer>
