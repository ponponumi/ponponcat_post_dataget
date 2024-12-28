<?php get_header() ?>

<h1>記事一覧</h1>
<ul>
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
        <?php endwhile ?>
    <?php endif;wp_reset_query(); ?>
</ul>

<?php get_footer() ?>
