<!--<footer>-->
<!--    <div class="container wrapper">-->
<!--        <div class="foo">-->
<!--        </div>-->
<!--        <div class=" copy">-->
<!--            <p>  © Want My Bucks Back | All rights reserved. <a href="http://kapasoft.com" target="_blank"> Web Design by Kapasoft Web Solutions</a> </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->

<div class="modal modal-zinojums hide fade" id="zinojums" style="display: none">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="newsletter">
        <div class="media">
            <a class="pull-left" href="#">
                <?php print '<img class="media-object" alt="'.$disclaimer['icons']['icon_removed']['alt'].'" src="'. $disclaimer['icons']['icon_removed']['url'].'">';?>
            </a>
            <div class="media-body">
                <?php echo '<h4 class="media-heading">'.$disclaimer['term_for_removing'].'</h4>'; ?>
                <div class="media">
                    <?php print $disclaimer['description_for_removing']?>
                </div>
            </div>
        </div>
        <div class="media">
            <a class="pull-left" href="#">
                <?php print '<img class="media-object" alt="'.$disclaimer['icons']['icon_for_stay']['alt'].'" src="'.$disclaimer['icons']['icon_for_stay']['url'].'">';?>
            </a>
            <div class="media-body">
                <?php print '<h4 class="media-heading">'.$disclaimer['term_for_staying'].'</h4>';?>
                <div class="media">
                    <?php print $disclaimer['description_for_staying'] ?>
                </div>
            </div>
        </div>

    </div>
</div>
