-- criar tabela convite_time_usuario
-- Usuários do sistema
CREATE TABLE
    usuarios (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL,
        data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ativo BOOLEAN DEFAULT TRUE
    );

-- Perfis de usuário (admin, membro, etc)
CREATE TABLE
    perfis (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(50) NOT NULL
    );

-- Associação de usuários aos perfis
CREATE TABLE
    usuario_perfil (
        usuario_id INT,
        perfil_id INT,
        PRIMARY KEY (usuario_id, perfil_id),
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE,
        FOREIGN KEY (perfil_id) REFERENCES perfis (id) ON DELETE CASCADE
    );

-- Times
CREATE TABLE times (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_lider INT NOT NULL,
    FOREIGN KEY (id_lider) REFERENCES usuarios(id)
);

-- Associação de usuários aos times
CREATE TABLE
    usuario_time (
        usuario_id INT,
        time_id INT,
        papel ENUM ('membro','lider') DEFAULT 'membro',
        PRIMARY KEY (usuario_id, time_id),
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE,
        FOREIGN KEY (time_id) REFERENCES times (id) ON DELETE CASCADE
    );

-- Projetos
CREATE TABLE
    projetos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(150) NOT NULL,
        descricao TEXT,
        time_id INT,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (time_id) REFERENCES times (id) ON DELETE SET NULL
    );

-- Associação de usuários aos projetos
CREATE TABLE
    usuario_projeto (
        usuario_id INT,
        projeto_id INT,
        papel ENUM ('colaborador', 'responsavel') DEFAULT 'colaborador',
        PRIMARY KEY (usuario_id, projeto_id),
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE,
        FOREIGN KEY (projeto_id) REFERENCES projetos (id) ON DELETE CASCADE
    );

-- Tarefas
CREATE TABLE
    tarefas (
        id INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(150) NOT NULL,
        descricao TEXT,
        prioridade ENUM ('baixa', 'media', 'alta', 'urgente') DEFAULT 'media',
        status ENUM ('parado', 'em andamento', 'completo', 'teste') DEFAULT 'parado',
        data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        data_entrega DATE,
        projeto_id INT,
        criador_id INT,
        FOREIGN KEY (projeto_id) REFERENCES projetos (id) ON DELETE SET NULL,
        FOREIGN KEY (criador_id) REFERENCES usuarios (id) ON DELETE SET NULL
    );

-- Responsáveis por tarefas (muitos para muitos)
CREATE TABLE
    tarefa_responsavel (
        tarefa_id INT,
        usuario_id INT,
        PRIMARY KEY (tarefa_id, usuario_id),
        FOREIGN KEY (tarefa_id) REFERENCES tarefas (id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE
    );

-- Comentários nas tarefas
CREATE TABLE
    comentarios (
        id INT PRIMARY KEY AUTO_INCREMENT,
        tarefa_id INT,
        usuario_id INT,
        conteudo TEXT NOT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (tarefa_id) REFERENCES tarefas (id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE
    );

-- Histórico de mudanças da tarefa (logs)
CREATE TABLE
    historico_tarefa (
        id INT PRIMARY KEY AUTO_INCREMENT,
        tarefa_id INT,
        usuario_id INT,
        campo_alterado VARCHAR(100),
        valor_anterior TEXT,
        valor_novo TEXT,
        alterado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (tarefa_id) REFERENCES tarefas (id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE SET NULL
    );