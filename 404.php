<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package smc
 */

get_header(); ?>

<div class="smc-404-page">
    <div class="smc-container">
        
        <div class="smc-404-content">
            <span class="smc-badge">ERROR 404</span>
            <h1>Strategic Detour?</h1>
            <p>Even the most robust business models face unexpected variables. This page seems to be missing from our current projection, but your growth journey continues.</p>
            
            <div class="smc-404-actions">
                <a href="<?php echo home_url('/'); ?>" class="smc-btn smc-btn-primary">Return to Hub</a>
                <a href="<?php echo home_url('/premium-assessment/'); ?>" class="smc-btn smc-btn-secondary">Analyze Your Business</a>
            </div>

            <div class="smc-404-search">
                 <p class="search-label">Or search our business insights:</p>
                 <?php get_search_form(); ?>
            </div>
        </div>

    </div>
</div>

<style>
.smc-404-page {
    background-color: var(--smc-bg-body);
    background-image: radial-gradient(circle at 20% 20%, rgba(14, 118, 115, 0.05) 0%, transparent 60%),
                      radial-gradient(circle at 80% 80%, rgba(161, 35, 42, 0.05) 0%, transparent 60%);
    min-height: calc(100vh - 150px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    font-family: var(--smc-font-body);
    text-align: center;
}

.smc-404-content {
    max-width: 600px;
    margin: 0 auto;
}

.smc-404-content h1 {
    font-family: var(--smc-font-heading);
    font-size: clamp(40px, 6vw, 72px);
    font-weight: 900;
    color: var(--smc-text-main);
    line-height: 1.1;
    letter-spacing: -2px;
    margin-bottom: 30px;
}

.smc-404-content p {
    font-size: 20px;
    color: var(--smc-text-muted);
    line-height: 1.6;
    margin-bottom: 50px;
}

.smc-404-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 60px;
}

.smc-btn {
    padding: 18px 30px;
    border-radius: 100px;
    font-weight: 800;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    display: inline-block;
    font-size: 14px;
    font-family: var(--smc-font-heading);
}

.smc-btn-primary {
    background-color: var(--smc-red);
    color: #fff;
    box-shadow: 0 10px 30px rgba(161, 35, 42, 0.25);
}

.smc-btn-primary:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(161, 35, 42, 0.35);
}

.smc-btn-secondary {
    background-color: transparent;
    border: 2px solid rgba(14, 118, 115, 0.2);
    color: var(--smc-teal);
}

.smc-btn-secondary:hover {
    border-color: var(--smc-teal);
    background-color: rgba(14, 118, 115, 0.05);
}

.smc-404-search {
    border-top: 1px solid rgba(0,0,0,0.05);
    padding-top: 40px;
    margin-top: 40px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.search-label {
    font-size: 14px !important;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px !important;
    opacity: 0.6;
}

/* Custom Search Form Style Override */
.smc-404-search form {
    position: relative;
}

.smc-404-search input[type="search"] {
    width: 100%;
    padding: 15px 20px;
    border-radius: 50px;
    border: 1px solid rgba(0,0,0,0.1);
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
}

.smc-404-search button[type="submit"] {
    display: none; /* Hide default submit */
}

@media (max-width: 768px) {
    .smc-404-actions {
        flex-direction: column;
    }
}
</style>

<script>
    // Simple GSAP Animation if available
    if (typeof gsap !== 'undefined') {
        gsap.from(".smc-badge", { y: -20, opacity: 0, duration: 1, ease: "power3.out" });
        gsap.from("h1", { y: 30, opacity: 0, duration: 1, delay: 0.2, ease: "power3.out" });
        gsap.from("p:not(.search-label)", { y: 20, opacity: 0, duration: 1, delay: 0.4, ease: "power3.out" });
        gsap.from(".smc-btn", { y: 20, opacity: 0, duration: 1, delay: 0.6, stagger: 0.2, ease: "power3.out" });
    }
</script>

<?php
get_footer();
