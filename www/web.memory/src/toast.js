/**
 * @name Toast
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @abstract Simple toast sample
 */
export default class Toast {

    constructor(options) {
        this._options = {}

        this._options.type = options.hasOwnProperty('type') ? options.type : 'success'
        this._options.width = options.hasOwnProperty('width') ? options.type : '200px'
        this._options.height = options.hasOwnProperty('type') ? options.height : '100px'
        this._options.content = options.content
        this._options.duration = options.hasOwnProperty('duration') ? options.duration : 5

        this._toast = null;

        this._build()
    }

    show() {
        $('#platform').append(this._toast)
        setTimeout(
            () => {
                this._toast.remove()
            },
            this._options.duration * 1000
        )
    }

    _build() {
        this._toast = $('<div>')
        this._toast
            .addClass('m-toast')
            .addClass(this._options.type)
            .css('height', this._options.height)
            .css('width', this._options.width)
            .html(this._options.content)
    }
}