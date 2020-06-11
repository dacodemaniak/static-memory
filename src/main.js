/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */
import $ from 'jquery'
import Platform from './platform'

// Load SCSS at transpile time
import css from './scss/main.scss'

class Main {
    constructor() {
        this.gamePlatform = new Platform()
    }

    start() {
        this.gamePlatform.start()

        $('[newGame]').on(
            'click',
            (event) => {
                event.preventDefault()
                this.start()
            }
        )
    }
}

// Load the application
let app = null;

$(document).ready(() => {
    app = new Main()
    app.start()
})

const start = () => {
    app.start()
}
