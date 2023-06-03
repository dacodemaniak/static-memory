/**
 * @name FormManager
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @abstract Manager registration form simple implementation
 */

import DomHelper from "./_helpers/dom-helper"
import HttpClient from "./_http/http-client"

 export default class FormManager {
     constructor() {
        const domHelper = DomHelper.byClassName('form-loader')

        this._loader = domHelper.get()

        this._init()
     }

     /**
      * Initiate form manager
      */
     _init() {
         this._loader.classList.remove('hidden')

         // Place event handlers
     }

     _manage(event) {
        const domHelper = DomHelper.byId('name')

        const field = domHelper.get() // Get the support form field object

        // Check if full filled
        if (field.val().toString().trim().length > 0) {
            // Can send value to backend
            const uri = `http://127.0.0.1:8002/halloffame`
            const data = {
                name: field.val().toString().trim()
            }

            const httpClient = new HttpClient()
            httpClient.post(uri, data)
                .then((response) => response.json())
                .then((data) => {this._close()})
                .catch((error) => { this._close()})
        }
     }

     /**
      * Set register click handler
      */
     _register() {
        document.querySelector(`['register]`).addEventListener(
            'click',
            (event) => this._manage(event)
        )
     }

     /**
      * Set decline click handler
      */
     _decline() {
        document.querySelector(`['decline']`).addEventListener(
            'click',
            (event) => this._close()
        )
     }

     _close() {
         this._loader.classList.add('hidden')
     }
 }