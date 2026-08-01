<?php
session_start();
include("conn.php");

$placa = $_GET["placa"] ?? null;
$cor_id = $_GET["cor"] ?? null;
$obs = $_GET["observacoes"] ?? null;
$id_usuario =  $_SESSION["usuario_id"] ?? 5;

if ($placa && $cor_id && $id_usuario) {
    $stmt = $conn->prepare("INSERT INTO estacionamento(placa,cor_id,observacoes,usuario_id) VALUES(?,?,?,?)");
    $stmt->bind_param("sisi", $placa, $cor_id, $obs, $id_usuario);

    if ($stmt->execute()) {
        header("location:index.php");
    } else {
        header("location:index.php?erro");
    }
}
