/**
 * @name CardEventManager
 * @author Aélion - June 2020
 * @abstract Sets event manager for cards in the platform
 */

 import $ from 'jquery'
import GameTimer from './game-timer'
import Toast from './toast';
import FormManager from './form-manager';

export default class CardEventManager {
    constructor(timer) {
        this._click() // Invoke click handler on cards
        this._playingCard = null; // Map for played cards
        this._pairs = 0 // Nombre de paires trouvées

        this._timer = timer; // Instance of Timer to clear game if won
    }

    /**
     * Click event Manager using event delegation to manage cards reveal
     */
    _click() {
        $('#platform').on(
            'click',
            '.m-card', // Event delegation needed to perform actions
            (event) => {
                console.log('Detect click on card')
                const element = $(event.target) // Real element clicked (The Card)
                if (element.hasClass('hidden-face')) {
                    console.log(`Reveal ${element.attr('data-rel')}`)
                    this._addCard(element)
                } else {
                    this._removeCard(element)
                }
            }
        )
    }

    /**
     * Process Card reveal
     * @param {*} element
     * @todo Prefer async / await for the FormManager instead of poor synchron implementation
     */
    _addCard(element) {
        // Reveal the element clicked
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
        if (this._playingCard !== null) {
            console.log('A card was previously played')
            // Some cards was played, try to know if both are same
            if (element.attr('data-rel') === this._playingCard.attr('data-rel')) {
                // Pair was found... So freeze cards
                this._pairs++;
                element
                    .addClass('freezed-card')
                    .removeClass('m-card')
                this._playingCard
                    .addClass('freezed-card')
                    .removeClass('m-card')
                // Sets played card as null, to make another pick
                this._playingCard = null;

                if (this._pairs === 18) {
                    // Game is won
                    this._timer.stop() // Stop the timer
                    // Play a congrats
                    const toast = new Toast({
                        content: "Congrats... You win!"
                    })
                    // @todo prefer async / await or simple promise to wait for toast closing
                    toast.show()

                    // Then... Show dialog to register... or not
                    const formManager = new FormManager() // FormManager instanciation
                }
            } else {
                // Turn off cards after delay
                setTimeout(
                    () => {
                        console.log(`Hide current card : ${element.attr('data-rel')}`)
                        element
                            .removeClass('flip-in')
                            .addClass('hidden-face')
                        console.log(` Hide played card : ${this._playingCard.attr('data-rel')}`)
                        this._playingCard
                            .removeClass('flip-in')
                            .addClass('hidden-face')
                        // Don't forget to empty the played card
                        this._playingCard = null;
                    },
                    1500
                )
            }
        } else {
            // Store clicked card... and wait for next card
            console.log(`Store ${element.attr('data-rel')} as played card`)
            this._playingCard = element;
        }
    }

    /**
     * Process click back on a card
     * @param {*} element 
     */
    _removeCard(element) {
        element
            .addClass('hidden-face')
            .removeClass('flip-in')
        this._playingCard = null;
    }
}