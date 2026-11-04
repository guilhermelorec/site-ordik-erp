import { createApp } from 'vue';

// Monta cada componente Vue só se o elemento existir na página.
// Props vêm do atributo data-props (JSON) do elemento.
const components = {};

for (const [selector, load] of Object.entries(components)) {
    const el = document.querySelector(selector);
    if (!el) continue;
    load().then(({ default: component }) => {
        createApp(component, JSON.parse(el.dataset.props || '{}')).mount(el);
    });
}
