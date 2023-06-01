import config from './../config-APP_TARGET';
export class Logger {
    constructor() {
      // Setup standard styles
      this.styles = {
        base: [
          "color: #fff",
          "background-color: #444",
          "padding: 2px 2px"
        ],
        warning: [
          "background-color: rgb(150, 25, 10)",
        ],
        error: [
          "background-color: rgb(200, 10, 10)",
        ],
        info: [
          "background-color: rgb(10, 10, 200)",
        ]
      }
    }


    static info(message) {
        const style = Logger._getStyles(Logger.styles.info)
        Logger._log(message, style)
    }

    static warning(message) {
        const style = Logger._getStyles(Logger.styles.warning)
        Logger._log(message, style)
    }

    static error(message) {
        const style = Logger._getStyles(Logger.styles.error)
        Logger._log(message, style)
    }

    static _log(message, styles) {
      if (config.devMode) {
        const now = new Date();
    
        let fullMessage = `${now.getHours()}:${now.getMinutes()}:${now.getSeconds()} : %c${message}`;
        
        console.log(
          fullMessage,
          style
        );
      }
    }
    static _getStyles(styleType) {
        let style = this.styles.base.join(';') + ';';
        style += this.styles.info.join(';');
    
        return style;
      }
    
}