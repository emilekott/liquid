<?php
/**
 *
 * Description: Main Homepage template.
 *
 */
get_header();
$postID = array();
?>

<div id="main">

<?php
$layout = $data['homepage_blocks']['enabled'];
if ($layout):
  foreach ($layout as $key => $value) {
    switch ($key) {
      case 'work_block':
        ?>

          <section id="latest-work">

            <div class="container">

              <div class="row">

                <h1><?php echo $data['text_portfolio_title']; ?></h1>

        <?php echo do_shortcode(stripslashes($data['textarea_portfolio_overview'])); ?>

              </div><!-- end .row -->

              <div class="row">

                <div id="portfolio-filter">
                  <h4 class="filter-title">Filter Gallery Images</h4>
                  <ul id="filter">
                    <li><a href="#" class="current" data-filter="*"><?php _e('Show all', 'kula'); ?></a></li>
        <?php
        $categories = get_categories(array(
          'type' => 'post',
          'taxonomy' => 'project-type'
            ));
        foreach ($categories as $category) {
          $group = $category->slug;
          echo "<li class='project-type'><a href='#' data-filter='.$group'>" . $category->cat_name . "</a></li>";
        }
        ?>
                  </ul><!-- end #filter -->

                </div><!-- end #portfolio-filter -->

                <div id="portfolio-items">

        <?php
        query_posts(array(
          'post_type' => 'portfolio',
          'orderby' => 'menu_order',
          'order' => 'ASC',
          'posts_per_page' => -1
        ));
        ?>

                  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                      <?php
                      $terms = get_the_terms($post->ID, 'project-type');
                      $term_list = '';
                      if (is_array($terms)) {
                        foreach ($terms as $term) {
                          $term_list .= urldecode($term->slug);
                          $term_list .= ' ';
                        }
                      }
                      ?>

                      <div <?php post_class("$term_list one-third column"); ?> id="post-<?php the_ID(); ?>">

                        <div class="project-item">

                          <div class="project-image">
            <?php the_post_thumbnail('portfolio-thumb'); ?>
                            <div class="overlay">
                              <div class="details">
                                <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?><span>.</span></a></h2>
                              </div>
                            </div>
                          </div><!-- end .project-image -->

                        </div><!-- end .project-item -->

                      </div><!-- end .one-third -->

            <?php
          endwhile;
        endif;
        ?>

                </div><!-- end #portfolio-items -->

              </div><!-- end .row -->

            </div><!-- end .container -->

          </section><!-- end #latest-work -->

        <?php
        break;
      case 'quotes_top_block':
        ?>

          <div id="section-divider-1">

            <div class="bg1"></div>

            <div class="container">

              <div class="text-container">

                <section class="latest-quotes">

        <?php
        $args = array('post_type' => 'post', 'posts_per_page' => 1, 'cat' => -8);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          ?>
                    <h2><?php the_title(); ?></h2>
                    <?php
                    the_content();
                    $posttags = get_the_tags();
                    $postID[] = get_the_id();
                    if ($posttags) {
                      $tagids = array();

                      foreach ($posttags As $tag) {
                        $tagids[] = $tag->term_id;
                      }
                    }
                    ?>



                  <?php endwhile; ?>
        <?php
        //grab a random post based on tegs

        if ($posttags) {

          wp_reset_query();
          $args = array('post_type' => 'post', 'posts_per_page' => 1, 'orderby' => 'rand', 'tag__in' => $tagids, 'post__not_in' => $postID);
          $loop = new WP_Query($args);
          while ($loop->have_posts()) : $loop->the_post();
            $postID[] = get_the_id();
            ?>
                      <div class="discover-icon">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/discover.png" /></a>
                      </div>
                      <div class="discover-desc"><p class="discover"><a href="<?php the_permalink(); ?>">DISCOVERABLE ELEMENT...</a></p>
                        <p>Click to discover automatic and randomly generated content from the website.</p>
                      </div>
                      <div class="clear"></div>
            <?php
          endwhile;
        }
        ?>








                </section><!-- end .latest-quotes -->

              </div><!-- end .text-container -->

            </div><!-- end .container -->

          </div><!-- end #section-divider-1 -->

        <?php
        break;
      case 'services_block':
        ?>

          <section id="services">

            <div class="container">


              <div id="all-services">

        <?php
        global $data;

        $args = array('post_type' => 'services', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $data['select_services']);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          ?>

                  <div class="service one-fifth column"><div class="service-inner">


          <?php
          if (has_post_thumbnail()) {
            if (get_post_meta($post->ID, 'gt_service_url', true)) {
              echo '<a href=' . get_post_meta($post->ID, 'gt_service_url', true) . '>' . get_the_post_thumbnail($post->ID, 'services-thumb') . '</a>';
            }
            else {
              the_post_thumbnail('services-thumb');
            }
          }
          ?>
                      <h3><?php the_title(); ?></h3>

                      <?php the_content(); ?>

          <?php if (get_post_meta($post->ID, 'gt_service_url', true)) { ?>
                        <a class="read-more-btn" href="<?php echo get_post_meta($post->ID, 'gt_service_url', true) ?>"><?php _e('Read more', 'kula'); ?> <span>&rarr;</span></a>
                      <?php } ?>
                    </div>
                  </div><!-- end .service -->

                    <?php endwhile; ?>

              </div><!-- end #all-services -->

            </div><!-- end .container -->

          </section><!-- end #services -->

        <?php
        break;
      case 'logos_block':
        ?>

          <div id="section-divider-2">

            <div class="bg2"></div>

            <div class="container">

              <div class="text-container">

                <div class="logos sixteen columns">

                  <h2><?php echo $data['text_client_logos_title']; ?></h2>

                  <ul id="client-logos">
        <?php if ($data["client_logo_one"]) { ?>
                      <li><a href="<?php echo $data['client_logo_one_url']; ?>"><img src="<?php echo $data['client_logo_one']; ?>" alt="" /></a></li>
        <?php } if ($data["client_logo_two"]) { ?>
                      <li><a href="<?php echo $data['client_logo_two_url']; ?>"><img src="<?php echo $data['client_logo_two']; ?>" alt="" /></a></li>
                    <?php } if ($data["client_logo_three"]) { ?>
                      <li><a href="<?php echo $data['client_logo_three_url']; ?>"><img src="<?php echo $data['client_logo_three']; ?>" alt="" /></a></li>
                    <?php } if ($data["client_logo_four"]) { ?>
                      <li><a href="<?php echo $data['client_logo_four_url']; ?>"><img src="<?php echo $data['client_logo_four']; ?>" alt="" /></a></li>
                    <?php } if ($data["client_logo_five"]) { ?>
                      <li><a href="<?php echo $data['client_logo_five_url']; ?>"><img src="<?php echo $data['client_logo_five']; ?>" alt="" /></a></li>
                    <?php } ?>	
                  </ul>

                </div><!-- end .logos -->

              </div><!-- end .text-container -->

            </div><!-- end .container -->

          </div><!-- end #section-divider-2 -->

        <?php
        break;
      case 'news_block':
        ?>

          <section id="latest-news">

            <div class="container">


              <div id="articles">

        <?php
        global $data;

        $args = array('post_type' => 'post', 'posts_per_page' => 1, 'cat' => 8, 'post__not_in' => $postID);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          $postID[] = get_the_id();
          ?>

                  <article class="article ">
                    <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                    <div class="thumbnail">
          <?php the_post_thumbnail('featured-news'); ?>
                    </div>




                    <div class="content">
          <?php the_content(); ?>
                    </div>


                  </article><!-- end article -->

        <?php endwhile; ?>

              </div><!-- end #articles -->

            </div><!-- end .container -->

          </section><!-- end #latest-news -->

        <?php
        break;
      case 'quotes_bottom_block':
        ?>

          <div id="section-divider-3">

            <div class="bg3"></div>

            <div class="container">

              <div class="text-container">

                <section class="latest-quotes">

                  <ul class="quotes">

        <?php
        global $data;

        $args = array('post_type' => 'quotes', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          ?>

                      <li>
                        <blockquote><?php echo get_post_meta($post->ID, 'gt_quotes_quote', true) ?></blockquote>
                        <cite><?php echo get_post_meta($post->ID, 'gt_quotes_author', true) ?></cite>
                      </li>

        <?php endwhile; ?>

                  </ul><!-- end .quotes -->

                </section><!-- end .latest-quotes -->

              </div><!-- end .text-container -->

            </div><!-- end .container -->

          </div><!-- end #section-divider-3 -->

        <?php
        break;
      case 'team_block':
        ?>

          <section id="meet-the-team">

            <div class="container">
              <div id="articles">

        <?php

        $args = array('post_type' => 'post', 'posts_per_page' => 1, 'cat' => 8, 'post__not_in' => $postID);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
          $postID[] = get_the_id();
          ?>

                  <article class="article ">
                    <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
         




                    <div class="content">
          <?php the_content(); ?>
                    </div>


                  </article><!-- end article -->

        <?php endwhile; ?>

              </div><!-- end #articles -->

            </div><!-- end .container -->

          </section><!-- end #meet-the-team -->

        <?php
        break;
    }
  } endif;
?>

</div><!-- end #main -->

  <?php get_footer(); ?>