// controllers/mainController.js
const axios = require('axios');
const cheerio = require('cheerio');

async function getData(url, selector) {
    try {
        const response = await axios.get(url);
        const $ = cheerio.load(response.data);
        const elements = $(selector);
        const data = [];
        elements.each((index, element) => {
            const text = $(element).text();
            data.push(text);
        });
        return data;
    } catch (error) {
        throw new Error('Erro ao obter dados: ' + error.message);
    }
}

async function extractData(req, res) {
    const url = 'https://example.com';
    const selector = '.classe-desejada';

    try {
        const data = await getData(url, selector);
        res.json({ dadosExtraidos: data });
    } catch (error) {
        res.status(500).json({ erro: error.message });
    }
}

module.exports = {
    extractData,
};