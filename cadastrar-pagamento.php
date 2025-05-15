<h1>Cadastrar Pagamento</h1>
<form action="?page=salvar-pagamento" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome</label>
		<input type="text" name="nome_paciente" class="form-control">
	</div>
	<div class="mb-3">
		<label>Credito </label>
		<input type="number" name="credito_pagamento" class="form-control">
	</div>
	<div class="mb-3">
		<label>Debito</label>
		<input type="number" name="debito_pagamento" class="form-control">
	</div>
	<div class="mb-3">
		<label>Pix</label>
		<input type="number" name="pix_pagamento" class="form-control">
	</div>
	<div class="mb-3">
		<label>CPF</label>
		<input type="text" name="cpf_pagamento" class="form-control">
	</div>
	<div class="mb-3">
		<label>Data de Pagamento</label>
		<input type="date" name="dt_nasc_paciente" class="form-control">
	</div>
	<div class="mb-3">
		<label>Sexo</label>
		<label><input type="radio" name="sexo_paciente" value="m"> Masculino</label>
		<label><input type="radio" name="sexo_paciente" value="f"> Feminino</label>
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-success">Salvar</button>
	</div>
</form>