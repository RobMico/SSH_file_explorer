export default class TabHeader {
    tab=null;
    tabId=null;
    constructor(parent, tabId, closeCallback, onClick) {
        this.tabId = tabId;
        const tempThis = this;
        this.tab = $('<loader-element>').attr('page', 'tabHeader');
        $(this.tab).on('load', function () {
            tempThis.tabHeader = this;
            $(this).find('.tabClose').on('click', ()=>{return closeCallback(tabId)});
            $(this).find('.headerTitle').on('click', ()=>{return onClick(tabId)});
        });
        $(parent).append($(this.tab));
    }


    setTitle(text){
        $(this.tab).find('.headerTitle').text(text);
    }

    remove(){
        this.tab.remove();
    }

}