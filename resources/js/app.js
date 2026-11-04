// Demo do hero: o estado "confirmado" é todo em CSS, a partir de data-done.
const demo = document.querySelector('[data-demo]');

if (demo) {
    const status = demo.querySelector('[data-demo-live]');

    demo.querySelector('[data-demo-confirm]').addEventListener('click', () => {
        demo.toggleAttribute('data-done', true);
        status.textContent = 'Venda confirmada. Estoque baixado e conta a receber criada.';
    });

    demo.querySelector('[data-demo-reset]').addEventListener('click', () => {
        demo.toggleAttribute('data-done', false);
        status.textContent = '';
    });
}

// Abas com <details name>: a aba aberta não fecha ao clicar de novo, para a tela não sumir.
document.querySelectorAll('[data-pillars] summary').forEach((summary) => {
    summary.addEventListener('click', (event) => {
        if (summary.parentElement.open) {
            event.preventDefault();
        }
    });
});
