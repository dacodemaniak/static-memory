const httpVerbs = {
    GET: 'GET',
    POST: 'POST'
}

export default class HttpClient {
    /**
     * @var string
     */
    #uri = ''

    /**
     * @var string
     */
    #method = httpVerbs.GET

    /**
     * @var JSON
     * Body to send to backend
     */
    #body

    /**
     * @var JSON
     * Fetch configuration options
     */
    #headers = {}

    /**
     * 
     * @param {string} uri 
     * @returns Promise<HttpResponse>
     */
    get(uri) {
        this.#method = 'GET'
        this.#uri = uri

        return this.#_processRequest()
    }

    /**
     * 
     * @param {string} uri 
     * @param {JSON} body 
     * @returns Promise<HttpResponse>
     */
    post(uri, body) {
        this.#method = 'POST'
        this.#uri = uri
        this.#body = body

        this.#headers = {
            'Accept': 'application.json',
            'Content-Type': 'application.json'
        }

        return this.#_processRequest()
    }

    /**
     * 
     * @returns Promise<HttpResponse>
     */
    #_processRequest() {
        const fetchConfig = {}
        fetchConfig.method = this.#method
        fetchConfig.headers = this.#headers
        fetchConfig.cache = 'default'

        if (this.#method === 'POST') {
            fetchConfig.body = this.#body
        }

        const promise = fetch(
            this.#uri,
            fetchConfig
        )

        return promise
    }
}