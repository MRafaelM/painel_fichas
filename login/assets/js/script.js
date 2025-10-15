// script.js

document.addEventListener('DOMContentLoaded', () => {
  const toggleSenha = document.getElementById('toggleSenha');
  const senha = document.getElementById('senha');

  toggleSenha.addEventListener('click', () => {
    const tipo = senha.getAttribute('type') === 'password' ? 'text' : 'password';
    senha.setAttribute('type', tipo);

    // Alterna ícone e estilo ativo
    toggleSenha.innerHTML =
      tipo === 'password'
        ? '<i class="bi bi-eye-slash"></i>'
        : '<i class="bi bi-eye"></i>';
    toggleSenha.classList.toggle('active', tipo === 'text');
  });
});

// Captura IP do usuário
fetch('https://api.ipify.org?format=json')
    .then(res => res.json())
    .then(data => {
        document.getElementById('ip').value = data.ip;
    })
    .catch(console.log);