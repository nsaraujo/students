<?php
// dadospessoais.php
require_once 'db.php'; // Arquivo de conexão com o banco de dados

// Função para listar todos os estudantes
function listStudents() {
    global $conn;
    $sql = 'SELECT * FROM dadospessoais';
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para adicionar um novo estudante
function addStudent($nome, $endereco, $cidade, $estado, $email, $phone) {
    global $conn;
    $sql = "INSERT INTO dadospessoais (nome, endereco, cidade, estado, email, phone) VALUES ('$nome', '$endereco', '$cidade', '$estado', '$email', '$phone')";
    $conn->query($sql);
}

// Função para editar um estudante existente
function editStudent($id, $nome, $endereco, $cidade, $estado, $email, $phone) {
    global $conn;
    $sql = "UPDATE dadospessoais SET nome='$nome', endereco='$endereco', cidade='$cidade', estado='$estado', email='$email', phone='$phone' WHERE id=$id";
    $conn->query($sql);
}

// Função para excluir um estudante
function deleteStudent($id) {
    global $conn;
    $sql = "DELETE FROM dadospessoais WHERE id=$id";
    $conn->query($sql);
}

// Lógica para processar formulários (adicionar, editar, excluir)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        addStudent($_POST['nome'], $_POST['endereco'], $_POST['cidade'], $_POST['estado'], $_POST['email'], $_POST['phone']);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $student = listStudents(); // Busca o estudante pelo ID
        editStudent($id, $_POST['nome'], $_POST['endereco'], $_POST['cidade'], $_POST['estado'], $_POST['email'], $_POST['phone']);
    } elseif (isset($_POST['delete'])) {
        deleteStudent($_POST['id']);
    }
}

// Obtém a lista de estudantes
$students = listStudents();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta nome="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Estudantes</title>
    <!-- Estilos CSS aqui -->
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        /* Estilos do cabeçalho */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        nav {
            font-size: 16px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
        /* Estilos da seção de estudantes */
        .students-section {
            background-color: #f9f9f9;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #eee;
        }
        .add-button, .edit-button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            margin-right: 10px;
        }
        .edit-button {
            background-color: #2196f3;
        }
        .pequeno {
            width: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Gerenciamento de Estudantes</h1>
    <nav>
    <!-- Formulário para adicionar/editar estudantes -->
    <form method="post">
        <input class="pequeno" type="number" name="id" placeholder="ID" value="<?= $_POST['id'] ?? '' ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?= $_POST['nome'] ?? ($student['nome'] ?? '') ?>">
        <input type="text" name="endereco" placeholder="Endereço" value="<?= $_POST['endereco'] ?? ($student['endereco'] ?? '') ?>">
        <input type="text" name="cidade" placeholder="Cidade" value="<?= $_POST['cidade'] ?? ($student['cidade'] ?? '') ?>">
        <input class="pequeno" type="text" name="estado" placeholder="Estado" value="<?= $_POST['estado'] ?? ($student['estado'] ?? '') ?>">
        <input type="email" name="email" placeholder="E-mail" value="<?= $_POST['email'] ?? ($student['email'] ?? '') ?>">
        <input type="tel" name="phone" placeholder="Telefone" value="<?= $_POST['phone'] ?? ($student['phone'] ?? '') ?>">
        <button type="submit" name="add">Adicionar</button>
        <button type="submit" name="edit">Editar</button>
    </form>
    </nav>
    <!-- Lista de estudantes -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Email</th>
            <th>Telefone</th>
            <!-- Outras colunas aqui -->
            <th>Ações</th>
        </tr>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['nome'] ?></td>
                <td><?= $student['endereco'] ?></td>
                <td><?= $student['cidade'] ?></td>
                <td><?= $student['estado'] ?></td>
                <td><?= $student['email'] ?></td>
                <td><?= $student['phone'] ?></td>
                <!-- Outras colunas aqui -->
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $student['id'] ?>">
                        <button type="submit" name="delete">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html