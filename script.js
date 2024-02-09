//index.php
//Abrir as rotinas filho
function toggleSubmenu(submenuId) {
    var submenu = $('#' + submenuId);
    submenu.toggle();
}

//Carregar Divs
//Inicio
function carregarDivInicio() {
    $("#conteudo").html('');
}

//Cliente
function carregarDivCliente() {
    $.ajax({
        method: "POST",
        url: "./pessoa.php",
        data: {},
        beforeSend: function () {
            $("#conteudo").html("Carregando...");
        }
    })
        .done(function (data) {
            $("#conteudo").html(data);
        })
        .fail(function () {
            $("#conteudo").html("Erro ao carregar o conteúdo da rotina Pessoa!");
        });
}

//Cliente
function carregarDivCadastrarCliente() {
    $.ajax({
        method: "POST",
        url: "./Pessoa/pessoanovo.php",
        data: {},
        beforeSend: function () {
            $("#conteudo").html("Carregando...");
        }
    })
        .done(function (data) {
            $("#conteudo").html(data);
        })
        .fail(function () {
            $("#conteudo").html("Erro ao carregar o conteúdo da rotina Pessoa!");
        });
}

function cadastrarPessoa() {
    var form = $('#formPessoa');
    $.ajax({
        type: "POST",
        url: "./Pessoa/PessoaI001.php",
        data: form.serialize(), // Serializa os dados do formulário
        success: function (response) {
            if (response.includes("sucesso")) {
                showMessage("Cadastrado com sucesso!", "success");
            } else {
                showMessage("Erro ao cadastrar: " + response, "danger");
            }
        },
        error: function () {
            showMessage("Erro ao enviar o formulário.", "danger");
        }
    });
}

function showMessage(message, type) {
    var messageCard = $("#messageCard");
    messageCard.text(message);
    messageCard.removeClass().addClass("message-card " + type).show();
    setTimeout(function () {
        messageCard.hide();
    }, 3000);
}