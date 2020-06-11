/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */
import $ from 'jquery'
import CardEventManager from './card-event-manager'
import Platform from './platform'

// Load SCSS at transpile time
import css from './scss/main.scss'

class Main {
    constructor() {
        const gamePlatform = new Platform()
        const cardEventManager = new CardEventManager()
    }
}

// Load the application
$(document).ready(() => {
    new Main()
})
