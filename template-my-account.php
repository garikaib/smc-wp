<?php
/**
 * Template Name: My Account
 * 
 * @package smc
 */

// Handle Logout
if ( isset( $_GET['action'] ) && $_GET['action'] === 'logout' ) {
    wp_logout();
    wp_redirect( home_url( '/my-account/' ) );
    exit;
}

    // Enqueue Turnstile API
    wp_enqueue_script( 'turnstile-api', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), null, true );
    
    // Enqueue GSAP
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), null, true );
    
    get_header(); 

$is_logged_in = is_user_logged_in();
$current_user = wp_get_current_user();
?>

<div class="smc-my-account-page">
    <div class="smc-container">
        
            <?php if ( ! is_user_logged_in() ) : ?>
                <!-- Boutique Hero Section -->
                <div class="smc-hero-cta" id="account-hero">
                    <span class="smc-badge">SMC EXCLUSIVE</span>
                    <h1>World-Class Business Science</h1>
                    <p>Unlock tailormade insights, track your assessments, and access premium African context coaching tools by signing in to your SMC account.</p>
                </div>

                <div class="smc-auth-card" id="auth-card">
                    <div class="smc-auth-tabs">
                        <button class="smc-tab-btn active" data-tab="signin">SIGN IN</button>
                        <button class="smc-tab-btn" data-tab="register">REGISTER</button>
                    </div>

                    <div class="smc-auth-content">
                        <!-- Sign In Tab -->
                        <div id="signin" class="smc-tab-content active">
                            <h2 class="smc-auth-title">Welcome Back</h2>
                            <p class="smc-auth-subtitle">Sign in to your premium SMC workspace.</p>
                            
                            <form id="smc-login-form" class="smc-auth-form">
                                <!-- Standard Login (Default) -->
                                <div id="standard-login-fields">
                                    <div class="smc-form-group">
                                        <label for="login-user">USERNAME OR EMAIL</label>
                                        <div class="input-wrapper">
                                            <i data-lucide="user"></i>
                                            <input type="text" id="login-user" name="log" class="form-control" placeholder="garikaib / john@example.com" required>
                                        </div>
                                    </div>
                                    
                                    <div class="smc-form-group">
                                        <label for="login-password">PASSWORD</label>
                                        <div class="input-wrapper">
                                            <i data-lucide="lock"></i>
                                            <input type="password" id="login-password" name="pwd" class="form-control" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" id="btn-password-login" class="smc-btn smc-btn-primary">Sign In</button>
                                    
                                    <div class="smc-alternative-login">
                                        <button type="button" id="toggle-magic-login" class="smc-link-btn">Use Magic Link Instead</button>
                                    </div>
                                </div>

                                <!-- Magic Login (Hidden by Default) -->
                                <div id="magic-login-fields" style="display: none;">
                                    <div class="smc-form-group">
                                        <label for="magic-email">EMAIL ADDRESS</label>
                                        <div class="input-wrapper">
                                            <i data-lucide="mail"></i>
                                            <input type="email" id="magic-email" name="email" class="form-control" placeholder="john@example.com">
                                        </div>
                                    </div>
                                    
                                    <button type="submit" id="btn-magic-login" class="smc-btn smc-btn-primary">Send Magic Link</button>
                                    
                                    <div class="smc-alternative-login">
                                        <button type="button" id="toggle-standard-login" class="smc-link-btn">Back to Password Login</button>
                                    </div>
                                </div>

                                <div class="smc-turnstile-container">
                                    <div class="cf-turnstile" data-sitekey="<?php echo SMC_TURNSTILE_SITEKEY; ?>" data-theme="light"></div>
                                </div>

                                <div id="login-message" class="smc-message"></div>
                            </form>
                        </div>

                        <!-- Register Tab -->
                        <div id="register" class="smc-tab-content">
                            <h2 class="smc-auth-title">Partner with SMC</h2>
                            <p class="smc-auth-subtitle">Create your exclusive account to track and scale your growth.</p>
                            
                            <form id="smc-register-form" class="smc-auth-form">
                                <div class="smc-form-group">
                                    <label for="reg-username">USERNAME</label>
                                    <div class="input-wrapper">
                                        <i data-lucide="user"></i>
                                        <input type="text" id="reg-username" name="username" class="form-control" placeholder="Choose a username" required>
                                    </div>
                                </div>
                                <div class="smc-form-group">
                                    <label for="reg-email">EMAIL ADDRESS</label>
                                    <div class="input-wrapper">
                                        <i data-lucide="mail"></i>
                                        <input type="email" id="reg-email" name="email" class="form-control" placeholder="john@example.com" required>
                                    </div>
                                </div>
                                <div class="smc-form-group">
                                    <label for="reg-password">SET PASSWORD</label>
                                    <div class="input-wrapper">
                                        <i data-lucide="lock"></i>
                                        <input type="password" id="reg-password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="smc-turnstile-container">
                                    <div id="smc-turnstile-widget"></div>
                                </div>

                                <button type="submit" class="smc-btn smc-btn-primary">Create Account</button>
                                <div id="register-message" class="smc-message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <!-- Logged In Dashboard -->
                <div class="smc-dashboard-card" id="dashboard-card">
                    <div id="dashboard-overview">
                        <div class="smc-dashboard-header">
                            <div class="smc-user-avatar">
                                <?php echo get_avatar( $current_user->ID, 120 ); ?>
                            </div>
                            <div class="smc-user-info">
                                <h1>Hello, <?php echo esc_html( $current_user->display_name ); ?>!</h1>
                                <p>Welcome to your boutique SMC workspace.</p>
                            </div>
                        </div>

                        <div class="smc-dashboard-grid">
                            <div class="smc-d-card">
                                <i data-lucide="file-text"></i>
                                <h3>Assessments</h3>
                                <p>Explore your business science journey.</p>
                                <a href="<?php echo home_url('/free-assessment/'); ?>" class="smc-link-btn">View Results</a>
                            </div>
                            <div class="smc-d-card">
                                <i data-lucide="settings"></i>
                                <h3>Profile Settings</h3>
                                <p>Tailor your experience and data.</p>
                                <button id="btn-edit-profile" class="smc-link-btn" style="background: none; border: none; padding: 0; cursor: pointer; text-transform: uppercase;">Edit Identity</button>
                            </div>
                            <div class="smc-d-card">
                                <i data-lucide="log-out"></i>
                                <h3>Logout</h3>
                                <p>Safely leave your workspace.</p>
                                <a href="?action=logout" class="smc-link-btn">Sign Out</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile SPA Root -->
                    <div id="profile-edit-view" style="display: none;">
                        <div class="smc-view-actions" style="margin-bottom: 30px;">
                            <button id="btn-back-to-dashboard" class="smc-link-btn" style="background: none; border: none; padding: 0; cursor: pointer;">
                                <i data-lucide="arrow-left" style="display: inline; vertical-align: middle; margin-right: 8px;"></i>
                                <span>Back to Workspace</span>
                            </button>
                        </div>
                        <div id="smc-profile-spa-root"></div>
                    </div>
                </div>
            <?php endif; ?>
    </div>
