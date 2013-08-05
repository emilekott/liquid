<!DOCTYPE html>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  <head>

    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

    <!-- Meta
    ================================================== -->

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- Favicons
    ================================================== -->

    <link rel="shortcut icon" href="<?php
global $data;
echo $data['custom_favicon'];
?>">
    <link rel="apple-touch-icon" href="<?php get_template_directory_uri(); ?>assets/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php get_template_directory_uri(); ?>assets/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php get_template_directory_uri(); ?>assets/img/apple-touch-icon-114x114.png">
    <script type="text/javascript" src="//use.typekit.net/hdl4ppo.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?> >

<?php if (is_front_page()) { ?>

      <div class="header-background-image"></div>

    <?php
    }
    else {
      ?>

      <div class="header-background-image-inner"></div>

<?php } ?>

    <header id="header-global" role="banner">

      <div id="header-background">

        <div class="logo-icons container">

          <div class="row">

            <div class="header-logo three columns">

              <?php if ($data['text_logo']) { ?>
                <div id="logo-default"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
              <?php
              }
              elseif ($data['custom_logo']) {
                ?>
                <div id="logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $data['custom_logo']; ?>" alt="Header Logo" /></a></div>
<?php } ?>

            </div><!-- end .header-logo -->

            <div id="special-navigation" class="fifteen columns" role="navigation">
              <?php if (is_front_page()) { ?>

                <?php
                $header_menu_args = array(
                  'menu' => 'Header',
                  'theme_location' => 'Front',
                  'container' => false,
                  'menu_id' => 'navigation'
                );

                wp_nav_menu($header_menu_args);
                ?>

              <?php
              }
              else {
                ?>

                <?php
                $header_menu_args = array(
                  'menu' => 'Header',
                  'theme_location' => 'Inner',
                  'container' => false,
                  'menu_id' => 'navigation'
                );

                wp_nav_menu($header_menu_args);
                ?>

<?php } ?>

            </div><!-- end nav -->

          </div><!-- end .row -->

        </div><!-- end .logo-icons container -->

      </div><!-- end #header-background -->



      <?php if (is_front_page()) { ?>
        <?php
        $args = array('page_id' => 21);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          ?>

          <div class="embed-container">
                 <!-- <iframe src="http://player.vimeo.com/video/14074949" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>  </iframe> -->
            <?php the_content(); ?>

          </div>

        <?php endwhile; ?>

<?php
}
else {
  ?>
<?php } ?>

    </header><!-- end #header-global -->
