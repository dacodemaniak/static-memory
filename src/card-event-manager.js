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
                    console.log(`Reveal ${element.attr('data-rel')}`)
                    element
                        .addClass('flip-out')
                    setTimeout(
                        () => {
                            element
                                .removeClass('hidden-face')
                                .removeClass('flip-out')
                                .addClass('flip-in')
                        },
                        500
                    )
                } else {
                    element
                        .addClass('hidden-face')
                        .removeClass('flip-in')
                }
            }
        )
    }
}