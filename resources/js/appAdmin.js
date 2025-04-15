import './bootstrap';


import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'

window.Alpine = Alpine
Alpine.plugin(collapse)
Alpine.start()
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('w-64');
        sidebar.classList.toggle('w-16');
        document.querySelectorAll('.md\\:block.sm\\:hidden').forEach(el => {
            el.classList.toggle('hidden');
        });
    });
});