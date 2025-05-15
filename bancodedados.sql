USE scc_clinico;

CREATE TABLE medico (
  id_medico INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome_medico VARCHAR(100) NULL,
  crm_medico VARCHAR(10) NULL,
  especialidade_medico VARCHAR(20) NULL,
  PRIMARY KEY(id_medico)
);

CREATE TABLE paciente (
  id_paciente INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome_paciente VARCHAR(100) NULL,
  dt_nasc_paciente DATE NULL,
  email_paciente VARCHAR(100) NULL,
  endereco_paciente VARCHAR(100) NULL,
  fone_paciente VARCHAR(20) NULL,
  cpf_paciente VARCHAR(14) NULL,
  sexo_paciente CHAR(1) NULL,
  PRIMARY KEY(id_paciente)
);

CREATE TABLE consulta (
  id_consulta INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  paciente_id_paciente INTEGER UNSIGNED NOT NULL,
  medico_id_medico INTEGER UNSIGNED NOT NULL,
  data_consulta DATE NULL,
  hora_consulta TIME NULL,
  descricao_consulta TEXT NULL,
  PRIMARY KEY(id_consulta),
  CONSTRAINT fk_consulta_medico FOREIGN KEY (medico_id_medico) REFERENCES medico(id_medico) ON DELETE CASCADE,
  CONSTRAINT fk_consulta_paciente FOREIGN KEY (paciente_id_paciente) REFERENCES paciente(id_paciente) ON DELETE CASCADE
);

CREATE TABLE pagamento (
  id_pagamento INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  consulta_id_consulta INTEGER UNSIGNED NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  metodo_pagamento ENUM('Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'Pix', 'Boleto') NOT NULL,
  data_pagamento DATE NOT NULL,
  status_pagamento ENUM('Pendente', 'Pago', 'Cancelado') NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY(id_pagamento),
  CONSTRAINT fk_pagamento_consulta FOREIGN KEY (consulta_id_consulta) REFERENCES consulta(id_consulta) ON DELETE CASCADE
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
