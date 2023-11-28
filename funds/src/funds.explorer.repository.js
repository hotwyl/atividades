import fs from 'fs'
// import FundsExplorerModel from "./funds.explorer.model.js";

class FundsExplorerRepository {
    
    async saveToFile(data) {
        const filename = `./consultas/funds-ranking-${new Date().toISOString().split('T')[0]}.json`
        try {
            const content = JSON.stringify(data, null, 2)
            fs.writeFile(filename, content, 'utf8', (err) => {
                if (err) {
                    console.error(err)
                    return false
                }
                console.log(`Arquivo ${filename} foi gerado com sucesso.`)
                return true
            })
        } catch (error) {
            console.error(error)
            return false
        }
    }

    async getToFile() {

        const filename = `./consultas/funds-ranking-${new Date().toISOString().split('T')[0]}.json`
        var teste = []

        try {
            if (fs.existsSync(filename)) {

                var content = await this.loadToFile(filename)

                teste = {
                    file: filename,
                    success: true,
                    error: false,
                    content: content
                }

                // console.log(`Arquivo ${filename} foi carregado com sucesso.`)

            } else {
                teste = {
                    file: filename,
                    success: false,
                    error: true,
                    content: false
                }
            }
                    
        } catch (error) {
            teste = {
                success: false,
                error: true,
                content: errorfile
            }
        }

        return teste
    }

    async loadToFile(file) {

        return new Promise((resolve, reject) => {
            fs.readFile(file, (err, data) => {
              if (err) {
                reject(err);
              } else {
                try {
                  resolve(JSON.parse(data));
                } catch (parseError) {
                  reject(parseError);
                }
              }
            });
          });

    }
        
    async saveToDatabase(data) {
        try {
            const result = await FundsExplorerRepository.save(data)
            console.log(`Dados salvos com sucesso. ${result.insertedCount} registros inseridos.`)
            return true
        } catch (error) {
            console.error(error)
            return false
        }
    }

    async save(req, res) {
        FundsExplorerModel.create({
          nome: req.body.nome,
          email: req.body.email,
        }).then((result) => res.json(result));
      }

}

export default new FundsExplorerRepository();