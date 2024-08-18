<?php
include 'includes/db.php';

// Verificar si el usuario es agente y si está logueado
if (isset($_SESSION['agente']) && $_SESSION['agente'] == true) {
}
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Agente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
      body {
        background-color: #f5f5f5;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">UTN Solutions Real Estate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="agente_dashboard.php">Panel de Agente</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <h1 class="display-4">Panel de Agente</h1>
      <p class="lead">Bienvenido al panel de agente.</p>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <h5 class="card-title">Agregar Propiedad</h5>
            <p class="card-text">Agregar una nueva propiedad a la base de datos.</p>
            <a href="agregar_propiedad.php" class="btn btn-primary">Ir</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <h5 class="card-title">Borrar Propiedad</h5>
            <p class="card-text">Eliminar una propiedad de la base de datos.</p>
            <a href="borrar_propiedad.php" class="btn btn-primary">Ir</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <h5 class="card-title">Ver Lista de Propiedades</h5>
            <p class="card-text">Ver la lista de propiedades en la base de datos.</p>
            <a href="lista_propiedades.php" class="btn btn-primary">Ir</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <h5 class="card-title">Personalizar la Página</h5>
            <p class="card-text">Editar la configuración de la página.</p>
            <a href="personalizar_pagina.php" class="btn btn-primary">Ir</a>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
 