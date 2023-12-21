// app.js
const express = require('express');
const routes = require('./routes').default;

const app = express();
const port = 3000;

// Configuração das rotas
app.use('/', routes);

// Inicia o servidor
app.listen(port, () => {
    console.log(`Servidor está rodando em http://localhost:${port}`);
});