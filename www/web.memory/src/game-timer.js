/**
 * @name GameTimer
 * @author IDeaFactory - June 2020
 * @version 1.0.0
 */

// Import helpful moment library to make date and time computation easier
import * as moment from 'moment'
import Logger from './_helpers/logger'
import Toast from './toast'

export default class GameTimer {
    constructor() {
        this._maxTime = 10 // Max time to play, in minute
        this._endTime = null;
        this._beginTime = null;
        this._elapsedTime = 0;
        this._progress = document.querySelector('progress');
        this._timer = null;
    }

    start() {
        if (this._timer !== null) {
            clearInterval(this._timer);
        }

        this._beginTime = moment();
        this._endTime = this._beginTime.clone()
        this._endTime.add(this._maxTime, 'minutes')

        // Sets the max value of the progress bar in seconds
        this._progress.setAttribute('max', 60 * this._maxTime)
        this._progress.setAttribute('value', this._elapsedTime)

        // Sets the progress animation progression
        this._init()
        
    }

    /**
     * Stop progression
     */
    stop() {
        clearInterval(this._timer)
        this._elapsedTime = 0

    }
    /**
     * Initiate the timer... and animate progress bar
     */
    _init() {
        this._timer = setInterval(
            () => {
                this._elapsedTime++;
                this._progress.setAttribute('value', this._elapsedTime)
                if (this._elapsedTime > (60 * this._maxTime)) {
                    Logger.info('You loose the game');
                    this._elapsedTime = 0
                    // Game was loosed...
                    this.stop() // Stop the interval manager
                    
                    // Redraw all cards
                    const _cards = document.querySelectorAll('.m-card')
                    _cards.forEach((card) => {
                        card.classList.add('freezed-card')
                        card.classList.remove('m-card')
                    })

                    // Send a toast to the user
                    const toast = new Toast({
                        content: 'Trop tard, vous avez perdu la partie !',
                        type: 'loosed'
                    })
                    toast.show()
                }
            },
            1000
        )
    }
}