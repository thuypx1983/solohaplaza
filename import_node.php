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

function importNode($data,$types,$menus){
    $node = new stdClass(); // We create a new node object
    $node->type = "product"; // Or any other content type you want
    $node->title = $data['p_name'];
    $node->language = LANGUAGE_NONE; // Or any language code if Locale module is enabled. More on this below *
    node_object_prepare($node); // Set some default values.

    // Let's add standard body field
    $node->body[$node->language][0]['value'] = $data['p_thongso'];
    $node->body[$node->language][0]['format'] = 'filtered_html';

    // Let's add some CCK/Fields API field. This is pretty similar to the body example
    $node->field_price[$node->language][0]['value'] = $data['p_dongia'];
    $node->field_code[$node->language][0]['value'] = $data['p_max'];

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
            $file =  array(
                'uid' => 1,
                'uri' => 'public://'.$data['image0'.$i],
                'filemime' => 'image/jpeg',
                'status' => 1,
            );
            $node->field_image[LANGUAGE_NONE][0] = $file;
        }

        var_dump($node);die();
    }



}

$data=json_decode(file_get_contents('tbl_products.json'),true);
$types=json_decode(file_get_contents('tbl_type.json'),true);
$menus=json_decode(file_get_contents('tbl_menu.json'),true);
foreach ($data as &$item){
    importNode($item,$types,$menus);
    die('xxx');
}
unset($item);
#file_put_contents('tbl_menu_news.json',json_encode($data));