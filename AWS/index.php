<?php
// index.php
require_once 'db.php';

$sql = 'SELECT * FROM students';
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ University</title>
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

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #eee;
        }

        .add-button,
        .edit-button {
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
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">XYZ University</div>
            <nav>
                <a href="#">Home</a>
                <a href="#">Students list</a>
            </nav>
        </header>
        <section class="students-section">
            <h2>All students</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>Example Address</td>
                        <td>Example City</td>
                        <td>example State</td>
                        <td>example@example.com</td>
                        <td>9009009009</td>
                        <td>
                            <button class="add-button">Add a new student</button>
                            <button class="edit-button">Edit</button>
                        </td>
                    </tr>
                    <!-- Mais linhas de estudantes aqui -->
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>