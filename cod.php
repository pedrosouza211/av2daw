<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os candidatos ordenados por nome e sala de prova
$sql = "SELECT nome, cpf, identidade, email, cargo_pretendido, sala_de_prova FROM candidatos ORDER BY nome, sala_de_prova";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $candidatos = array();
    while ($row = $result->fetch_assoc()) {
        $candidatos[] = $row;
    }
    $response = array(
        "success" => true,
        "data" => $candidatos
    );
    echo json_encode($response);
} else {
    $response = array(
        "success" => false,
        "message" => "Nenhum candidato encontrado."
    );
    echo json_encode($response);
}

$conn->close();
?>
<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validação dos dados
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $salaDeProva = $_POST["sala_de_prova"];

    // Verifica se os campos estão preenchidos
    if (empty($nome) || empty($cpf) || empty($salaDeProva)) {
        $response = array(
            "success" => false,
            "message" => "Todos os campos são obrigatórios."
        );
        echo json_encode($response);
        exit();
    }

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Insere o fiscal de prova no banco de dados
    $sql = "INSERT INTO fiscais (nome, cpf, sala_de_prova) VALUES ('$nome', '$cpf', '$salaDeProva')";
    if ($conn->query($sql) === TRUE) {
        $response = array(
            "success" => true,
            "message" => "Fiscal de prova incluído com sucesso."
        );
        echo json_encode($response);
    } else {
        $response = array(
            "success" => false,
            "message" => "Erro ao incluir fiscal de prova: " . $conn->error
        );
        echo json_encode($response);
    }

    $conn->close();
} else {
    // Resposta para requisições que não sejam do tipo POST
    $response = array(
        "success" => false,
        "message" => "Método inválido."
    );
    echo json_encode($response);
}
?>
<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validação dos dados
    $cpfCandidato = $_POST["cpfCandidato"];
    $novaSala = $_POST["novaSala"];

    // Verifica se os campos estão preenchidos
    if (empty($cpfCandidato) || empty($novaSala)) {
        $response = array(
            "success" => false,
            "message" => "Todos os campos são obrigatórios."
        );
        echo json_encode($response);
        exit();
    }

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Atualiza a sala de prova do candidato no banco de dados
    $sql = "UPDATE candidatos SET sala_de_prova='$novaSala' WHERE cpf='$cpfCandidato'";
    if ($conn->query($sql) === TRUE) {
        $response = array(
            "success" => true,
            "message" => "Sala de prova alterada com sucesso."
        );
        echo json_encode($response);
    } else {
        $response = array(
            "success" => false,
            "message" => "Erro ao alterar sala de prova: " . $conn->error
        );
        echo json_encode($response);
    }

    $conn->close();
} else {
    // Resposta para requisições que não sejam do tipo POST
    $response = array(
        "success" => false,
        "message" => "Método inválido."
    );
    echo json_encode($response);
}
?>
