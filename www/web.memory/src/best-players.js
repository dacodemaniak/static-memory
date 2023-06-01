/**
 * @name BestPlayers
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @abstract Query backend to load last 5 players if ever and show that list
 */

export default class BestPlayers {
    constructor() {
        /**
         * @var string Backend URI to call
         * @todo Extract in a config or .env file and choose build or dev
         */
        this._uri = 'http://127.0.0.1:8002/halloffame'

        /**
         * @var array Players returned from backend
         */
        this._players = [];

        this._get()
    }

    _get() {
        $.ajax({
            url: this._uri,
            method: 'get',
            dataType: 'json',
            success: (response) => {
                // Response contains datas we want to loop through
                const ul = $('[hallOfFame]');
                
                // Maybe any winner at this time...
                if (response.length) {
                    response.forEach((gamer) => {
                        const line = $('<li>')
                        line
                            .addClass('collection-item')
                            .html('<strong>' + gamer.name + '</strong>')
                        line.appendTo(ul)
                    })
                } else {
                    // No data at this time
                    const line = $('<li>')
                    line
                        .addClass('collection-item')
                        .html('<strong>If you win, you\'ll appear here next time!</strong>')
                    line.appendTo(ul)
                }

                // We can show the support loader
                $('.best-players-loader').removeClass('hidden')

                // Timeout before to close the loader
                setTimeout(
                    () => {
                        $('.best-players-loader').addClass('hidden')
                        // Clear all lines
                        ul.remove('li')
                    },
                    5000
                )
            },
            error: (XHR, httpStatus, error) => {
                console.log(`Something went wrong fetching players : ${error}`)
            }
        })
    }
}