/**
 * @name FormManager
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @abstract Manager registration form simple implementation
 */

 export default class FormManager {
     constructor() {
         this._loader = $('.form-loader')

        this._init()
     }

     /**
      * Initiate form manager
      */
     _init() {
         this._loader.removeClass('hidden')

         // Place event handlers
     }

     _manage(event) {
        const field = $('#name') // Get the support form field object

        // Check if full filled
        if (field.val().toString().trim().length > 0) {
            // Can send value to backend
            const uri = `http://127.0.0.1:8002/halloffame`
            const data = {
                name: field.val().toString().trim()
            }
            $.ajax({
                url: uri,
                method: 'post',
                dataType: 'json',
                data : data,
                success: (response) => {
                    
                },
                error: (XHR, status, error) => {

                },
                complete: () => { // After success or error handling
                    this._close()
                }
            })
        }
     }

     /**
      * Set register click handler
      */
     _register() {
         $('[register]').on(
             'click',
             (event) => this._manage(event)
         )
     }

     /**
      * Set decline click handler
      */
     _decline() {
         $('[decline]').on(
             'click',
             (event) => {
                 this._close()
             }
         )
     }

     _close() {
         this._loader.addClass('hidden')
     }
 }