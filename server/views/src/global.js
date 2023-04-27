import SuperStorage from './storage.js';
import Tab from './tab.js';
import HeaderManager from './HeaderManager.js';

class TabManager {
    tabs = [];
    activeTab = null;
    headerManager = null;

    tabViewElement = null;//html element, tab content parent

    constructor() {
        this.headerManager = new HeaderManager(this.closeTab, this.newTab, this.setActiveTab);
        this.tabViewElement = $("#tabView");
        

        const tabsData = SuperStorage.getCurrentSessions();
        if (tabsData.length === 0) {
            this.newTab();
        }
        else{
            //TODO
        }
    }



    _setActiveTab(tabId){
        if(this.activeTab){
            this.activeTab.hide();
        }

        for(let i=0;i<this.tabs.length;i++){
            if(this.tabs[i].tabId===tabId){
                this.activeTab = this.tabs[i];
                this.tabs[i].show();
            }
        }
    }

    _newTab(data) {
        const tabId = Math.random().toString(36);
        const tabHeader = this.headerManager.addTab(tabId);
        const tab = new Tab({ contentParent: this.tabViewElement, tabHeader: tabHeader, tabId: tabId });
        this.tabs.push(tab);
        this.setActiveTab(tabId);
    }

    _closeTab(tabId) {
        for(let i=0;i<this.tabs.length;i++){
            if(this.tabs[i].tabId===tabId){
                this.headerManager.removeTab(tabId);
                this.tabs[i].remove();
                this.tabs.splice(i, 1);
                break;
                //TODO superstorage remove
            }
        }
    }

    get setActiveTab(){
        return this._setActiveTab.bind(this);
    }

    get closeTab() {
        return this._closeTab.bind(this);
    }

    get newTab() {
        return this._newTab.bind(this);
    }
}

const tabManager = new TabManager();
