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

function importNode($data,$data_done,$types,$menus){

    $node = new stdClass(); // We create a new node object
    $node->type = "product"; // Or any other content type you want
    $node->title = $data['p_name'];
    $node->uid = 1;
    $node->language = LANGUAGE_NONE; // Or any language code if Locale module is enabled. More on this below *
    node_object_prepare($node); // Set some default values.

    // Let's add standard body field
    $node->body[$node->language][0]['value'] = $data['p_thongso'];
    $node->body[$node->language][0]['format'] = 'full_html';

    // Let's add some CCK/Fields API field. This is pretty similar to the body example
    $node->field_price[$node->language][0]['value'] = (int)$data['p_dongia'];
    $node->field_code[$node->language][0]['value'] = $data['p_ma'];

    if($data['tid'])
    {
        $node->field_product_category[$node->language][]['tid']=$types[$data['tid']]['tid'];
    }
    else{
        $node->field_product_category[$node->language][]['tid']=$menus[$data['category_id']]['tid'];
    }

    //
    for($i=1;$i<=9;$i++){
        if($data['image0'.$i]){
            $filename=$data['image0'.$i];
            $url="http://noithattructuyen.net/images/product/".$filename;
            $file = file_save_data(file_get_contents($url), 'public://' . $filename, FILE_EXISTS_RENAME);

            $node->field_image[$node->language][] = (array)$file;
        }

    }
    $node = node_submit($node); // Prepare node for a submit
    node_save($node); // After this call we'll get a nid
    if($data['metatitle']){
        $metatags[$node->language]['title']=$data['metatitle'];
        $metatags[$node->language]['description']=$data['metakey'];
        $metatags[$node->language]['keywords']=$data['metadesc'];
        metatag_metatags_save('node',$node->nid,$node->vid,$metatags);
    }

}

$datas=json_decode(file_get_contents('tbl_products.json'),true);
$data_done=json_decode(file_get_contents('tbl_products_imported.json'),true);
$types=json_decode(file_get_contents('tbl_type.json'),true);
$menus=json_decode(file_get_contents('tbl_menu.json'),true);
foreach ($datas as $key=>$item){
    importNode($item,$data_done,$types,$menus);
    unset($datas[$key]);
    file_put_contents('tbl_products.json',json_encode($datas));
    break;
}
?>