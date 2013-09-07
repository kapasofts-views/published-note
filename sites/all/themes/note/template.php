<?php
function note_preprocess_html(&$vars, $hook) {
    global $conf;
    // Return nid of nodes of type "interface_configuraitons".
    $nid_config = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'interface_configurations')
        ->execute()
        ->fetchCol();
    //load the configurations
    $configurationNode = node_load($nid_config);
    $interfaceConfig = array();

    if(!empty($configurationNode->field_driver_url['und'][0]['value'])){
        //if set by user
        $interfaceConfig['driver_url'] = $configurationNode->field_driver_url['und'][0]['value'];
    }else{
        //hard coded in default/settings.php
        $interfaceConfig['driver_url'] = $conf['global_driver_url'];
    }
    if(!empty($configurationNode->field_driver_port['und'][0]['value'])){
        //if set by user
        $interfaceConfig['driver_port'] = $configurationNode->field_driver_port['und'][0]['value'];
    }else{
        //hard coded in default/settings.php
        $interfaceConfig['driver_port'] = $conf['global_driver_port'];
    }

        $vars['interfaceConfig'] = $interfaceConfig;

    /****Retrieving Main Menu******/
    $mainMenuArray = menu_load_links('main-menu');
    $finalMainMenu = array();
    foreach($mainMenuArray as $key=>$menuItem){
        global $language;
        $currentLang = $language->language;
        if($menuItem['language'] == 'und'){
            $menuItem['language'] = language_default('language');
        }
        if($currentLang == $menuItem['language'] ){
            $linkPath = $menuItem['link_path'];
            //load menu item node to retrieve icon image
            $menu_item_id = substr($linkPath,strrpos($linkPath,'/')+1);
            $menu_item_node = node_load($menu_item_id);

            $finalMainMenu[$key]['menu_icon_url'] = url('sites/default/files/'.file_uri_target($menu_item_node->field_menu_icon[LANGUAGE_NONE][0]['uri']),array('absolute'=>true, 'language' => (object)array('language' => FALSE)));
            $finalMainMenu[$key]['menu_icon_alt'] = $menu_item_node->field_menu_icon[LANGUAGE_NONE][0]['alt'];

            //hightlight the selected menu item
            $finalMainMenu[$key]['active'] = '';
            $linkPathAlias = drupal_get_path_alias($linkPath, $currentLang);
            $currentUrl = drupal_get_path_alias($_GET['q'],$currentLang);

            if($currentUrl == $linkPathAlias){
                $finalMainMenu[$key]['active'] = 'muted-img';
            }
            $finalMainMenu[$key]['url'] = $linkPathAlias;
            $finalMainMenu[$key]['title'] = $menuItem['link_title'];
        }
    }
    $vars['mainMenu'] = $finalMainMenu;

    // Get a list of all the regions for this theme
    foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {

        // Get the content for each region and add it to the $region variable
        if ($blocks = block_get_blocks_by_region($region_key)) {
            $vars['region'][$region_key] = $blocks;
        }
        else {
            $vars['region'][$region_key] = array();
        }
    }

    //retrieving current page for seo content
    $nodes_array = $vars["page"]["content"]["system_main"]["nodes"];
    if($nodes_array != null){
        $nodeId=max(array_keys($nodes_array));
        $currentNode = $vars["page"]["content"]["system_main"]["nodes"][$nodeId]["#node"];
        $page_seo = array();
        $page_seo['title'] = $currentNode->field_title_seo[LANGUAGE_NONE][0]['value'];
        $page_seo['desc'] = $currentNode->field_description_seo[LANGUAGE_NONE][0]['value'];
        $page_seo['keywords'] = $currentNode->field_keywords_seo[LANGUAGE_NONE][0]['value'];
        $vars['page_seo'] = $page_seo;
    }else{
        $vars['page_seo'] = array();
    }


