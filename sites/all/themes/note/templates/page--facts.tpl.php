
<div id="pages" class="full-width">
    <hgroup class="">
        <?php echo '<h1>'.$proof['page_title'].'</h1>';?>
    </hgroup>
<div id="1work">
    <div id="1work-pages">
        <div class="tab">
            <div class="full-width">
              <?php
                 foreach($proof['content'] as $key => $par){
                     echo '<p>'.$par.'</p>';
                 }
              ?>
                <?php echo '<a role="button" class="b-nonemt btn btn-inverse" href="#zinojums" data-toggle="modal">'.$proof['button_text'].'</a>';?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
