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

// Return all nids of nodes of type "page".
$nids = db_select('node', 'n')
    ->fields('n', array('nid'))
    ->fields('n', array('type'))
    ->condition('n.type', 'product')
    ->execute()
    ->fetchCol(); // returns an indexed array

// Now return the node objects.
$nodes = node_load_multiple($nids);
foreach ($nodes as $node){
    if(isset($node->body[LANGUAGE_NONE][0]['value'])){
        $node->body[LANGUAGE_NONE][0]['value']=str_replace('/kcfinder/upload/images/','/sites/default/files/',$node->body[LANGUAGE_NONE][0]['value']);

        //field_attach_update('node', $article_node);
        echo 'kkk';
        die();
    }

}
