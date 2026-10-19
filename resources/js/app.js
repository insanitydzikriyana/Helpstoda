//
const togglePassword = document.querySelector('#toggle-password');

togglePassword?.addEventListener('click', () => {
    const password = document.querySelector('#password');
    const showingPassword = password.type === 'password';

    password.type = showingPassword ? 'text' : 'password';
    togglePassword.setAttribute('aria-label', showingPassword ? 'Sembunyikan password' : 'Tampilkan password');
});

const menuToggle = document.querySelector('#menu-toggle');

menuToggle?.addEventListener('click', () => {
    document.querySelector('#sidebar')?.classList.toggle('open');
});

document.addEventListener('click', (event) => {
    const sidebar = document.querySelector('#sidebar');

    if (sidebar?.classList.contains('open') && !sidebar.contains(event.target) && !menuToggle?.contains(event.target)) {
        sidebar.classList.remove('open');
    }
});
