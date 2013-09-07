<?php print render($region['lang_menu']); ?>
<nav>
    <ul>
        <?php
        foreach($mainMenu as $menuItem){
            print '<li class="'.$menuItem['active'].'"><a href="'.$menuItem['url'].'" title="'.$menuItem['title'].'"><img src="'.$menuItem['menu_icon_url'].'" alt="'.$menuItem['menu_icon_alt'].'" /></a></li>';
        }
        ?>
   </ul>
</nav>


