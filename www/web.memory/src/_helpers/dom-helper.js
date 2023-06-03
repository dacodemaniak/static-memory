export default class DomHelper {
    /**
     * @var HTMLElement
     */
    #element

    constructor(element) {
        this.#element = element
    }

    /**
     * 
     * @returns DOM Element
     */
    get() {
        return this.#element
    }

    /**
     * 
     * @param {string} id 
     * @returns new Instance of DOMHelper
     * @throws new Error if no match
     */
    static byId(id) {
        const element = document.getElementById(id)

        if (element) {
            return new DomHelper(element)
        }

        throw new Error(`There's no element identified by ${id}`)
    }

    /**
     * 
     * @param {*} className 
     * @returns new instance of DOMHelper
     * @throws new Error if more of one element was found
     * @throws new Error if no match
     */
    static byClassName(className) {
        const elements = document.querySelectorAll(`.${className}`)
        if (elements.length > 1) {
            throw new Error(`Many elements match to ${className} class name`)
        }

        if (elements.length === 0)
            throw new Error(`No element matches ${className}`)

        return new DomHelper(document.querySelector(`.${className}`))
    }
}