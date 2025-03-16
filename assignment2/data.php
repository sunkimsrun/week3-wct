<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// add, edit, delete
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "add" && isset($_GET['name']) && isset($_GET['age']) && isset($_GET['gender']) && isset($_GET['year'])) {
        $_SESSION['students'][] = [
            'name' => htmlspecialchars($_GET['name']),
            'age' => htmlspecialchars($_GET['age']),
            'gender' => htmlspecialchars($_GET['gender']),
            'year' => htmlspecialchars($_GET['year'])
        ];
    } elseif ($action == "delete" && isset($_GET['index'])) {
        $index = (int)$_GET['index'];
        if (isset($_SESSION['students'][$index])) {
            array_splice($_SESSION['students'], $index, 1);
        }
    } elseif ($action == "edit" && isset($_GET['index']) && isset($_GET['name']) && isset($_GET['age']) && isset($_GET['gender']) && isset($_GET['year'])) {
        $index = (int)$_GET['index'];
        if (isset($_SESSION['students'][$index])) {
            $_SESSION['students'][$index]['name'] = htmlspecialchars($_GET['name']);
            $_SESSION['students'][$index]['age'] = htmlspecialchars($_GET['age']);
            $_SESSION['students'][$index]['gender'] = htmlspecialchars($_GET['gender']);
            $_SESSION['students'][$index]['year'] = htmlspecialchars($_GET['year']);
        }
    }
}


//for response recieve data -> localhost:8000/data.php (raw json data here)
// Format response as required
$data = [
    'message' => 'Student data retrieved successfully',
    'students' => $_SESSION['students']
];

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
