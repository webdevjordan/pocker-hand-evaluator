// we need to load all our files that are quite important for us
import express from 'express';
import configs from './config/global_config.js';
import Server from './server/Server.js';
import MainRoutes from './routes/MainRoutes.js';

// set some constants
const app = express();
const port = configs.server.port;

// make sure that we can get the request body
app.use(express.json());

// setup our routes that will be accessed out when the connection is established
const mainRoutes = new MainRoutes(app);
mainRoutes.reigsterRoutes();

// start up our server and establish a connection so that we can listen for incoming requests
const server = new Server(app, port);
server.establishConnection();