import Builder from "./builder"

export default class HtmlBuilder extends Builder {
    constructor() {
        super()
    }

    /**
     * 
     * @returns HTMLElement
     */
    build() {
        return this.element
    }

    append(element) {
        this.element.appendChild(element)
        return this
    }
    
    /**
     * Add a CSS class to this element
     * @param {string} className 
     * @returns 
     */
    addClass(className) {
        if (!this.element.classList.contains(className)) {
            this.element.classList.add(className)
        }
        return this
    }

    /**
     * Set or Get an attribute of this element
     * 
     * @param {string} name 
     * @param {string} value default null
     * @returns attribute value or builder
     */
    attr(name, value = null) {
        if (value === null) {
            return this.element.getAttribute(name)
        }

        this.element.setAttribute(name, value)

        return this
    }

    /**
     * Set a inline style to this element
     * 
     * @param {string} property 
     * @param {string} value 
     * @returns HtmlBuilder
     */
    css(property, value) {
        this.element.style[property] = value
        return this
    }
}