/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */
import $ from 'jquery'
import * as materialize from 'materialize-css'
import Platform from './platform'
import config from './config-APP_TARGET';
import { Logger } from './_helpers/logger'
import BestPlayers from './best-players'

// Load SCSS at transpile time
import css from './scss/main.scss'


class Main {
    constructor() {
        Logger.info('DevMode is up ' + config.devMode)
        this.gamePlatform = new Platform()
    }

    /**
     * Start a new game
     * Fired on Menu item click or at application starts
     */
    start() {
        this.gamePlatform.start()

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
