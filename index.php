<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Controle Clínico</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
        /* Corpo da página */
        body {
            background-color:rgb(245, 247, 248);
            font-family: Arial, sans-serif;
        }

        /* Navbar com cores neutras */
        .navbar {
            background-color:rgb(6, 184, 184);
        }
        .navbar-brand {
            color:rgb(10, 10, 10);
        }
        .navbar-nav .nav-link {
            color:rgb(15, 15, 15);
        }
        .navbar-nav .nav-link:hover {
            color: #ddd;
        }

        /* Barra de pesquisa */
        .form-control {
            border-radius: 20px;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
        }
        .btn-outline-success {
            background-color:rgb(243, 242, 245);
            border-radius: 20px;
            border-color:rgb(242, 242, 248);
            color: black;
        }
        .btn-outline-success:hover {
            background-color:rgb(38, 7, 175));
            border-color:rgb(38, 7, 175));
        }

        /* Botão de logout */
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
            border-radius: 20px;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        /* Container e conteúdo */
        .container {
            margin-top: 30px;
        }

        /* Home section - Título e descrição */
        .home-section {
            background: linear-gradient(45deg,rgb(234, 239, 243),rgb(56, 0, 161)); /* Gradiente de cinza para verde */
            color:rgb(5, 5, 5);
            padding: 50px 0;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			<img src="/img.clinica.jpg" alt="Imagem da clínica" width="500">
        }

        .home-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            animation: fadeIn 1s ease-in-out;
        }

        .home-section p {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .footer {
            text-align: center;
            font-size: 25px;
            margin-top: 22px;
            color: #777;
        }
    </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">SCC</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
	        </li>
	        
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Médicos
	          </a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" href="?page=cadastrar-medico">Cadastrar</a></li>
	            <li><a class="dropdown-item" href="?page=listar-medico">Listar</a></li>
	          </ul>
	    
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Pacientes
	          </a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" href="?page=cadastrar-paciente">Cadastrar</a></li>
	            <li><a class="dropdown-item" href="?page=listar-paciente">Listar</a></li>
	          </ul>
	        </li>

	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Consultas
	          </a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" href="?page=cadastrar-consulta">Cadastrar</a></li>
	            <li><a class="dropdown-item" href="?page=listar-consulta">Listar</a></li>
	          </ul>
	        </li>
			</li>
			 <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Pagamento
	          </a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" href="?page=cadastrar-pagamento">Cadastrar</a></li>
	            <li><a class="dropdown-item" href="?page=listar-pagamento">Listar</a></li>
	          </ul>
	        </li>
	         

	      </ul>
	      <form class="d-flex" role="search">
	        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
	        <button class="btn btn-outline-success" type="submit">Buscar</button>
	      </form>
		  <a class="btn btn-danger" href="logout.php">Logout</a>
	    </div>
	  </div>
	</nav>

	<div class="container">
		<div class="row mt-3">
			<div class="col">
				<?php
					// Conexão com o banco de dados
					include("config.php");
					
					switch (@$_REQUEST["page"]) {
						case 'cadastrar-medico':
							include('cadastrar-medico.php');
							break;
						case 'editar-medico':
							include('editar-medico.php');
							break;
						case 'listar-medico':
							include('listar-medico.php');
							break;
						case 'salvar-medico':
							include('salvar-medico.php');
							break;

						case 'cadastrar-paciente':
							include('cadastrar-paciente.php');
							break;
						case 'editar-paciente':
							include('editar-paciente.php');
							break;
						case 'listar-paciente':
							include('listar-paciente.php');
							break;
						case 'salvar-paciente':
							include('salvar-paciente.php');
							break;

						case 'cadastrar-consulta':
							include('cadastrar-consulta.php');
							break;
						case 'editar-consulta':
							include('editar-consulta.php');
							break;
						case 'listar-consulta':
							include('listar-consulta.php');
							break;
						case 'salvar-consulta':
							include('salvar-consulta.php');
							break;
					    case 'salvar-pagamento':
							include('salvar-pagamento.php');
							break;
						case 'editar-pagamento':
						    include('editar-pagamento.php');
		  				     break;
					    case 'cadastrar-pagamento':
					        include('cadastrar-pagamento.php');
							 break;
						default:
							include("home.php");

					
							
					}
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
