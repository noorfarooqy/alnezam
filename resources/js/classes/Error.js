var self;
export default class {
    constructor() {
        this.error_title = null;
        this.error_text = null;
        this.visible = false;
    }

    showErrorModal(error_text='null', error_title='Error!')
    {
        if(error_text.hasOwnProperty('error_message'))
            error_text = error_text.error_message + ' '+error_text.error_description;
        if(error_text.hasOwnProperty('response'))
            error_text = error_text.response;
        if(error_text.hasOwnProperty('data'))
            error_text = error_text.data;
        if(error_text.hasOwnProperty('message'))
            error_text  = error_text.message;
        this.error_text = error_text;
        this.error_title = error_title;
        this.visible = true;
    }
    resetErrorModal()
    {
        this.error_title = "Error";
        this.error_text = null;
        this.visible = false;
    }
}