/**
 * @name CardEventManager
 * @author Aélion - June 2020
 * @abstract Sets event manager for cards in the platform
 */
import GameTimer from './game-timer'
import Toast from './toast'
import FormManager from './form-manager'
import Logger from './_helpers/logger'

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
        const _platform = document.getElementById('platform')
        _platform.onclick = (event) => {
            const _card = event.target.closest('.m-card')
            
            if (!_card) return // Nope if not a card

            Logger.info('Click on card was detected')

            if (_card.classList.contains('hidden-face')) {
                Logger.info(`Reveal ${_card.getAttribute('data-rel')}`)
                this._addCard(_card)
            } else {
                this._removeCard(_card)
            }
        }
    }

    /**
     * Process Card reveal
     * @param {*} element
     * @todo Prefer async / await for the FormManager instead of poor synchron implementation
     */
    _addCard(element) {
        // Reveal the element clicked
        element
            .classList.add('flip-out')
        
        setTimeout(
            () => {
                element
                    .classList.remove('hidden-face')
                element
                    .classList.remove('flip-out')
                element
                    .classList.add('flip-in')
            },
            500
        )
        if (this._playingCard !== null) {
            Logger.info('A card was previously played')
            // Some cards was played, try to know if both are same
            if (element.getAttribute('data-rel') === this._playingCard.getAttribute('data-rel')) {
                // Pair was found... So freeze cards
                this._pairs++;
                element
                    .classList.add('freezed-card')
                element
                    .classList.remove('m-card')

                this._playingCard
                    .classList.add('freezed-card')
                this._playingCard
                    .classList.remove('m-card')
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
                        Logger.info(`Hide current card : ${element.attr('data-rel')}`)
                        element
                            .classList.remove('flip-in')
                        element
                            .classList.add('hidden-face')
                        Logger.info(` Hide played card : ${this._playingCard.attr('data-rel')}`)
                        this._playingCard
                            .classList.remove('flip-in')
                        this._playingCard
                            .classList.add('hidden-face')
                        // Don't forget to empty the played card
                        this._playingCard = null;
                    },
                    1500
                )
            }
        } else {
            // Store clicked card... and wait for next card
            Logger.info(`Store ${element.getAttribute('data-rel')} as played card`)
            this._playingCard = element;
        }
    }

    /**
     * Process click back on a card
     * @param {*} element 
     */
    _removeCard(element) {
        element
            .classList.add('hidden-face')
        element
            .classList.remove('flip-in')
        this._playingCard = null;
    }
}