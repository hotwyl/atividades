function validaDados(dados: { youtube_url_muvie: string | undefined | null }) {
    if (!dados.youtube_url_muvie || dados.youtube_url_muvie === '' || [null, false].includes(dados.youtube_url_muvie)) {
        dados.youtube_url_muvie = 'not_url';
    } else if (typeof dados.youtube_url_muvie === 'string' && !/^(ftp|http|https):\/\/[^ "]+$/.test(dados.youtube_url_muvie)) {
        dados.youtube_url_muvie = 'url_invalid';
    } else {
        const validaUrl = new URL(dados.youtube_url_muvie);
        if (['www.youtube.com', 'youtu.be'].includes(validaUrl.host)) {
            dados.youtube_url_muvie = processaInfo(dados.youtube_url_muvie);
        } else {
            dados.youtube_url_muvie = 'url_invalid';
        }
    }
    return dados.youtube_url_muvie;
}

function formataRetorno(metodo: string, resultado: string, registros: any = null) {
    let data: { resultado: string; messagem: string; data?: any } = { resultado: '', messagem: '' };
    switch (resultado) {
        case 'success':
            data.resultado = 'success';
            data.messagem = retornaMensagens(metodo, registros);
            if (registros !== null && registros !== false) {
                data.data = registros;
            }
            break;
        case 'error':
            data.resultado = 'error';
            data.messagem = retornaMensagens(metodo, registros);
            if (registros !== null && registros !== false) {
                data.data = registros;
            }
            break;
    }
    return data;
}

function retornaMensagens(metodo: string, registros: string) {
    let mensagem = '';
    switch (metodo) {
        case 'index':
            if (registros === 'url_invalid') {
                mensagem = 'Esta faltando algum parametro ou algum parametro informado é invalido.';
            } else if (registros === 'not_url') {
                mensagem = 'Método de busca não encontrada.';
            } else {
                mensagem = 'Busca executada corretamente. Segue dados encontrados.';
            }
            break;
    }
    return mensagem;
}

async function processaInfo(url: string) {
    const response = await fetch(`https://www.youtube.com/oembed?format=json&url=${url}`);
    const data = await response.json();
    return data;
}

try {
    let response: { youtube_url_muvie: string } = { youtube_url_muvie: 'https://youtu.be/6mEx9FtuN0k?si=4puBgTQckt1_3Sh9' };

    let validated = validaDados(response);

    if (['not_url', 'url_invalid'].includes(validated)) {
        validated = '';
        response = formataRetorno('index', 'error', validated);
    } else {
        response = formataRetorno('index', 'success', validated);
    }

    // Transformando a resposta em JSON e retornando um código de status 200 (OK)
    console.log(JSON.stringify(response));
} catch (ex) {
    const response = formataRetorno('index', 'error', ex.message);

    // Transformando a resposta em JSON e retornando um código de status 401 (Unauthorized)
    console.log(JSON.stringify(response));
}
