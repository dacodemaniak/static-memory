/**
 * @name Platform
 * @author Aélion - June 2020
 * @abstract Set cards on the platform
 */
import $ from 'jquery'

export default class Platform {
    constructor() {
        this._platform = $('#platform') // document.getElementById('platform')
        this._cards = []; // Sequential cards
        this._createCards()
        this._randomCards = []; // Shuffled cards
        this._shuffleCard()
        this._displayCards()
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
            const card = $('<div>')
            card
                .addClass('m-card')
                .addClass('hidden-face')
                .attr('data-rel', 'card-' + offset)
                .attr('data-value', oddOrEven)
                .css('background-position', '0 -' + offset * 100 + 'px')
            // Add card Element to array
            this._cards.push(card) // Add a card to sequential array
        }        
    }
    _shuffleCard() {
        let tabLength = 36
        
        for (let i = 0; i < 36; i++) {
            // Get random number in a range
            const random = Math.floor(Math.random() * tabLength)
            // Move random indice to target array
            this._randomCards.push(this._cards[random])
            // Remove from source array, the moved element
            this._cards.splice(random, 1)
            
            // Don't forget to decrement the tabLength
            tabLength--;
        }
    }

    _displayCards() {
        let row = $('<div>')
            .addClass('row');

        for (let i = 0; i < 36; i++) {
            const outerCard = $('<div>')
                .addClass('outer-card')
                .addClass('col')
                .addClass('s2')
                .append(this._randomCards[i])
            row.append(outerCard);
        }
        setTimeout(
            () => { 
                $('.outer-loader').addClass('hidden')
                this._platform.append(row);
            },
            500
        )
    }
}