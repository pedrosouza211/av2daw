// Função para listar candidatos em ordem de nome por sala de prova
function listarCandidatos() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var candidatos = response.data;
                var listarCandidatosDiv = document.getElementById("listar-candidatos");
                listarCandidatosDiv.innerHTML = "";

                for (var i = 0; i < candidatos.length; i++) {
                    var candidato = candidatos[i];
                    var candidatoInfo = document.createElement("p");
                    candidatoInfo.textContent = "Nome: " + candidato.nome + ", CPF: " + candidato.cpf + ", Identidade: " + candidato.identidade + ", Email: " + candidato.email + ", Cargo Pretendido: " + candidato.cargo_pretendido + ", Sala de Prova: " + candidato.sala_de_prova;

                    listarCandidatosDiv.appendChild(candidatoInfo);
                }
            } else {
                var mensagemDiv = document.getElementById("mensagem");
                mensagemDiv.textContent = response.message;
            }
        }
    };
    xhr.open("GET", "listar_candidatos.php", true);
    xhr.send();
}

// Função para incluir fiscal de prova
function incluirFiscalProva() {
    var nome = document.getElementById("fiscal-nome").value;
    var cpf = document.getElementById("fiscal-cpf").value;
    var salaDeProva = document.getElementById("fiscal-sala").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var mensagemDiv = document.getElementById("mensagem");
            mensagemDiv.textContent = response.message;
        }
    };
    xhr.open("POST", "incluir_fiscal.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nome=" + encodeURIComponent(nome) + "&cpf=" + encodeURIComponent(cpf) + "&sala_de_prova=" + encodeURIComponent(salaDeProva));
}

// Função para alterar a sala de prova de um candidato
function alterarSalaProva() {
    var cpf = document.getElementById("candidato-cpf").value;
    var novaSala = document.getElementById("nova-sala").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var mensagemDiv = document.getElementById("mensagem");
            mensagemDiv.textContent = response.message;
        }
    };
    xhr.open("POST", "alterar_sala.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("cpfCandidato=" + encodeURIComponent(cpf) + "&novaSala=" + encodeURIComponent(novaSala));
}
