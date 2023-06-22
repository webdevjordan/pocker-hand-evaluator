class Server {
    port        = null;
    app         = null;
    defaultPort = 3000;
    message     = 'Establishing server connection and listening';
    error       = 'Could not establish connection';

    constructor(app, port) {
       this.port = port
       this.app  = app; 
    }
    
    establishConnection() {
        try {
            let connectionMessage = '';
            if (this.port != null || this.port != '') {
                this.port = this.defaultPort;
                connectionMessage = `${this.message} on default port ${this.defaultPort}`;
            } else {
                connectionMessage = `${this.message} on port ${this.port}`;
            }
            this.app.listen(this.port, () => console.log(connectionMessage));
        } catch (error) {
            console.log('could not establish connection ' + error)
        }
    }
}

export default Server;