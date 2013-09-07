<ul id="lang-switcher" class="nav nav-tabs">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php print $lang_menu[0]['name'].' <span class="caret"></span>';?>
        </a>
        <ul class="dropdown-menu">
            <?php
//            foreach($lang_menu as $lang){
            for ($i=1; $i<count($lang_menu); $i++){
                echo '<li><a href="'.$lang_menu[$i]['url'].'">'.$lang_menu[$i]['name'].'</a></li>';
            }
            ?>
        </ul>
    </li>
</ul>