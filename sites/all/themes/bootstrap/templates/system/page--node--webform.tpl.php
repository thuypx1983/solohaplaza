<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
?>

<div class="bg-header">
    <div class="header-top">
        <div class="<?php print $container_class; ?>">
            <div class="row"><?php print render($page['header_top']); ?></div>
        </div>
    </div>
    <div class="header-center">
        <div class="<?php print $container_class; ?>">
            <div class="row"><?php print render($page['header_center']); ?></div>

        </div>
    </div>
    <div class="header-bottom">
        <div class="<?php print $container_class; ?>">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <?php
                    $block = block_load('tb_megamenu', 'main-menu');
                    $output = @drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));
                    print $output;

                    ?>
                </div>
                <div class="col-md-9 col-lg-9">
                    <div class="row">
                        <a href="#mobile-menu" class="hidden-lg hidden-md mobile-menu"><i class="fa fa-bars"></i></a>
                        <?php print render($page['header_bottom']); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo '<nav id="mobile-menu">';
    function render_menu_tree($menu_tree) {
        print '<ul>';
        foreach ($menu_tree as $link) {
            print '<li>';
            $link_path = '#';
            $link_title = $link['link']['link_title'];
            if($link['link']['link_path']) {
                $link_path = drupal_get_path_alias($link['link']['link_path']);
            }
            print '<a href="/' . $link_path . '">' . $link_title . '</a>';
            if(count($link['below']) > 0) {
                render_menu_tree($link['below']);
            }
            print '</li>';
        }
        print '</ul>';
    }
    $main_menu_tree = menu_tree_all_data('main-menu', null, 3);

    render_menu_tree($main_menu_tree);
    echo '</div>';
    ?>
</div>

<div class="main-container <?php print $container_class; ?>">

    <header role="banner" id="page-header">
        <?php if (!empty($site_slogan)): ?>
            <p class="lead"><?php print $site_slogan; ?></p>
        <?php endif; ?>

        <?php print render($page['header']); ?>
    </header> <!-- /#page-header -->

    <div class="">



        <section>
            <div class="">
                <?php if (!empty($page['highlighted'])): ?>
                    <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
                <?php endif; ?>


                <?php print render($title_suffix); ?>
                <?php print $messages; ?>
                <?php if (!empty($tabs)): ?>
                    <?php print render($tabs); ?>
                <?php endif; ?>
                <?php if (!empty($page['help'])): ?>
                    <?php print render($page['help']); ?>
                <?php endif; ?>
                <?php if (!empty($action_links)): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <?php if (!empty($breadcrumb)): print $breadcrumb; endif; ?>

                <?php print render($title_prefix); ?>
                <?php if (!empty($title)): ?>
                    <h1 class="page-header"><?php print $title; ?></h1>
                <?php endif; ?>
                <?php print render($page['content']); ?>
            </div>
        </section>

    </div>
    <div>
        <?php if (!empty($page['content_bottom'])): ?>
            <?php print render($page['content_bottom']); ?>
        <?php endif; ?>
    </div>
</div>
<footer class="footer-global">

    <?php if (!empty($page['footer_top'])): ?>
        <div class="footer-top">
            <div class="<?php print $container_class; ?>">
                <?php print render($page['footer_top']); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($page['footer'])): ?>
        <div class="footer-middle">
            <div class="<?php print $container_class; ?>">
                <div class="row">
                    <?php print render($page['footer']); ?>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <?php if (!empty($page['footer_bottom'])): ?>
        <div class="footer-bottom">
            <div class="<?php print $container_class; ?>">
                <div class="row">
                    <?php print render($page['footer_bottom']); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>