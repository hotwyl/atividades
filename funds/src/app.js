import express, { json } from 'express';
import { config } from 'dotenv';
import cors from 'cors';
import routes from './funds.explorer.routes.js';
// import db from "./db.js";
import swagger from '../swagger.js';

config();

const app = express();

app.use(json());

app.set("json spaces", 3);

app.use(cors({
    //origin: ['https://www.3wonline.com', 'http://www.3wonline.com', 'https://www.3wonline.com.br', 'http://www.3wonline.com.br', 'https://3wonline.com', 'http://3wonline.com', 'https://3wonline.com.br', 'http://3wonline.com.br']
    origin: '*'
}));

app.use('/', routes);

swagger(app)


const PORT = process.env.PORT || 3000

app.listen(PORT, () => console.log(`Server is running on PORT - ${PORT}`));

// db.sync(() => console.log(`Banco de dados conectado: ${process.env.DB_NAME}`));