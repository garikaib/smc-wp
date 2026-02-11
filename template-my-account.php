<?php
/**
 * Template Name: My Account
 * 
 * This is the React Hub for the My Account experience.
 * Shows a login/register form when not authenticated.
 */

get_header();

if ( is_user_logged_in() ) : ?>

<div id="smc-account-root">
    <!-- React will mount here -->
    <div class="smc-my-account-page">
        <div class="smc-container">
            <div class="smc-dashboard-card" style="padding: 100px; text-align: center;">
                <div class="card-loading">Initializing Secure Dashboard...</div>
            </div>
        </div>
    </div>
</div>

<?php else : ?>

<style>
    .smc-auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 20px;
        font-family: 'Inter', sans-serif;
        background-color: #f5f7fa;
        background-image:
            radial-gradient(circle at 10% 10%, rgba(14, 118, 115, 0.04) 0%, transparent 40%),
            radial-gradient(circle at 90% 90%, rgba(161, 35, 42, 0.04) 0%, transparent 40%);
    }
    [data-theme="dark"] .smc-auth-page {
        background-color: #0f0f12;
        background-image:
            radial-gradient(circle at 10% 10%, rgba(14, 118, 115, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 90% 90%, rgba(161, 35, 42, 0.1) 0%, transparent 40%);
    }
    .smc-auth-container {
        width: 100%;
        max-width: 480px;
    }
    .smc-auth-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.06);
    }
    [data-theme="dark"] .smc-auth-card {
        background: rgba(20,20,25,0.8);
        border-color: rgba(255,255,255,0.08);
        box-shadow: 0 40px 100px rgba(0,0,0,0.3);
        color: #fff;
    }
    .smc-auth-card h1 {
        font-family: 'Outfit', sans-serif;
        font-weight: 900;
        font-size: 28px;
        margin: 0 0 8px;
        letter-spacing: -0.02em;
    }
    .smc-auth-card .subtitle {
        font-size: 14px;
        color: #6b7280;
        margin: 0 0 30px;
    }
    [data-theme="dark"] .smc-auth-card .subtitle { color: rgba(255,255,255,0.5); }

    .smc-auth-tabs {
        display: flex;
        margin-bottom: 30px;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    [data-theme="dark"] .smc-auth-tabs { border-color: rgba(255,255,255,0.08); }
    .smc-auth-tab {
        flex: 1;
        padding: 14px 0;
        background: none;
        border: none;
        font-weight: 700;
        font-size: 13px;
        color: #9ca3af;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.2s;
    }
    .smc-auth-tab:hover { color: #374151; }
    [data-theme="dark"] .smc-auth-tab:hover { color: #fff; }
    .smc-auth-tab.active {
        color: #0E7673;
        border-bottom-color: #0E7673;
    }

    .smc-auth-form { display: none; }
    .smc-auth-form.active { display: block; }

    .smc-auth-field {
        margin-bottom: 18px;
    }
    .smc-auth-field label {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #6b7280;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    [data-theme="dark"] .smc-auth-field label { color: rgba(255,255,255,0.4); }
    .smc-auth-field input {
        width: 100%;
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        font-size: 15px;
        background: #f3f4f6;
        color: #1a1a2e;
        transition: 0.3s;
        box-sizing: border-box;
    }
    [data-theme="dark"] .smc-auth-field input {
        background: rgba(0,0,0,0.3);
        border-color: rgba(255,255,255,0.1);
        color: #fff;
    }
    .smc-auth-field input:focus {
        outline: none;
        border-color: #0E7673;
        background: rgba(14, 118, 115, 0.05);
    }

    .smc-auth-submit {
        width: 100%;
        padding: 16px;
        border-radius: 14px;
        border: none;
        background: #0E7673;
        color: #fff;
        font-weight: 800;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(14, 118, 115, 0.3);
    }
    .smc-auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 118, 115, 0.4);
    }
    .smc-auth-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .smc-auth-message {
        padding: 12px 18px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 15px;
        display: none;
    }
    .smc-auth-message.success {
        display: block;
        background: rgba(14, 118, 115, 0.1);
        color: #0E7673;
        border: 1px solid rgba(14, 118, 115, 0.2);
    }
    .smc-auth-message.error {
        display: block;
        background: rgba(161, 35, 42, 0.1);
        color: #a1232a;
        border: 1px solid rgba(161, 35, 42, 0.2);
    }

    .smc-auth-divider {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }
    .smc-auth-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: rgba(0,0,0,0.06);
    }
    [data-theme="dark"] .smc-auth-divider::before { background: rgba(255,255,255,0.08); }
    .smc-auth-divider span {
        background: rgba(255,255,255,0.95);
        padding: 0 15px;
        position: relative;
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    [data-theme="dark"] .smc-auth-divider span { background: rgba(20,20,25,0.8); }

    .cf-turnstile {
        margin: 15px 0;
        display: flex;
        justify-content: center;
    }
</style>

<div class="smc-auth-page">
    <div class="smc-auth-container">
        <div class="smc-auth-card">
            <h1>Welcome Back</h1>
            <p class="subtitle">Sign in to access your account dashboard.</p>

            <div class="smc-auth-tabs">
                <button class="smc-auth-tab active" data-tab="login">Sign In</button>
                <button class="smc-auth-tab" data-tab="magic">Magic Link</button>
                <button class="smc-auth-tab" data-tab="register">Register</button>
            </div>

            <!-- Password Login Form -->
            <form class="smc-auth-form active" id="smc-login-form" data-tab="login">
                <div class="smc-auth-field">
                    <label>Email or Username</label>
                    <input type="text" name="log" placeholder="you@example.com" required />
                </div>
                <div class="smc-auth-field">
                    <label>Password</label>
                    <input type="password" name="pwd" placeholder="••••••••" required />
                </div>
                <div class="cf-turnstile" data-sitekey="<?php echo esc_attr( SMC_TURNSTILE_SITEKEY ); ?>"></div>
                <button type="submit" class="smc-auth-submit">Sign In</button>
                <div class="smc-auth-message" id="login-message"></div>
            </form>

            <!-- Magic Link Form -->
            <form class="smc-auth-form" id="smc-magic-form" data-tab="magic">
                <div class="smc-auth-field">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="you@example.com" required />
                </div>
                <div class="cf-turnstile" data-sitekey="<?php echo esc_attr( SMC_TURNSTILE_SITEKEY ); ?>"></div>
                <button type="submit" class="smc-auth-submit">Send Magic Link</button>
                <div class="smc-auth-message" id="magic-message"></div>
            </form>

            <!-- Registration Form -->
            <form class="smc-auth-form" id="smc-register-form" data-tab="register">
                <div class="smc-auth-field">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Choose a username" required />
                </div>
                <div class="smc-auth-field">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="you@example.com" required />
                </div>
                <div class="smc-auth-field">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min 8 characters" required />
                </div>
                <div class="cf-turnstile" data-sitekey="<?php echo esc_attr( SMC_TURNSTILE_SITEKEY ); ?>"></div>
                <button type="submit" class="smc-auth-submit">Create Account</button>
                <div class="smc-auth-message" id="register-message"></div>
            </form>
        </div>
    </div>
</div>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
(function() {
    const nonce = '<?php echo wp_create_nonce( "smc_auth_nonce" ); ?>';
    const ajaxUrl = '<?php echo admin_url( "admin-ajax.php" ); ?>';

    // Tab switching
    document.querySelectorAll('.smc-auth-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.smc-auth-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.smc-auth-form').forEach(f => f.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.smc-auth-form[data-tab="' + this.dataset.tab + '"]').classList.add('active');
        });
    });

    function showMessage(elId, type, text) {
        const el = document.getElementById(elId);
        el.className = 'smc-auth-message ' + type;
        el.textContent = text;
    }

    // Password Login
    document.getElementById('smc-login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('.smc-auth-submit');
        btn.disabled = true;
        btn.textContent = 'Signing in...';

        const formData = new FormData(this);
        formData.append('action', 'smc_password_login');
        formData.append('nonce', nonce);

        fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showMessage('login-message', 'success', data.data.message);
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showMessage('login-message', 'error', data.data.message);
                    btn.disabled = false;
                    btn.textContent = 'Sign In';
                }
            })
            .catch(() => {
                showMessage('login-message', 'error', 'Connection error. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Sign In';
            });
    });

    // Magic Link
    document.getElementById('smc-magic-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('.smc-auth-submit');
        btn.disabled = true;
        btn.textContent = 'Sending...';

        const formData = new FormData(this);
        formData.append('action', 'smc_magic_login');
        formData.append('nonce', nonce);

        fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showMessage('magic-message', 'success', data.data.message);
                } else {
                    showMessage('magic-message', 'error', data.data.message);
                }
                btn.disabled = false;
                btn.textContent = 'Send Magic Link';
            })
            .catch(() => {
                showMessage('magic-message', 'error', 'Connection error. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Send Magic Link';
            });
    });

    // Registration
    document.getElementById('smc-register-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('.smc-auth-submit');
        btn.disabled = true;
        btn.textContent = 'Creating Account...';

        const formData = new FormData(this);
        formData.append('action', 'smc_register');
        formData.append('nonce', nonce);
        // Map turnstile response to expected key
        const tsResponse = this.querySelector('[name="cf-turnstile-response"]');
        if (tsResponse) {
            formData.append('turnstile_response', tsResponse.value);
        }

        fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showMessage('register-message', 'success', data.data.message);
                    if (data.data.redirect) {
                        setTimeout(() => window.location.href = data.data.redirect, 1000);
                    }
                } else {
                    showMessage('register-message', 'error', data.data.message);
                    btn.disabled = false;
                    btn.textContent = 'Create Account';
                }
            })
            .catch(() => {
                showMessage('register-message', 'error', 'Connection error. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Create Account';
            });
    });
})();
</script>

<?php endif; ?>

<?php get_footer(); ?>
