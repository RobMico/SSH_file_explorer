import TabHeader from './TabHeader.js';

export default class HeaderManager {
    tabsHeaders = null;//html element, tabs parent

    tabs = [];
    onTabClose = null;
    onNewActive=null;
    constructor(onTabClose, onNewTab, onNewActive) {
        $('#newTabBtn').on('click', onNewTab);
        this.tabsHeaders = $("#openTabs");

        this.onNewActive = onNewActive;
        this.onTabClose = onTabClose;
    }

    addTab(tabId) {
        console.log("BBBB")
        const tab = new TabHeader(this.tabsHeaders, tabId, this.onTabClose, this.onNewActive);
        this.tabs.push(tab);
        return tab;
    }

    removeTab(tabId) {
        for(let i=0;i<this.tabs.length;i++){
            if(this.tabs[i].tabId===tabId){
                this.tabs[i].remove();
                this.tabs.splice(i, 1);
                break;
            }
        }
    }
}