</div>

<style>
.smc-my-account-page {
    background-color: var(--smc-bg-body);
    background-image: radial-gradient(circle at 0% 0%, rgba(14, 118, 115, 0.05) 0%, transparent 50%),
                      radial-gradient(circle at 100% 100%, rgba(161, 35, 42, 0.05) 0%, transparent 50%);
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    font-family: var(--smc-font-body);
    position: relative;
    overflow: hidden;
}

.smc-container {
    width: 100%;
    max-width: 650px;
    position: relative;
    z-index: 10;
}

/* Auth Card Glassmorphism */
.smc-auth-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border-radius: 40px;
    overflow: hidden;
    box-shadow: 0 40px 100px rgba(0,0,0,0.15);
    border: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
}

[data-theme="light"] .smc-auth-card {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

/* Hero CTA Boutique Typography */
.smc-hero-cta {
    text-align: center;
    margin-bottom: 50px;
}

.smc-badge {
    background: rgba(14, 118, 115, 0.1);
    color: var(--smc-teal);
    padding: 8px 18px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 3px;
    display: inline-block;
    margin-bottom: 25px;
    border: 1px solid rgba(14, 118, 115, 0.2);
}

.smc-hero-cta h1 {
    font-family: var(--smc-font-heading);
    font-size: clamp(40px, 5vw, 64px);
    font-weight: 900;
    color: var(--smc-text-main);
    line-height: 1;
    letter-spacing: -3px;
    margin-bottom: 25px;
}

.smc-hero-cta p {
    font-size: 19px;
    color: var(--smc-text-muted);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Tabs Boutique Design */
.smc-auth-tabs {
    display: flex;
    background: rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.smc-tab-btn {
    flex: 1;
    padding: 25px;
    border: none;
    background: transparent;
    color: var(--smc-text-muted);
    font-weight: 800;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    font-family: var(--smc-font-heading);
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 2px;
    position: relative;
}

.smc-tab-content {
    display: none;
}

.smc-tab-content.active {
    display: block;
}

.smc-tab-btn::after {
    content: '';
    position: absolute;
    bottom: 0; left: 50%; width: 0; height: 3px;
    background: var(--smc-teal);
    transition: all 0.4s;
    transform: translateX(-50%);
}

.smc-tab-btn.active {
    color: var(--smc-teal);
    background: rgba(14, 118, 115, 0.05);
}

.smc-tab-btn.active::after {
    width: 60%;
}

.smc-auth-content {
    padding: 60px 50px;
}

.smc-auth-title {
    font-family: var(--smc-font-heading);
    font-size: 36px;
    font-weight: 800;
    color: var(--smc-text-main);
    margin-bottom: 15px;
    text-align: center;
    letter-spacing: -1.5px;
}

.smc-auth-subtitle {
    color: var(--smc-text-muted);
    text-align: center;
    margin-bottom: 40px;
    font-size: 16px;
    font-weight: 500;
}

/* Premium Form Elements */
.smc-form-group {
    margin-bottom: 30px;
}

.smc-auth-form label {
    display: block;
    color: var(--smc-text-main);
    font-size: 11px;
    font-weight: 800;
    margin-bottom: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.6;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 20px;
    width: 18px;
    height: 18px;
    color: var(--smc-teal);
    opacity: 0.7;
    pointer-events: none;
    transition: all 0.3s;
}

.form-control {
    width: 100%;
    background: rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.05);
    color: var(--smc-text-main);
    padding: 18px 20px 18px 52px; /* Extra left padding for icon */
    border-radius: 16px;
    font-family: inherit;
    font-size: 15px;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

[data-theme="light"] .form-control {
    background: rgba(0, 0, 0, 0.03);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.form-control:focus {
    outline: none;
    border-color: var(--smc-teal);
    background: rgba(14, 118, 115, 0.03);
    box-shadow: 0 0 0 4px rgba(14, 118, 115, 0.12);
}

.form-control:focus + i {
    opacity: 1;
    color: var(--smc-red);
}

.smc-alternative-login {
    margin-top: 20px;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding-top: 20px;
}

.smc-btn {
    width: 100%;
    padding: 20px;
    border: none;
    border-radius: 16px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    margin-top: 15px;
    font-family: var(--smc-font-heading);
    font-size: 15px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.smc-btn-primary {
    background: linear-gradient(135deg, var(--smc-red), #e12d36);
    color: #fff;
    box-shadow: 0 15px 30px rgba(161, 35, 42, 0.2);
}

.smc-btn-primary:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(161, 35, 42, 0.3);
}

/* Dashboard Refined */
.smc-container:has(.smc-dashboard-card) {
    max-width: 1000px;
}

.smc-dashboard-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border-radius: 40px;
    padding: 60px;
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.smc-dashboard-header {
    display: flex;
    align-items: center;
    gap: 35px;
    margin-bottom: 60px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding-bottom: 40px;
}

.smc-user-avatar img {
    border-radius: 20px;
    border: 4px solid var(--smc-teal);
    box-shadow: 0 10px 30px rgba(14, 118, 115, 0.2);
}

.smc-user-info h1 {
    font-family: var(--smc-font-heading);
    font-size: 42px;
    font-weight: 900;
    letter-spacing: -2px;
    color: var(--smc-text-main);
}

.smc-dashboard-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.smc-d-card {
    background: rgba(255, 255, 255, 0.02);
    padding: 45px 30px;
    border-radius: 24px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

.smc-d-card:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-12px);
    border-color: var(--smc-teal);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.smc-d-card i {
    font-size: 44px;
    color: var(--smc-teal);
    margin-bottom: 30px;
    display: block;
}

.smc-d-card h3 {
    font-family: var(--smc-font-heading);
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 15px;
    color: var(--smc-text-main);
}

.smc-d-card p {
    font-size: 15px;
    color: var(--smc-text-muted);
}

@media (max-width: 900px) {
    .smc-dashboard-grid {
        grid-template-columns: 1fr;
    }
    .smc-auth-content {
        padding: 40px 30px;
    }
}
</style>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onloadTurnstileCallback" async defer></script>

<script>
window.onloadTurnstileCallback = function () {
    if (document.getElementById('smc-turnstile-widget')) {
        turnstile.render('#smc-turnstile-widget', {
            sitekey: '<?php echo SMC_TURNSTILE_SITEKEY; ?>',
            callback: function(token) {
                console.log('Challenge Success');
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Tab Switching
    const tabs = document.querySelectorAll('.smc-tab-btn');
    const contents = document.querySelectorAll('.smc-tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;
            
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            
            tab.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

    // Login Form State Toggle
    const standardFields = document.getElementById('standard-login-fields');
    const magicFields = document.getElementById('magic-login-fields');
    const toggleToMagic = document.getElementById('toggle-magic-login');
    const toggleToStandard = document.getElementById('toggle-standard-login');

    if (toggleToMagic) {
        toggleToMagic.addEventListener('click', () => {
            gsap.to(standardFields, { opacity: 0, y: 10, duration: 0.3, onComplete: () => {
                standardFields.style.display = 'none';
                magicFields.style.display = 'block';
                gsap.fromTo(magicFields, { opacity: 0, y: 10 }, { opacity: 1, y: 0, duration: 0.3 });
                document.getElementById('login-password').required = false;
                document.getElementById('login-user').required = false;
                document.getElementById('magic-email').required = true;
            }});
        });
    }

    if (toggleToStandard) {
        toggleToStandard.addEventListener('click', () => {
            gsap.to(magicFields, { opacity: 0, y: 10, duration: 0.3, onComplete: () => {
                magicFields.style.display = 'none';
                standardFields.style.display = 'block';
                gsap.fromTo(standardFields, { opacity: 0, y: 10 }, { opacity: 1, y: 0, duration: 0.3 });
                document.getElementById('login-password').required = true;
                document.getElementById('login-user').required = true;
                document.getElementById('magic-email').required = false;
            }});
        });
    }

    // Login Form Submission
    const loginForm = document.getElementById('smc-login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const messageDiv = document.getElementById('login-message');
            const isMagic = magicFields.style.display === 'block';
            const submitBtn = isMagic ? document.getElementById('btn-magic-login') : document.getElementById('btn-password-login');
            const action = isMagic ? 'smc_magic_login' : 'smc_password_login';

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Processing...';

            const formData = new FormData(this);
            formData.append('action', action);
            formData.append('nonce', '<?php echo wp_create_nonce("smc_auth_nonce"); ?>');

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = data.data.message;
                    messageDiv.className = 'smc-message success';
                    if (data.data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.data.redirect;
                        }, 1000);
                    }
                } else {
                    messageDiv.textContent = data.data.message;
                    messageDiv.className = 'smc-message error';
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                    
                    if (typeof turnstile !== 'undefined') {
                        turnstile.reset();
                    }
                }
            })
            .catch(err => {
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.className = 'smc-message error';
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    }

    // Register Form
    const registerForm = document.getElementById('smc-register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const messageDiv = document.getElementById('register-message');
            const submitBtn = this.querySelector('button');
            const turnstileResponse = turnstile.getResponse();

            if (!turnstileResponse) {
                messageDiv.textContent = 'Please complete the security verification.';
                messageDiv.className = 'smc-message error';
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating Account...';

            const formData = new FormData(this);
            formData.append('action', 'smc_register');
            formData.append('turnstile_response', turnstileResponse);
            formData.append('nonce', '<?php echo wp_create_nonce("smc_auth_nonce"); ?>');

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = data.data.message;
                    messageDiv.className = 'smc-message success';
                    setTimeout(() => {
                        window.location.href = data.data.redirect;
                    }, 1500);
                } else {
                    messageDiv.textContent = data.data.message;
                    messageDiv.className = 'smc-message error';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Create Account';
                    turnstile.reset();
                }
            })
            .catch(err => {
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.className = 'smc-message error';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create Account';
                turnstile.reset();
            });
        });
    }
    // GSAP Animations
    if (typeof gsap !== 'undefined') {
        const tl = gsap.timeline({ defaults: { ease: "power4.out", duration: 1.2 }});

        tl.from("#account-hero", { y: 30, opacity: 0, delay: 0.2 })
          .from("#auth-card, #dashboard-card", { y: 50, opacity: 0, scale: 0.98 }, "-=0.8");

        // Profile SPA Toggle Logic
        const btnEditProfile = document.getElementById('btn-edit-profile');
        const btnBackToDashboard = document.getElementById('btn-back-to-dashboard');
        const dashboardOverview = document.getElementById('dashboard-overview');
        const profileEditView = document.getElementById('profile-edit-view');

        if (btnEditProfile) {
            btnEditProfile.addEventListener('click', () => {
                gsap.to(dashboardOverview, { opacity: 0, y: 30, duration: 0.4, onComplete: () => {
                    dashboardOverview.style.display = 'none';
                    profileEditView.style.display = 'block';
                    gsap.fromTo(profileEditView, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.4 });
                }});
            });
        }

        if (btnBackToDashboard) {
            btnBackToDashboard.addEventListener('click', () => {
                gsap.to(profileEditView, { opacity: 0, y: 30, duration: 0.4, onComplete: () => {
                    profileEditView.style.display = 'none';
                    dashboardOverview.style.display = 'block';
                    gsap.fromTo(dashboardOverview, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.4 });
                }});
            });
        }

        // Subtle hover effects
        const cards = document.querySelectorAll('.smc-auth-card, .smc-dashboard-card, .smc-d-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, { y: -8, duration: 0.4, ease: "power2.out" });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(card, { y: 0, duration: 0.4, ease: "power2.out" });
            });
        });
    }
});
</script>

<?php get_footer(); ?>
