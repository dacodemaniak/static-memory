/**
 * @name CardEventManager
 * @author Aélion - June 2020
 * @abstract Sets event manager for cards in the platform
 */

 import $ from 'jquery'

export default class CardEventManager {
    constructor() {
        this._click() // Invoke click handler on cards
    }

    _click() {
        $('.card').on(
            'click',
            (event) => {
                const element = $(event.target) // Cible de l'événement...
                if (element.hasClass('hidden-face')) {
                    element.removeClass('hidden-face')
                    console.log(`Click on ${element.attr('data-rel')}`)
                } else {
                    element.addClass('hidden-face')
                }
            }
        )
    }
}