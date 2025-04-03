// Protection XSS pour les entrées utilisateur
function sanitize(input) {
    const div = document.createElement('div');
    div.textContent = input;
    return div.innerHTML;
}

// Gestion CSRF pour AJAX
document.addEventListener('DOMContentLoaded', () => {
    // Ajoute le token CSRF à toutes les requêtes AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    }

    // Validation côté client
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            const inputs = form.querySelectorAll('input[required]');
            let valid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = 'red';
                    valid = false;
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs requis');
            }
        });
    });
});

// Protection contre l'ouverture dans iframe
if (window !== window.top) {
    window.top.location = window.location;
}