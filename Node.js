const axios = require('axios');
const cheerio = require('cheerio');

async function getData(url, selector) {
  try {
    // Faz uma requisição HTTP para obter o HTML da página
    const response = await axios.get(url);

    // Carrega o HTML no Cheerio para facilitar a manipulação
    const $ = cheerio.load(response.data);

    // Selecione os elementos desejados usando um seletor CSS
    const elements = $(selector);

    // Itera sobre os elementos e extrai os dados
    const data = [];
    elements.each((index, element) => {
      // Adicione aqui a lógica para extrair os dados desejados
      const text = $(element).text();
      data.push(text);
    });

    return data;
  } catch (error) {
    console.error('Erro ao obter dados:', error.message);
  }
}

// Exemplo de uso
const url = 'https://example.com';
const selector = '.classe-desejada'; // substitua pelo seletor desejado

getData(url, selector)
  .then(data => {
    console.log('Dados extraídos:', data);
  })
  .catch(error => {
    console.error('Erro:', error.message);
  });
