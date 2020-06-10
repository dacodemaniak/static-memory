/**
 * @name CardEventManager
 * @author Aélion - June 2020
 * @abstract Sets event manager for cards in the platform
 */
export default class CardEventManager {
    constructor() {
        this._click() // Invoke click handler on cards
    }

    _click() {
        const cards = document.querySelectorAll('.card');
        
        cards.forEach((card) => {
            card.addEventListener(
                'click',
                () => {
                    console.log('Some card was clicked')
                }
            )
        })

    }
}