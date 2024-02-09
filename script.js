//index.php
//Abrir as rotinas filho
function toggleSubmenu(submenuId) {
    var submenu = $('#' + submenuId);
    submenu.toggle();
}

//Carregar Divs
//Inicio
/* function carregarDivInicio() {
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
} */

function cadastrarPessoa() {
    if (camposObrigatoriosPreenchidos($('#formPessoa'))) {
        $.ajax({
            type: "POST",
            url: "./Pessoa/PessoaI001.php",
            data: form.serialize(),
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Pessoa cadastrada com sucesso!", "success");
                } else {
                    showMessage("Erro ao cadastrar: " + response, "danger");
                }
            },
            error: function () {
                showMessage("Erro ao enviar o formulário.", "danger");
            }
        });
    }
}

function camposObrigatoriosPreenchidos(form) {
    var camposPreenchidos = true;
    form.find('input, select').each(function () {
        if ($(this).prop('required') && $(this).val() === '') {
            camposPreenchidos = false;
            return false;
        }
    });
    return camposPreenchidos;
}


function showMessage(message, type) {
    var messageCard = $("#messageCard");
    messageCard.text(message);
    messageCard.removeClass().addClass("message-card " + type).show();
    setTimeout(function () {
        messageCard.hide();
    }, 3000);
}

function formatarValor(input) {
    let valor = input.value.replace(/\D/g, '');
    valor = "R$ " + (valor / 100).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
    input.value = valor;
}

//produtonovo.php
function cadastrarProduto() {
    if (camposObrigatoriosPreenchidos($('#formProduto'))) {
        $.ajax({
            type: "POST",
            url: "./Produto/ProdutoI001.php",
            data: form.serialize(),
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Produto cadastrado com sucesso!", "success");
                } else {
                    showMessage("Erro ao cadastrar: " + response, "danger");
                }
            },
            error: function () {
                showMessage("Erro ao enviar o formulário.", "danger");
            }
        });
    }
}
