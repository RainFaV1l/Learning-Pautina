import './bootstrap';

import Alpine from "alpinejs";
import focus from '@alpinejs/focus'

import '../js/index';
import '../js/slider';

import * as Turbo from "@hotwired/turbo"
Turbo.start()

Alpine.plugin(focus)
window.Alpine = Alpine

document.addEventListener('turbo:before-cache', () => {
    Turbo.cache.clear();
});

document.addEventListener("livewire:load", function() {
    Livewire.onPageExpired((response, message) => {})
    window.livewire.on('redirect', url => Turbo.visit(url))
});

document.addEventListener("turbo:load", function() {
    window.livewire.start()
    if(!window.location.pathname.includes('/profile')){
        document.addEventListener("livewire:load", function() {
            try {
                window.Alpine.start()
            } catch (e) {

            }
        });
    }
});

// Перенаправление $this->emit('redirect', '/');