//    $page_seo['title'] = $currentNode->
//    $fieldName = "field_seo_".$currentType->type;
//    $seoTextIns = $currentType->$fieldName;
//    $seoText = node_load($seoTextIns['und'][0]['target_id']);
//    $seoTitle = $seoText->field_seo_title['und'][0]['value'];
//    $seoDescription = $seoText->field_seo_description['und'][0]['value'];
//    $seoKeywords = $seoText->field_seo_keywords['und'][0]['value'];
//
//    if(!empty($seoTitle)){
//        $vars['seo_title'] = $seoTitle;
//    }else{
//        $vars['seo_title'] = $seoGenTitle;
//    }
//
//    if(!empty($seoDescription)){
//        $vars['seo_description'] = $seoDescription;
//    }else{
//        $vars['seo_description'] = $seoGenDescription;
//    }
//
//    if(!empty($seoKeywords)){
//        $vars['seo_keywords'] = $seoKeywords;
//    }else{
//        $vars['seo_keywords'] = $seoGenKeywords;
//    }

    // Retreiving Disclaimer
    global $language;
    $vars['selected_lang'] = $language->language;
    $nid_disclaimer = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'disclaimer')
        ->condition('n.language', $language->language)
        ->execute()
        ->fetchCol();
    //load the configurations
    $disclaimerNode = node_load($nid_disclaimer);
    $disclaimer = array();
    $disclaimer['term_for_removing'] = $disclaimerNode->field_term_for_removing[LANGUAGE_NONE][0]['value'];
    $disclaimer['description_for_removing'] = $disclaimerNode->field_description_for_removing[LANGUAGE_NONE][0]['value'];
    $disclaimer['term_for_staying'] = $disclaimerNode->field_term_for_staying[LANGUAGE_NONE][0]['value'];
    $disclaimer['description_for_staying'] = $disclaimerNode->field_description_for_staying[LANGUAGE_NONE][0]['value'];
    $disclaimer['icons'] = array();
    $disclaimer['icons']['icon_removed'] = array();
    $disclaimer['icons']['icon_removed']['url'] = url('sites/default/files/'.file_uri_target($disclaimerNode->field_icon_for_remove[LANGUAGE_NONE][0]['uri']),array('absolute'=>true, 'language' => (object)array('language' => FALSE)));
    $disclaimer['icons']['icon_removed']['alt'] = $disclaimerNode->field_icon_for_remove[LANGUAGE_NONE][0]['alt'];
    $disclaimer['icons']['icon_for_stay'] = array();
    $disclaimer['icons']['icon_for_stay']['url'] = url('sites/default/files/'.file_uri_target($disclaimerNode->field_icon_for_stay[LANGUAGE_NONE][0]['uri']),array('absolute'=>true, 'language' => (object)array('language' => FALSE)));
    $disclaimer['icons']['icon_for_stay']['alt'] = $disclaimerNode->field_icon_for_stay[LANGUAGE_NONE][0]['alt'];
    $vars['disclaimer'] = $disclaimer;
}

function note_preprocess_block(&$vars){

    if($vars['block_html_id'] == "block-locale-language"){
        global $language;
        $currentLang = $language->language;
        $languages = language_list();

//        $translation_paths = array();
        $translation_paths = translation_path_get_translations($_GET['q']);

        $lang_menu = array();
        $index = 1;
        foreach($languages as $lang){
            if($lang->enabled){
                $lang_code = $lang->language;
                if($lang_code != $currentLang){//don' add to list if current language
                    $lang_menu[$index] = array();
                    $lang_menu[$index]['name'] = $lang->native;
                    if(language_default('language') == $lang_code){
                        $lang_menu[$index]['url'] = '/'.drupal_get_path_alias($translation_paths[$lang_code], $lang_code);
                    }else{
                        $lang_menu[$index]['url'] = '/'.$lang->language.'/'.drupal_get_path_alias($translation_paths[$lang_code], $lang_code);
                    }
                    $index++;
                }
            }
        }

        //add the selected language first in the list, so properly rendered
        $lang_menu[0] = array();
        $lang_menu[0]['name'] = $language->native;

        $vars['lang_menu'] = $lang_menu;
    }

}

function note_preprocess_page(&$vars, $hook) {

    if (isset($vars['node'])) {
        $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
        switch($vars['node']->type){
            case "home":
                note_preprocess_home($vars, $hook);
                break;
            case "debt":
                note_preprocess_debt($vars, $hook);
                break;
            case "facts":
                note_preprocess_facts($vars, $hook);
                break;
            case "contact_us":
                note_preprocess_contactus($vars, $hook);
                break;
            default:
                note_preprocess_home($vars, $hook);
                break;
        }
    }
}

