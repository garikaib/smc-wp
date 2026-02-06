document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Create the Toggle Button
    const toggleBtn = document.createElement('button');
    toggleBtn.id = 'smc-theme-toggle';
    toggleBtn.setAttribute('aria-label', 'Toggle Dark Mode');
    toggleBtn.innerHTML = `
        <span class="icon-sun">☀️</span>
        <span class="icon-moon">🌙</span>
    `;
    
    // 2. Append to body
    document.body.appendChild(toggleBtn);
    
    // Style the button dynamically (or rely on style.css if you prefer to decouple)
    // We already added styles in style.css but let's ensure z-index and positioning is safe here too if needed,
    // though style.css is better.
    // Let's add the basic style class to it.
    toggleBtn.className = 'smc-theme-toggle-btn';

    // 3. Logic
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('smc-theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    function setTheme(theme) {
        if (theme === 'dark') {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('smc-theme', 'dark');
        } else {
            html.removeAttribute('data-theme');
            localStorage.setItem('smc-theme', 'light');
        }
    }
    
    // Initialize
    if (savedTheme) {
        setTheme(savedTheme);
    } else if (systemPrefersDark) {
        setTheme('dark');
    }
    
    // Click Handler
    toggleBtn.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            setTheme('light');
        } else {
            setTheme('dark');
        }
    });
    
    // Listen for System Changes (optional, only if user hasn't manually overridden?)
    // Usually, if user manually sets it, we respect that over system changes.
    // If no manual setting, we listen.
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (!localStorage.getItem('smc-theme')) {
            setTheme(event.matches ? 'dark' : 'light');
        }
    });
});
