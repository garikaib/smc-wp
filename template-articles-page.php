<?php
/**
 * Template Name: Articles Home
 * Description: A premium articles index page with hero section and glassmorphic grid.
 */

get_header(); ?>

<div class="smc-articles-page">
    
    <!-- HERO SECTION -->
    <div class="smc-articles-hero">
        <div class="hero-overlay"></div>
        <div class="smc-container">
            <?php
            // Get the latest post for the hero
            $hero_query = new WP_Query( array(
                'posts_per_page' => 1,
                'ignore_sticky_posts' => 1
            ) );

            if ( $hero_query->have_posts() ) :
                while ( $hero_query->have_posts() ) : $hero_query->the_post();
                    $hero_id = get_the_ID();
                    $hero_bg = get_the_post_thumbnail_url( $hero_id, 'full' );
                    $hero_cat = get_the_category();
                    $hero_cat_name = ! empty( $hero_cat ) ? $hero_cat[0]->name : 'Insight';
            ?>
                <div class="hero-content" data-aos="fade-up">
                    <span class="hero-badge"><?php echo esc_html( $hero_cat_name ); ?></span>
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    <div class="hero-meta">
                        <span class="meta-date"><?php echo get_the_date(); ?></span>
                        <span class="meta-sep">•</span>
                        <span class="meta-author">By <?php the_author(); ?></span>
                    </div>
                    <div class="hero-excerpt">
                        <?php echo get_the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="smc-cta-btn hero-btn">Read Article</a>
                </div>
                
                <style>
                    .smc-articles-hero {
                        background-image: url('<?php echo esc_url( $hero_bg ); ?>');
                    }
                </style>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="smc-filter-bar">
        <div class="smc-container">
            <div class="filter-header">
                <h2>Latest Insights</h2>
                <div class="filter-actions">
                    <!-- Placeholder for future category filters -->
                    <span class="filter-label">Viewing All Articles</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ARTICLE GRID -->
    <div class="smc-container">
        <div class="smc-article-grid">
            <?php
            // Query for remaining posts
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'posts_per_page' => 9,
                'paged' => $paged,
                'post__not_in' => array( $hero_id ) // Exclude hero post
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post();
                    $cat = get_the_category();
                    $cat_name = ! empty( $cat ) ? $cat[0]->name : 'Article';
            ?>
                <article class="smc-article-card" id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>" class="card-link">
                        <div class="card-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            <?php else : ?>
                                <div class="placeholder-img"></div>
                            <?php endif; ?>
                            <span class="card-category"><?php echo esc_html( $cat_name ); ?></span>
                        </div>
                        <div class="card-content">
                            <span class="card-date"><?php echo get_the_date(); ?></span>
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <p class="card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                            <span class="read-more">Read More <i data-lucide="arrow-right"></i></span>
                        </div>
                    </a>
                </article>
            <?php
                endwhile;
                
                // Pagination
                echo '<div class="smc-pagination">';
                echo paginate_links( array(
                    'total' => $query->max_num_pages,
                    'prev_text' => '<i data-lucide="chevron-left"></i> Prev',
                    'next_text' => 'Next <i data-lucide="chevron-right"></i>',
                ) );
                echo '</div>';
                
                wp_reset_postdata();
            else :
                echo '<p>No articles found.</p>';
            endif;
            ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // GSAP Animations
    if (typeof gsap !== 'undefined') {
        gsap.from(".hero-content", {
            duration: 1,
            y: 50,
            opacity: 0,
            ease: "power3.out",
            delay: 0.2
        });

        gsap.utils.toArray(".smc-article-card").forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none reverse"
                },
                duration: 0.8,
                y: 50,
                opacity: 0,
                ease: "power2.out",
                delay: i * 0.1 // Simple stagger based on index if visible at start
            });
        });
    }
});
</script>

<?php get_footer(); ?>
