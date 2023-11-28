import { config } from 'dotenv'; // importar o dotenv para localizar as variáveis de ambiente
import { Sequelize } from "sequelize"; // importar o sequelize

config();

const dbName = process.env.DB_NAME || 'funds'; // passar os dados do .env para as constantes
const dbUser = process.env.DB_USER || 'root';
const dbHost = process.env.DB_HOST || '127.0.0.1';
const dbPassword = process.env.DB_PASSWORD || '';

const sequelize = new Sequelize(dbName, dbUser, dbPassword, {
  //passar os dados para o sequelize
  dialect: "mysql", //informar o tipo de banco que vamos utilizar
  host: dbHost, //o host, neste caso estamos com um banco local
});

export default sequelize; //exportar