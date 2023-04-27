class ComponentLoader extends HTMLElement {
    constructor() {
        super();
    }

    async loadComponent(file) {
        
        const response = await fetch(`/components/${file}.html`);
        const html = await response.text();
        this.innerHTML = html;

        const scripts = this.querySelectorAll('script');
        for (let i = 0; i < scripts.length; i++) {
            const script = scripts[i];
            const newScript = document.createElement('script');
            if (script.hasAttribute('type')) {
                newScript.type = script.type;
            }
            if (script.hasAttribute('src')) {
                newScript.src = script.src;
            } else {
                newScript.innerHTML = script.innerHTML;
            }
            document.head.appendChild(newScript);
        }
        
        this.dispatchEvent(new Event('load'));
    }

    connectedCallback() {
        const file = this.getAttribute('page');
        this.loadComponent(file);
    }

    // disconnectedCallback() {
    //     // браузер вызывает этот метод при удалении элемента из документа
    //     // (может вызываться много раз, если элемент многократно добавляется/удаляется)
    // }

    // static get observedAttributes() {
    //     return [/* массив имён атрибутов для отслеживания их изменений */];
    // }

    // attributeChangedCallback(name, oldValue, newValue) {
    //     // вызывается при изменении одного из перечисленных выше атрибутов
    // }
}

customElements.define("loader-element", ComponentLoader);