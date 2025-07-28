<div>
    <div class="flex items-center">
        <input 
            type="checkbox" 
            class="toggle toggle-primary" 
            wire:model.live="darkMode"
            wire:click="toggleDarkMode"
            id="darkModeToggle"
        />
        <label for="darkModeToggle" class="ml-2 text-sm cursor-pointer">
            @if($darkMode)
                🌙 Dark Mode
            @else
                ☀️ Light Mode
            @endif
        </label>
    </div>
</div>

<script>
    // Handle theme change
    window.addEventListener('theme-changed', function(event) {
        const theme = event.detail.theme;
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        
        // Toggle dark class for Tailwind dark mode
        if (theme === 'sampahgo_dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });

    // Load theme from localStorage on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'sampahgo_light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        
        if (savedTheme === 'sampahgo_dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });
</script>
