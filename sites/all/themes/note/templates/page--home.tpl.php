<?php //var_dump('Button Text from tempalte: '.$home['button_text']);?>
<div id="pages">
<div id="home">
    <div class="full-width">
        <hgroup>
           <?php echo '<h1>'.$home['page_title'].'</h1>';?>
           <?php echo '<h2><i>'.$home['announcement_prefix'].' : </i>'.$home['announcement'].'</h2>';?>
        </hgroup>
        <?php print '<a role="button" href="#personal-portrait" data-rel="prettyPhoto" title="'.$home['debtor_portrait']['title'].'" data-toggle="modal" ><img class="border center" src="'.$home['debtor_portrait']['url'].'" width="93" height="105" alt="'.$home['debtor_portrait']['alt'].'" /></a>';?>
        <?php print '<a role="button" class="b-nonemt btn btn-inverse" style="position: relative; top: -60px" href="#zinojums" data-toggle="modal">'.$home['button_text'].'</a>';?>
    </div>
</div>
</div>

<div class="modal hide fade" id="personal-portrait" style="display: none">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo '<h3>'.$home['page_title'].'</h3>';?>
    </div>
   <?php print '<img class="border center" src="'.$home['debtor_portrait']['url'].'" width="200" height="200" alt="'.$home['debtor_portrait']['alt'].'" />';?>
    <div class="modal-footer">
        <?php echo $home['debtor_portrait']['foot_note']; ?>
    </div>
</div>
