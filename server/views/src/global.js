import SuperStorage from './storage.js';
import Tab from './tab.js';

const Tabs = [];
let activeTab;

const _tabsHeaders = $("#openTabs");
const _tabView = $("#tabView");
function removeTab(tab) {
    console.log(tab);
}

{//load tabs
    const tabsData = SuperStorage.getCurrentSessions();

    if (tabsData.length === 0) {
        Tabs.push(new Tab({ contentParent: _tabView, tabHeader: _tabsHeaders, closeCallback: removeTab }));
    }
    else {
        for (let tab of tabsData) {
            Tabs.push(new Tab({ contentParent: _tabView, tabHeader: _tabsHeaders, closeCallback: removeTab }));
        }
    }

}

{//new tab
    function newTab() {
        console.log("HEEHEH")
        Tabs.push(new Tab({ contentParent: _tabView, tabHeader: _tabsHeaders, closeCallback: removeTab }));
    }
    $('#newTabBtn').on('click', newTab);
}