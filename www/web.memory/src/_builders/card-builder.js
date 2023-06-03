import HtmlBuilder from "./html-builder";

export default class CardBuilder extends HtmlBuilder {
    constructor() {
        super()
        this.element = document.createElement('div')
    }
}