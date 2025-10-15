function chamarProximo(tipo) {
    const form = document.getElementById("form_chamar_proximo_" + tipo);
    if (form) {
        form.submit();
    }
}

function chamarNovamente(tipo) {
    const form = document.getElementById("form_chamar_novamente_" + tipo);
    if (form) {
        form.submit();
    }
}

function concluirChamado(tipo) {
    const form = document.getElementById("form_concluir_chamado_" + tipo);
    if (form) {
        form.submit();
    }
}

function cancelarChamado(tipo) {
    const form = document.getElementById("form_cancelar_chamado_" + tipo);
    if (form) {
        form.submit();
    }
}
function iniciar(tipo, inputId) {
    const numeroInput = document.getElementById(inputId);
    const form = document.getElementById("form_iniciar_" + tipo);
    const numeroInputForm = document.getElementById("numero_inicio_input_" + tipo);

    console.log("Valor do input:", numeroInput.value);

    if (numeroInput && form && numeroInputForm) {
        if (numeroInput.value.trim() !== "") {
            numeroInputForm.value = numeroInput.value.trim();
            form.submit();
        } else {
            // Campo vazio, desabilitar botão
            document.getElementById("btn_iniciar_" + tipo).disabled = true;
        }
    }
}

















