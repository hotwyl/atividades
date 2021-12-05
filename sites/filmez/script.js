$(function () {
    $.ajax({

        /*https://api.themoviedb.org/3/movie/popular?api_key=1378b113cff1b7df51330c1c4a63d453&language=pt-BR
        https://api.themoviedb.org/3/tv/popular?api_key=1378b113cff1b7df51330c1c4a63d453&language=pt-BR */
        
        url: 'https://api.themoviedb.org/3/movie/popular?api_key=1378b113cff1b7df51330c1c4a63d453',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('.filmes').html('<div class="col-md-12">Carregando...</div>');
        },
        success: function (json) {
            console.log(json.results);
            var data = json.results;
            var html = '';

            for (var i in json.results) {
                html += '<div class="col-md-3">',
                    html += '<img src="https://image.tmdb.org/t/p/original' + data[i].backdrop_path + '" class="img-filmes" />',
                    html += data[i].original_title + '</div>'

            }

            $('.filmes').html(html);
        }
    });

});