function note_preprocess_home(&$vars, $hook){
    $home = array();
    $node = $vars['node'];
    $home['page_title'] = $node->field_page_title[LANGUAGE_NONE][0]['value'];
    $home['announcement'] = $node->field_announcement[LANGUAGE_NONE][0]['value'];
    $home['announcement_prefix'] = $node->field_announcement_prefix[LANGUAGE_NONE][0]['value'];
    $home['debtor_portrait'] = array();
    $home['debtor_portrait']['url'] = url('sites/default/files/'.file_uri_target($node->field_debtor_portrait[LANGUAGE_NONE][0]['uri']),array('absolute'=>true, 'language' => (object)array('language' => FALSE)));
    $home['debtor_portrait']['alt'] =$node->field_debtor_portrait[LANGUAGE_NONE][0]['alt'];
    $home['debtor_portrait']['foot_note'] = $node->field_debtor_portrait_foot_note[LANGUAGE_NONE][0]['value'];
    $home['debtor_portrait']['title'] = $node->field_debtor_portrait_title[LANGUAGE_NONE][0]['value'];
    $home['button_text'] = $node->field_button_text[LANGUAGE_NONE][0]['value'];
    $vars['home'] = $home;
}

function note_preprocess_debt(&$vars, $hook){
    $debt = array();
    $node = $vars['node'];
    $debt['page_title'] = $node->field_page_title[LANGUAGE_NONE][0]['value'];
    $debt['about_debtor'] = array();
    $about_ref = $node->field_about_debtor[LANGUAGE_NONE][0]['entity'];
    $debt['about_debtor']['title'] = $about_ref->field_description_of_list[LANGUAGE_NONE][0]['value'];
    $debt['about_debtor']['list'] = array();
    foreach($about_ref->field_description_list_item[LANGUAGE_NONE] as $key => $item){
        $item_instance = node_load($item['target_id']);
        $debt['about_debtor']['list'][$key] = array();
        $debt['about_debtor']['list'][$key]['term'] = $item_instance->field_term[LANGUAGE_NONE][0]['value'];
        $debt['about_debtor']['list'][$key]['description'] = $item_instance->field_description[LANGUAGE_NONE][0]['value'];
    }

    $debt['events'] = array();
    $about_ref = $node->field_events[LANGUAGE_NONE][0]['entity'];
    $debt['events']['title'] = $about_ref->field_description_of_list[LANGUAGE_NONE][0]['value'];
    $debt['events']['list'] = array();
    foreach($about_ref->field_description_list_item[LANGUAGE_NONE] as $key => $item){
        $item_instance = node_load($item['target_id']);
        $debt['events']['list'][$key] = array();
        $debt['events']['list'][$key]['term'] = $item_instance->field_term[LANGUAGE_NONE][0]['value'];
        $debt['events']['list'][$key]['description'] = $item_instance->field_description[LANGUAGE_NONE][0]['value'];
    }

    $debt['financial_obligations'] = array();
    $about_ref = $node->field_financial_obligations[LANGUAGE_NONE][0]['entity'];
    $debt['financial_obligations']['title'] = $about_ref->field_description_of_list[LANGUAGE_NONE][0]['value'];
    $debt['financial_obligations']['list'] = array();
    foreach($about_ref->field_list_item[LANGUAGE_NONE] as $key => $item){
        $debt['financial_obligations']['list'][$key] = $item['value'];
    }

    $debt['button_text'] = $node->field_button_text[LANGUAGE_NONE][0]['value'];

    $vars['debt'] = $debt;
}

function note_preprocess_facts(&$vars, $hook){
    $proof = array();
    $node = $vars['node'];
    $proof['page_title'] = $node->field_page_title[LANGUAGE_NONE][0]['value'];

    $proof['content'] = array();
    foreach($node->field_paragraph_of_content[LANGUAGE_NONE] as $key => $paragraph){
        $proof['content'][$key] = $paragraph['value'];
    }
    $proof['button_text'] = $node->field_button_text[LANGUAGE_NONE][0]['value'];
    $vars['proof'] = $proof;
}

function note_preprocess_contactus(&$vars, $hook){
    $contact_us = array();
    $node = $vars['node'];
    $contact_us['page_title'] = $node->field_page_title[LANGUAGE_NONE][0]['value'];
    $contact_us['name_input'] = $node->field_name_input[LANGUAGE_NONE][0]['value'];
    $contact_us['email_input'] = $node->field_email_input[LANGUAGE_NONE][0]['value'];
    $contact_us['message_input'] = $node->field_message_input[LANGUAGE_NONE][0]['value'];
    $contact_us['contact_button'] = $node->field_contact_button[LANGUAGE_NONE][0]['value'];
    $contact_us['response_message'] = $node->field_response_message[LANGUAGE_NONE][0]['value'];

    $contact_us['content'] = array();
    foreach($node->field_paragraph_of_content[LANGUAGE_NONE] as $key => $paragraph){
        $contact_us['content'][$key] = $paragraph['value'];
    }
    $contact_us['button_text'] = $node->field_button_text[LANGUAGE_NONE][0]['value'];
    $vars['contact_us'] = $contact_us;
}