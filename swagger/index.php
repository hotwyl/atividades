<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Documentação da API</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui.css" />
</head>
<body>
    <div id="swagger-ui"></div>

    <script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
    <script>
        window.onload = function () {
            const ui = SwaggerUIBundle({
                url: "./RetornoVeiculos.json",
                dom_id: '#swagger-ui',
                presets: [SwaggerUIBundle.presets.apis],
                layout: "BaseLayout"
            });
        }
    </script>
</body>
</html>
