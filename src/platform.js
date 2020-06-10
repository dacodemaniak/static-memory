/**
 * @name Platform
 * @author Aélion - June 2020
 * @abstract Set cards on the platform
 */
import $ from 'jquery'

export default class Platform {
    constructor() {
        this._platform = $('#platform') // document.getElementById('platform')
        this._shuffleCard()
    }

    _shuffleCard() {
        let row = $('<div>');
        row.css('display', 'flex');
        let breakRow = 0 // To manage breaking at 6 cards
        let oddOrEven = 'odd'

        for (let i = 0; i < 36; i++) {
            let offset;
            if (i > 17) {
                offset = i - 18
                oddOrEven = 'even'
            } else {
                offset = i
            }

            
            const card = $('<div>')
            card
                .addClass('card')
                .addClass('hidden-face')
                .attr('data-rel', 'card-' + offset)
                .attr('data-value', oddOrEven)
                .css('background-position', '0 -' + offset * 100 + 'px')
            row.append(card);

            // Need to break with another row
            if (breakRow === 5) {
                this._platform.append(row);
                row = $('<div>').css('display', 'flex') // Create a new row
                breakRow = -1
            }
            breakRow++
        }
        setTimeout(
            () => { $('.outer-loader').addClass('hidden') },
            1000
        )
    }
}