import { API } from "./api.js";

class Tab {
    tabHeader;//Tab header class

    view;//html content element
    viewParent;//html contetnt parent
    
    tabId;// tab Id

    constructor({ contentParent, tabHeader, tabData, tabId }) {
        this.tabHeader = tabHeader;
        this.viewParent = contentParent;
        this.tabId = tabId;

        if (!tabData) {
            const tempThis = this;

            const $view = $('<loader-element>').attr('page', 'connect').addClass('hide');
            $view.on('load', function () {
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
            });
            $(contentParent).append($view);
        }
        else {
            //TODO
        }
    }


    _startTab() {
        //TODO
    }

    connect() {
        //TODO
    }

    hide() {
        $(this.view).addClass('hide');
    }

    show() {
        $(this.view).removeClass('hide');
    }

    remove(){
        this.view.remove();
        this.tabHeader=null;
    }    
}

export default Tab;