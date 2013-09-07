
<div id="pages" class="full-width">
    <hgroup>
        <?php print '<h1>'.$debt['page_title'].'</h1>';?>
    </hgroup>
<div id="1about-me">
    <div id="1about-me-pages">
        <div class="tab">
            <div class="full-width">
                 <div class="col1">
                <?php echo '<h2>'.$debt['about_debtor']['title'].'</h2>';?>
                <dl class="dl-horizontal">
                    <?php foreach($debt['about_debtor']['list'] as $key => $item){
                        echo '<dt>'.$item['term'].'</dt><dd>'.$item['description'].'</dd>';
                    }
                    ?>
                </dl>
                <?php echo '<h2>'.$debt['events']['title'].'</h2>';?>
                <dl class="events">
                    <?php
                    foreach($debt['events']['list'] as $key => $item){
                        echo '<dt>'.$item['term'].'</dt><dd>'.$item['description'].'</dd>';
                    }
                    ?>
                </dl>

                </div>
                 <div class="col2">
                <?php print '<h2>'.$debt['financial_obligations']['title'].'</h2>';?>
                <ol>
                    <?php
                    foreach($debt['financial_obligations']['list'] as $key => $item){
                        echo '<li>'.$item.'</li>';
                    }
                    ?>
                </ol>

                <br />
                <p>
                    <?php print '<a role="button" class="b-nonemt btn btn-inverse" href="#zinojums" data-toggle="modal">'.$debt['button_text'].'</a>';?>
                </p>
            </div>
            </div>
        </div>
    </div>
</div>

</div>
