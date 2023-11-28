import express from 'express';
import { FundsExplorerController } from "./funds.explorer.controller.js"

const routes = express.Router();

const fundsExplorerController = new FundsExplorerController();

routes.get("/", fundsExplorerController.test)

routes.get("/fundos", fundsExplorerController.all)

routes.get("/fundo/:cod", fundsExplorerController.show)

export default routes;