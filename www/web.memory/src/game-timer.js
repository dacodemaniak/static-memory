/**
 * @name GameTimer
 * @author IDeaFactory - June 2020
 * @version 1.0.0
 */

// Import helpful moment library to make date and time computation easier
import * as moment from 'moment'
import $ from 'jquery'

export default class GameTimer {
    constructor() {
        this._maxTime = 10 // Max time to play, in minute
        this._endTime = null;
        this._beginTime = null;
        this._elapsedTime = 0;
        this._progress = $('progress');
        this._timer = null;
    }

    start() {
        if (this._timer !== null) {
            this._timer.clearInterval();
        }

        this._beginTime = moment();
        this._endTime = this._beginTime.clone()
        this._endTime.add(this._maxTime, 'minutes')

        // Sets the max value of the progress bar in seconds
        this._progress.attr('max', 60 * this._maxTime)
        this._progress.attr('value', this._elapsedTime)

        // Sets the progress animation progression
        this._init()
        
    }

    stop() {
        this._timer.clearInterval()
        this._elapsedTime = 0

    }
    _init() {
        this._timer = setInterval(
            () => {
                this._elapsedTime++;
                this._progress.attr('value', this._elapsedTime)
                if (this._elapsedTime > (60 * this._maxTime)) {
                    console.log('You loose the game');

                    // Game was loosed...
                    clearInterval(this._timer) // Stop the interval manager
                    
                    // Redraw all cards
                    $('.card')
                        .removeClass('card')
                        .addClass('freezed-card')

                    // Send a toast to the user
                }
            },
            1000
        )
    }
}