/**
 * @name Platform
 * @author Aélion - June 2020
 * @abstract Set cards on the platform
 */

// Import Card Event Manager
import CardBuilder from './_builders/card-builder';
import CardEventManager from './card-event-manager'

// Import the timer class
import GameTimer from './game-timer'

export default class Platform {
    constructor() {
        this._platform = document.getElementById('platform')
        this._cards = []; // Sequential cards
        this._createCards()
        this._randomCards = []; // Shuffled cards

        // Instanciate a new Timer
        this._timer = new GameTimer()

        // EventManager attribute (as DI)
        this._cardEventManager = null
    }

    start() {
        this._shuffleCard()
        this._displayCards()
        this._cardEventManager = new CardEventManager(this._timer)
    }

    _createCards() {
        let oddOrEven = 'odd'
        for (let i = 0; i < 36; i++) {
            let offset;
            if (i > 17) {
                offset = i - 18
                oddOrEven = 'even'
            } else {
                offset = i
            }
            // Create a card in DOM
            const card = new CardBuilder()
            card
                .addClass('m-card')
                .addClass('hidden-face')
                .attr('data-rel', 'card-' + offset)
                .attr('data-value', oddOrEven)
                .css('background-position', '0 -' + offset * 100 + 'px')
            // Add card Element to array
            this._cards.push(card.build()) // Add a card to sequential array
        }        
    }
    _shuffleCard() {
        let tabLength = 36
        const saveCards = [];
        for (let i = 0; i < 36; i++) {
            // Get random number in a range
            const random = Math.floor(Math.random() * tabLength)
            // Move random indice to target array
            this._randomCards.push(this._cards[random])
            // Remove from source array, the moved element
            saveCards.push(this._cards.splice(random, 1))
            
            // Don't forget to decrement the tabLength
            tabLength--;
        }
        // Restore cards after shuffling
        this._cards = saveCards;
    }

    _displayCards() {
        let row = new CardBuilder()
        row.addClass('row')

        for (let i = 0; i < 36; i++) {
            const outerCard = new CardBuilder()
                
            outerCard.addClass('outer-card')
                .addClass('col')
                .addClass('s2')
                .append(this._randomCards[i])
            row.append(outerCard.build());
        }
        setTimeout(
            () => {
                document.querySelector('.outer-loader').classList.add('hidden') 
                this._platform.appendChild(row.build());
                this._timer.start()
            },
            500
        )
    }
}