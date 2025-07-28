<?php

namespace App\Livewire;

use Livewire\Component;

class DarkModeToggle extends Component
{
    public $darkMode = false;

    public function mount()
    {
        // Check localStorage or default to light mode
        $this->darkMode = false;
    }

    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        
        // Dispatch browser event to toggle theme
        $this->dispatch('theme-changed', theme: $this->darkMode ? 'sampahgo_dark' : 'sampahgo_light');
    }

    public function render()
    {
        return view('livewire.dark-mode-toggle');
    }
}
