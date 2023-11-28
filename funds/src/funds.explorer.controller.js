import { FundsExplorerService } from "./funds.explorer.service.js"

class FundsExplorerController {

    async test(request, response) {
        const { body } = request;

        try {
            const fundsExplorerService = new FundsExplorerService();
            return response.json('rota teste');
        } catch (err) {
            return response.status(400).json({
                err: err.message
            });
        }
    }
    
    async all(request, response) {
        const { body } = request;

        try {
            const fundsExplorerService = new FundsExplorerService();
            return response.json(await fundsExplorerService.execute(body));
        } catch (err) {
            return response.status(400).json({
                err: err.message
            });
        }
    }

    async show(request, response) {
        const cod = request.params.cod
        const { body } = request;

        try {
            const fundsExplorerService = new FundsExplorerService();
            return response.json(await fundsExplorerService.execute(body, cod));
        } catch (err) {
            return response.status(400).json({
                err: err.message
            });
        }
    }

}

export { FundsExplorerController }