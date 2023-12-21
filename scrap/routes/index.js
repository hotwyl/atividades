// routes/index.js
const express = require('express');
const router = express.Router();
const mainController = require('../controllers/mainController').default;

router.get('/', (req, res) => {
    res.send('Hello, World!');
});

router.get('/extrair-dados', mainController.extractData);

module.exports = router;