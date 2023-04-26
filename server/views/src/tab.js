import {API} from "./api.js";

class Tab {
    view;
    viewParent;
    tabHeader;
    closeCallback;
    tabId;

    constructor({contentParent, tabHeader, tabData, closeCallback, tabId}) {
        this.tabHeader = tabHeader;
        this.viewParent = contentParent;
        this.closeCallback = closeCallback;
        this.tabId = tabId;

        if (!tabData) {
            const tempThis = this;
            console.log(ComponentLoader);
            $(tabHeader).load("/components/tabHeader.html", function(){
                tempThis.tabHeader = this;
                $(this).find('.tabClose').on('click', tempThis.close);
                $(this).find('.headerTitle').text("tab");
            });


            $(contentParent).load("/components/connect.html", function () {
                console.log("NNNN")
                tempThis.view = this;
                const form = $(this).find("form")[0];

                if (!form) {
                    throw new Error("Form not loaded");
                }

                $(form).on("submit", function (e) {
                    e.preventDefault();
                    const formData = new FormData(e.target);

                    if (formData.get("KeyType") === "password") {
                        formData.delete("key_password");
                        formData.delete("KeyType");
                        formData.append("key", formData.get("text_key"));
                        formData.delete("text_key");
                    }
                    else {
                        formData.delete("KeyType");
                        console.log(formData.get("key"));
                        if (!formData.get("key_password")) {
                            formData.delete("key_password");
                        }
                    }
                    API.connect(formData).then(tempThis.startTab);
                });

                console.log(form);
            });
        }
        else{
            //TODO
        }
    }


    _setTabTitle(text){
        $(this.tabHeader).find('.headerTitle').text(text);
    }

    get startTab(){
        return this._startTab.bind(this);
    }
    _startTab(){
        this.view.remove();
        this.view = null;
        //TODO
    }

    connect() {
        //TODO
    }
    hide() {
        //TODO
    }


    get close(){
        return this._close.bind(this);
    }
    _close() {
        this.view.remove();
        this.tabHeader.remove();
        this.closeCallback();
    }

    show() {
        //TODO
    }
}

export default Tab;