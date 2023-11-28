import axios from "axios";
import cheerio from "cheerio";
import FundsExplorerRepository from "./funds.explorer.repository.js";

class FundsExplorerService {
    async execute(data, cod = null) {
        try {

            const file = await FundsExplorerRepository.getToFile();

            const validat = [NaN, null, '', ' ']

            if(file.success == true && file.error == false){

                if (validat.includes(cod)){
                    return file.content
                }else {
                    return this.search(file.content, cod)
                }
 
            } else {

                const url = "https://www.fundsexplorer.com.br/ranking"

                const response = await this.busca(url);

                console.log(response)

                const result = await this.processa(response, url);

                console.log(result)
            
                await FundsExplorerRepository.saveToFile(result);

                // await FundsExplorerRepository.saveToDatabase(result);
        
                if (validat.includes(cod)){
                    return {
                        "sucess": true,
                        "errors": [],
                        "content": result
                    };
                }else {
                    return this.search(result, cod)
                }

            }
            
        } catch (error) {
            console.error('Failed to scrape data from the website:', error);
        }

    }

    async busca(url) {
        
        var resposta = []

        try {
            
            var config = {
                method: 'get',
                url: url
              };

            await axios(config)
                .then(function (response) {
                    // manipula o sucesso da requisição
                    resposta = {
                        sucess: true,
                        error: false,
                        content: response.data
                    }
                })
                .catch(function (error) {
                    // manipula erros da requisição
                    resposta = {
                        sucess: false,
                        error: true,
                        content: error
                    }
                })
                .finally(function () {
                    // sempre será executado
                    console.log('Atualização base..')
                });

        } catch (error) {
            resposta = {
                sucess: false,
                error: true,
                content: error
            }
        }

        return resposta
    }

