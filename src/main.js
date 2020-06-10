/**
 * @name Main
 * @author Aélion - June 2020
 * @abstract Entry point of the memory game
 */

import CardEventManager from './card-event-manager'

class Main {
    constructor() {
        const cardEventManager = new CardEventManager()
    }
}

// Load the application
document.addEventListener(
    'DOMContentLoaded',
    () => {
        new Main()
    }
)
