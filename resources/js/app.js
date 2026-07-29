import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        dark: localStorage.getItem('crm-dark') === 'true',
        init() { this.apply(); },
        toggle() { this.dark = !this.dark; this.apply(); },
        apply() {
            document.documentElement.classList.toggle('dark', this.dark);
            localStorage.setItem('crm-dark', this.dark);
        }
    });

    Alpine.store('detailModal', {
        open: false,
        loading: false,
        content: '',
        title: '',
        async openUrl(url) {
            this.loading = true;
            this.open = true;
            this.content = '';
            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await response.json();
                this.title = data.title || '';
                this.content = data.html || '';
            } catch (e) {
                this.content = '<div class="p-8 text-center text-rose-600">Erreur lors du chargement.</div>';
            } finally {
                this.loading = false;
            }
        },
        close() {
            this.open = false;
            this.content = '';
            this.title = '';
            this.loading = false;
        }
    });
});

Alpine.start();