    async processa(response, url) {

        const $ = cheerio.load(response.content);
        const tabelaStatus = $("#table-ranking > tbody > tr");
        const fundos = [];
        const validat = [NaN, "NaN", Infinity, "Infinity"];
        const rendimento_mensal = 10000;
        const rendimento_trimestral = rendimento_mensal * 3;
        const rendimento_semestral = rendimento_mensal * 6;
        const rendimento_anual = rendimento_mensal * 12;

        tabelaStatus.each((index, element) => {
            const teste = $(element).text().split("\n");
            const arr = [];
    
            for (let index = 0; index < teste.length; index++) {
                arr.push(teste[index].trim());
            }
            
            const codigo = arr[1]
            const setor = arr[3]
            const preco_atual = (arr[5] == 'N/A') ? '0.00' : arr[5].replace(",", ".").split(' ')[1]
            const liquidez_diaria = (arr[7] == 'N/A') ? '0.00' : arr[7]
            const dividendo = (arr[9] == 'N/A') ? '0.00' : arr[9].replace(",", ".").split(' ')[1]
            const dividend_yield = (arr[11] == 'N/A') ? '0.00' : arr[11].replace(",", ".").split('%')[0]
            const dy_3m_acumulado = (arr[13] == 'N/A') ? '0.00' : arr[13].replace(",", ".").split('%')[0]
            const dy_6m_acumulado = (arr[15] == 'N/A') ? '0.00' : arr[15].replace(",", ".").split('%')[0]
            const dy_12m_acumulado = (arr[17] == 'N/A') ? '0.00' : arr[17].replace(",", ".").split('%')[0]
            const dy_3m_media = (arr[19] == 'N/A') ? '0.00' : arr[19].replace(",", ".").split('%')[0]
            const dy_6m_media = (arr[21] == 'N/A') ? '0.00' : arr[21].replace(",", ".").split('%')[0]
            const dy_12m_media = (arr[23] == 'N/A') ? '0.00' : arr[23].replace(",", ".").split('%')[0]
            const dy_ano = (arr[25] == 'N/A') ? '0.00' : arr[25].replace(",", ".").split('%')[0]
            const variacao_preco = (arr[27] == 'N/A') ? '0.00' : arr[27].replace(",", ".").split('%')[0]
            const rentab_periodo = (arr[29] == 'N/A') ? '0.00' : arr[29].replace(",", ".").split('%')[0]
            const rentab_acumulada = (arr[31] == 'N/A') ? '0.00' : arr[31].replace(",", ".").split('%')[0]
            const patrimonio_liq = (arr[33] == 'N/A') ? '0.00' : arr[33].split(' ')[1]
            const vpa = (arr[35] == 'N/A') ? '0.00' : arr[35].replace(",", ".").split(' ')[1]
            const p_vpa = (arr[37] == 'N/A') ? '0.00' : arr[37].replace(",", ".")
            const dy_patrimonial = (arr[39] == 'N/A') ? '0.00' : arr[39].replace(",", ".").split('%')[0]
            const variacao_patrimonial = (arr[41] == 'N/A') ? '0.00' : arr[41].replace(",", ".").split('%')[0]
            const rentab_patr_no_periodo = (arr[43] == 'N/A') ? '0.00' : arr[43].replace(",", ".").split('%')[0]
            const rentab_patr_acumulada = (arr[45] == 'N/A') ? '0.00' : arr[45].replace(",", ".").split('%')[0]
            const vacancia_fisica = (arr[47] == 'N/A') ? '0.00' : arr[47].replace(",", ".").split('%')[0]
            const vacancia_financeira = (arr[49] == 'N/A') ? '0.00' : arr[49].replace(",", ".").split('%')[0]
            const quantidade_ativos = (arr[51] == 'N/A') ? '0.00' : arr[51]
        
            var liquidez = (parseFloat(liquidez_diaria) * parseFloat(preco_atual)).toFixed(2)
            liquidez = (validat.includes(liquidez)) ? null : liquidez;
        
            var custo_mercado = (parseFloat(preco_atual) > parseFloat(vpa)) ? "Maior" : "Menor"
            custo_mercado = (validat.includes(custo_mercado)) ? null : custo_mercado;
        
            var saldo = (parseFloat(preco_atual) - parseFloat(vpa)).toFixed(2)
            saldo = (validat.includes(saldo)) ? null : saldo;
        
            var qtd_cota_mult = Math.ceil(parseFloat(preco_atual) / parseFloat(dividendo)).toString()
            qtd_cota_mult = (validat.includes(qtd_cota_mult)) ? null : qtd_cota_mult;

            var vlr_cota_mult = (parseFloat(preco_atual) * parseInt(qtd_cota_mult)).toFixed(2)
            vlr_cota_mult = (validat.includes(vlr_cota_mult)) ? null : vlr_cota_mult;
        
            var qtd_cota_viver = Math.ceil(parseFloat(rendimento_mensal) / parseFloat(dividendo)).toString()
            qtd_cota_viver = (validat.includes(qtd_cota_viver)) ? null : qtd_cota_viver;
        
            var vlr_cota_viver = (parseFloat(qtd_cota_viver) * parseInt(preco_atual)).toFixed(2)
            vlr_cota_viver = (validat.includes(vlr_cota_viver)) ? null : vlr_cota_viver;
            
            var linha = {
                codigo,
                setor,
                preco_atual,
                liquidez_diaria,
                dividendo,
                dividend_yield,
                dy_3m_acumulado,
                dy_6m_acumulado,
                dy_12m_acumulado,
                dy_3m_media,
                dy_6m_media,
                dy_12m_media,
                dy_ano,
                variacao_preco,
                rentab_periodo,
                rentab_acumulada,
                patrimonio_liq,
                vpa,
                p_vpa,
                dy_patrimonial,
                variacao_patrimonial,
                rentab_patr_no_periodo,
                rentab_patr_acumulada,
                vacancia_fisica,
                vacancia_financeira,
                quantidade_ativos,
                liquidez,
                custo_mercado,
                saldo: saldo,
                qtd_cota_mult,
                vlr_cota_mult,
                qtd_cota_viver,
                vlr_cota_viver
            }

            fundos.push(linha);
        });

        return {
            origem: {
                    fonte: url,
                    data: new Date().toLocaleDateString("pt-BR"),
                },
            rendimentos_pretendido: {
                rendimento_mensal,
                rendimento_trimestral,
                rendimento_semestral,
                rendimento_anual,
            },
            fundos,
        }
    }

    async search(data, cod){

        let fundos = data.fundos
        let origem = data.origem
        let rendimentos_pretendido = data.rendimentos_pretendido

        var fundo = []
         
        fundos.forEach(element => {
            if(element.codigo == cod) {
                fundo.push(element) 
            }
        });
        
        if(fundo.length >= 1){
            fundo = fundo[0]
            return {
                origem, rendimentos_pretendido,fundo
            }
        }else{
            return {
                "sucess": false,
                "errors": ['não encontrado nenhum fundo com codigo informado'],
                "content": null
            } 
        }        
    }

}

export { FundsExplorerService }