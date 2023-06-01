/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */
import Platform from './platform'
import config from './config-APP_TARGET';
import Logger from './_helpers/logger'
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
    }
}

// Load the application after DOM was complete
let app = null;
document.addEventListener(
    'DOMContentLoaded',
    () => {
        app = new Main()
        app.start()
    }
)
