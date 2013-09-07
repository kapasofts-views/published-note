<div class="row">
            <div class="span4">
                    <?php if (!empty($page['highlighted'])): ?>
                        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
                    <?php endif; ?>
                    <a id="main-content"></a>
                    <?php print $messages; ?>
                    <?php if (!empty($tabs)): ?>
                        <?php print render($tabs); ?>
                    <?php endif; ?>
                    <?php if (!empty($page['help'])): ?>
                        <div class="well"><?php print render($page['help']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($action_links)): ?>
                        <ul class="action-links"><?php print render($action_links); ?></ul>
                    <?php endif; ?>
                    <?php print render($page['content']); ?>
            </div>
 </div>
