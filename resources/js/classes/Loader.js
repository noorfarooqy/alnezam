export default class {
    constructor()
    {
        this.visible = false;
        this.loading_text = "Loading...";
    }
    showLoader(loading_text = "Loading...")
    {
        this.loading_text = loading_text;
        this.visible = true;
    }
    resetLoader ()
    {
        this.visible = false;
        this.loading_text = "Loading..."
    }
}