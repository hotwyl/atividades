$(document).ready(function () {
    // Inicializar a tabela DataTables
    $('#feeds-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true
    });

    // Carregar dados da tabela via AJAX
    $.ajax({
        url: 'crud.php', // Substitua 'crud.php' pelo caminho real do seu arquivo
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Preencher a tabela com os dados obtidos
            var table = $('#feeds-table').DataTable();
            table.clear().rows.add(data).draw();
        },
        error: function (error) {
            console.error(error);
        }
    });
    
    // Submeter o formulário de cadastro
    $('#addItemForm').submit(function (e) {
        e.preventDefault();

        // Realizar validações adicionais no JavaScript
        if (this.checkValidity()) {
            // Adicione a lógica para enviar os dados do formulário via AJAX para o backend
            // Feche o modal após o cadastro bem-sucedido
            // $('#addItemModal').modal('hide');

            // Enviar os dados do formulário via AJAX para o backend
            $.ajax({
                url: 'crud.php', // Substitua 'backend.php' pelo caminho real do seu backend
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    // Lógica após o sucesso
                    console.log(response);
                    // Feche o modal após o cadastro bem-sucedido
                    $('#addItemModal').modal('hide');
                },
                error: function (error) {
                    // Lógica em caso de erro
                    console.error(error);
                }
            });
        } else {
            // Se houver erros de validação, exiba os feedbacks de erro
            $(this).addClass('was-validated');
        }

        $('#addItemModal').modal('hide');
    });
});