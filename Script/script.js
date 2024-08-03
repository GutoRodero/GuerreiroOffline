//Funções alternativas
function camposObrigatoriosPreenchidos(form) {
    var camposPreenchidos = true;
    form.find('input, select').each(function () {
        if ($(this).prop('required') && $(this).val() === '') {
            camposPreenchidos = false;
            showMessage("Preencha os campos obrigatórios!", "danger");
            return false;
        }
    });
    return camposPreenchidos;
}

function showMessage(message, type) {
    var messageCard = $("#messageCard");
    messageCard.text(message);
    messageCard.removeClass().addClass("message-card " + type).show();

    // Defina as dimensões e posição do elemento de mensagem
    messageCard.css({
        "position": "fixed",
        "top": "50%",
        "left": "50%",
        "transform": "translate(-50%, -50%)",
        "background-color": "#f9f9f9",
        "padding": "20px",
        "border-radius": "5px",
        "box-shadow": "0 0 10px rgba(0, 0, 0, 0.1)",
        "z-index": "1000",
        "font-size": "20px", // Ajuste o tamanho da fonte conforme necessário
        "color": "#333", // Cor do texto
        "text-align": "center" // Centraliza o texto horizontalmente
    });

    setTimeout(function () {
        messageCard.hide();
    }, 3000);
}

function formatarValor(input) {
    // Remover todos os caracteres não numéricos
    let valorNumerico = input.value.replace(/\D/g, '');

    // Converter o valor para centavos (assumindo que o valor é em reais)
    let valorFormatado = (Number(valorNumerico) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    // Definir o valor formatado no campo de entrada
    input.value = valorFormatado;
}

//pessoa.php
function cadastrarPessoa() {
    if (camposObrigatoriosPreenchidos($('#formPessoa'))) {
        $.ajax({
            type: "POST",
            url: "./Pessoa/PessoaI001.php",
            data: $('#formPessoa').serialize(),
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Pessoa cadastrada com sucesso!", "success");
                    setTimeout(function () {
                        window.location.href = "pessoa.php";
                    }, 500); // 500 milissegundos = 1 segundo
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

function excluirPessoa(idPessoa) {
    var confirmacao = confirm("Tem certeza que deseja excluir a pessoa?");

    if (confirmacao) {
        $.ajax({
            type: "POST",
            url: "./Pessoa/PessoaE001.php",
            data: {
                idPessoa: idPessoa
            },
            success: function (response) {
                if (response.includes("sucesso")) {
                    window.location.href = "pessoa.php";
                } else {
                    showMessage("Erro ao excluir: " + response, "danger");
                }
            },
            error: function () {
                showMessage("Erro ao tentar excluir.", "danger");
            }
        });
    }
}

//produtonovo.php
function cadastrarProduto() {
    if (camposObrigatoriosPreenchidos($('#formProduto'))) {
        $.ajax({
            type: "POST",
            url: "./Produto/ProdutoI001.php",
            data: $('#formProduto').serialize(),
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Produto cadastrado com sucesso!", "success");
                    setTimeout(function () {
                        window.location.href = "produto.php";
                    }, 500); // 500 milissegundos = 1 segundo
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

function excluirProduto(idProduto) {
    // Exibe um diálogo de confirmação
    var confirmacao = confirm("Tem certeza que deseja excluir este produto?");

    if (confirmacao) {
        $.ajax({
            type: "POST",
            url: "./Produto/ProdutoE001.php",
            data: {
                idProduto: idProduto
            },
            success: function (response) {
                if (response.includes("sucesso")) {
                    window.location.href = "produto.php";
                } else {
                    showMessage("Erro ao excluir: " + response, "danger");
                }
            },
            error: function () {
                showMessage("Erro ao tentar excluir.", "danger");
            }
        });
    }
}

//produtoeditar.php
function editarProduto() {
    if (camposObrigatoriosPreenchidos($('#formProduto'))) {
        $.ajax({
            type: "POST",
            url: "./Produto/ProdutoA001.php",
            data: $('#formProduto').serialize(),
            success: function (data) {
                try {
                    const response = JSON.parse(data);
                    if (response.status === 'success') {
                        showMessage(response.message, "success");
                        setTimeout(function () {
                            window.location.href = "produto.php";
                        }, 500);
                    } else {
                        showMessage("Erro ao editar: " + response.message, "danger");
                    }
                } catch (e) {
                    console.error("Erro ao processar a resposta:", e);
                    showMessage("Erro ao processar a resposta do servidor.", "danger");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Erro ao enviar o formulário:", textStatus, errorThrown);
                showMessage("Erro ao enviar o formulário.", "danger");
            }
        });
    } else {
        showMessage("Por favor, preencha todos os campos obrigatórios.", "warning");
    }
}

//vendanovo.php
function cadastrarVenda() {
    if (camposObrigatoriosPreenchidos($('#formVenda'))) {
        $.ajax({
            type: "POST",
            url: "./Venda/VendaI001.php",
            data: $('#formVenda').serialize(),
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Venda cadastrado com sucesso!", "success");
                    setTimeout(function () {
                        window.location.href = "venda.php";
                    }, 500); // 500 milissegundos = 1 segundo
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

function excluirVenda(idVenda) {
    if (confirm('Tem certeza de que deseja excluir esta venda?')) {
        $.ajax({
            type: "POST",
            url: "./Venda/VendaE001.php",
            data: {
                idVenda: idVenda
            },
            success: function (response) {
                if (response.includes("sucesso")) {
                    showMessage("Venda excluída com sucesso!", "success");
                    setTimeout(function () {
                        window.location.href = "venda.php";
                    }, 500); // Redirecionar após 0,5 segundos
                } else {
                    showMessage("Erro ao excluir: " + response, "danger");
                }
            },
            error: function () {
                showMessage("Erro ao tentar excluir.", "danger");
            }
        });
    }
}
//vendaeditar.php
function editarVenda() {
    if (camposObrigatoriosPreenchidos($('#formVenda'))) {
        $.ajax({
            type: "POST",
            url: "./Venda/VendaA001.php",
            data: $('#formVenda').serialize(),
            success: function (data) {
                try {
                    const response = JSON.parse(data);

                    if (response.status === 'success') {
                        showMessage(response.message, "success");
                        setTimeout(function () {
                            window.location.href = "venda.php";
                        }, 500);
                    } else {
                        showMessage("Erro ao editar: " + response.message, "danger");
                    }
                } catch (e) {
                    console.error("Erro ao processar a resposta:", e);
                    showMessage("Erro ao processar a resposta do servidor.", "danger");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Erro ao enviar o formulário:", textStatus, errorThrown);
                showMessage("Erro ao enviar o formulário.", "danger");
            }
        });
    } else {
        showMessage("Por favor, preencha todos os campos obrigatórios.", "warning");
    }
}

function removerItemVenda(idItemVenda) {
    $.ajax({
        type: "POST",
        url: "./Venda/VendaE002.php",
        data: {
            idItemVenda: idItemVenda
        },
        success: function (data) {
            if (data.includes("sucesso")) {
            } else {
                showMessage("Erro ao excluir: " + data, "danger");
            }
        },
        error: function () {
            showMessage("Erro ao tentar excluir.", "danger");
        }
    });
}