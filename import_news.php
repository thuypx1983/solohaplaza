<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
menu_execute_active_handler();

function importNode($data){

    $array = array();
    preg_match_all( '/src="([^"]*)"/i', $data['fullcontent'], $array ) ;
    $keys=$array[1];
    if(count($keys)>0){
        $values=array();
        foreach($keys as $img){
            if (strpos($img, "http") === false){
                $img='http://noithattructuyen.net'.$img;
            }
            $filename= '/sites/default/files/'.basename($img);
            $values[]=$filename;
            file_put_contents(DRUPAL_ROOT.$filename, file_get_contents($img));
        }
        $data['fullcontent']=str_replace($keys, $values, $data['fullcontent']);
    }

    $node = new stdClass(); // We create a new node object
    $node->type = "article"; // Or any other content type you want
    $node->title = $data['title'];
    $node->uid = 1;
    $node->language = LANGUAGE_NONE; // Or any language code if Locale module is enabled. More on this below *
    node_object_prepare($node); // Set some default values.

    // Let's add standard body field
    $node->body[$node->language][0]['value'] = $data['fullcontent'];
    $node->body[$node->language][0]['summary'] = $data['introcontent'];
    $node->body[$node->language][0]['format'] = 'full_html';


    $node->field_category_news[$node->language][]['tid']=219;

    //
    $filename=$data['images'];
    if($filename){
        $url="http://noithattructuyen.net/images/news/".$filename;
        $file = file_save_data(file_get_contents($url), 'public://' . $filename, FILE_EXISTS_RENAME);

        $node->field_image[$node->language][] = (array)$file;
    }


    $node = node_submit($node); // Prepare node for a submit
    node_save($node); // After this call we'll get a nid
    if($data['metatitle']){
        $metatags[$node->language]['title']['value']=$data['metatitle'];
        $metatags[$node->language]['description']['value']=$data['metadesc'];
        $metatags[$node->language]['keywords']['value']=$data['metakey'];
        metatag_metatags_save('node',$node->nid,$node->vid,$metatags);
    }


}

$datas=json_decode(file_get_contents('tbl_news.json'),true);
foreach ($datas as $key=>$item){
    importNode($item);
    unset($datas[$key]);
    file_put_contents('tbl_news.json',json_encode($datas));
   
    break;
}
?>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 1000);
</script>
