<?php

require_once "koneksi.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}





function getTodo()
{
    global $connect;
    $query = $connect->query("SELECT * FROM todo_list");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }

    if ($data) {
        $response = array(
            'meta' => [
                'status' => 200,
                'message' => 'Success'
            ],
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 404,
            'message' => 'No Data Found'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_todo_id()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }
    $query = "SELECT * FROM todo_list WHERE id= $id";
    $result = $connect->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    if ($data) {
        $response = array(
            'meta' => [
                'status' => 200,
                'message' => 'Success'
            ],
            'data' => $data
        );
    } else {
        $response = array(
            'status' => 404,
            'message' => 'No Data Found'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_todo()
{
    global $connect;
    // $check = array('id' => '', 'judul' => '', 'deskripsi' => '');
    // $check_match = count(array_intersect_key($_POST, $check));

    // var_dump($check);

    $result = mysqli_query($connect, "INSERT INTO todo_list SET
               id = '$_POST[id]',
               judul = '$_POST[judul]',
               deskripsi = '$_POST[deskripsi]'
               ");

    if ($result) {
        $response = array(
            'meta' => [
                'status' => 200,
                'message' => 'Success'
            ],
            'data' => $result
        );
    } else {
        $response = array(
            'meta' => [
                'status' => 500,
                'message' => 'Insert Failed.',
            ],
            'data' => $result
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_todo()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }
    // $check = array('id' => '', 'judul' => '', 'deskripsi' => '');
    // $check_match = count(array_intersect_key($_POST, $check));
    // var_dump($check_match);
    // if ($check_match == count($check)) {
    $result = mysqli_query($connect, "UPDATE todo_list SET
                judul = '$_POST[judul]',
                deskripsi = '$_POST[deskripsi]'
                WHERE id = $id");

    if ($result) {
        $response = array(
            'meta' => [
                'status' => 200,
                'message' => 'Update Success'
            ],
            'data' => $result
        );
    } else {
        $response = array(
            'meta' => [
                'status' => 500,
                'message' => 'Update Failed.',
            ],
            'data' => $result
        );
    }
    // } else {
    // $response = array(
    //     'meta' => [
    //         'status' => 500,
    //         'message' => 'Wrong Parameter'
    //     ],
    //     'data' => 'failed'

    // );
    // }    
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_todo()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }
    $result = mysqli_query($connect, "DELETE FROM todo_list WHERE id = $id");
    if ($result) {
        $response = array(
            'meta' => [
                'status' => 200,
                'message' => 'Delete Success'
            ], 'data' => $result
        );
    } else {
        $response = array(
            'meta' => [
                'status' => 500,
                'message' => 'Delete Failed.'
            ], 'data' => $result
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
