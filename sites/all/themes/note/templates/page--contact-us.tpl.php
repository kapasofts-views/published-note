
<div id="pages" class="full-width">
    <hgroup class="">
        <?php echo '<h1>'.$contact_us['page_title'].'</h1>';?>
    </hgroup>
<script type="text/javascript">
    var CONTACT = (function () {
        return {
      <?php print  "response: '".$contact_us['response_message']."',";?>
            button: {
       <?php print     "elemText: '".$contact_us['contact_button']."',";?>
                elemClass: 'btn btn-inverse'
            },
            name: {
      <?php print  'elemText: "'.$contact_us['name_input'].'"';?>
            },
            subject: {
                elemText: '',
                elemType: 'hidden'
            },
            email:{
      <?php print 'elemText:"'.$contact_us['email_input'].'"';?>
            },
            message:{
                elemClass:'message-input',
      <?php print 'elemText:"'.$contact_us['message_input'].'"';?>
            }
        };
    }());
</script>
<?php echo '<script type="text/javascript" src="'.base_path().path_to_theme().'/js/lib/contact-0.0.2.min.js"></script>';?>
<div id="1contact-me">
    <div id="1contact-me-pages">
        <div class="tab">
             <div class="full-width">
                    <?php print '<p>'.$contact_us['content'][0].'</p>';?>
                 <div id="app-contact">
                    </div>
            </div>
        </div>
  </div>
</div>
</div>
</div>
