/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */
import $ from 'jquery'
import * as materialize from 'materialize-css'
import Platform from './platform'

// Load SCSS at transpile time
import css from './scss/main.scss'
import BestPlayers from './best-players'

class Main {
    constructor() {
        this.gamePlatform = new Platform()
    }

    /**
     * Start a new game
     * Fired on Menu item click or at application starts
     */
    start() {
        this.gamePlatform.start()

        // Sets and Event Handler on the Menu Item to load a new game
        $('[newGame]').on(
            'click',
            (event) => {
                event.preventDefault()
                this.start()
            }
        )

        // Sets the event handler on Menu Item to load Best Player list
        $('[bestPlayers]').on(
            'click',
            (event) => {
                event.preventDefault()
                // Make an instance of BestPlayers class
                new BestPlayers()
            }
        )
    }
}

// Load the application after DOM was complete
let app = null;

$(document).ready(() => {
    app = new Main()
    app.start()
})

/**
 * Anonymous function to fire a new game
 */
const start = () => {
    app.start()
}
