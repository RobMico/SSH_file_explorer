const __ALLTABS = 'tabs';


class superStorage {
    constructor() {
        let tabs = localStorage.getItem(__ALLTABS);
        if (!tabs) {
            localStorage.setItem(__ALLTABS, '[]');
        }
    }
    getCurrentSessions() {
        let tabs = JSON.parse(localStorage.getItem(__ALLTABS));
        const result = [];
        for (let el of tabs) {
            const item = JSON.parse(localStorage.getItem(el));
            item.tabId = el;

            result.push(item);
        }
        return result;
    }
    newSession(tab) {
        const tabId = Math.random().toString(36);
        let tabs = JSON.parse(localStorage.getItem(__ALLTABS));
        tabs.push(tabId);

        localStorage.setItem(__ALLTABS, JSON.stringify(tabs));
        localStorage.setItem(tabId, tab);

        return tabId;
    }
    removeSession(tabId) {
        let tabs = JSON.parse(localStorage.getItem(__ALLTABS));
        tabs = tabs.filter(e=>e!=tabId);
        localStorage.setItem(__ALLTABS, JSON.stringify(tabs));
        localStorage.removeItem(tabId);
    }
}

export default new superStorage();