<?php
require_once("Database.php");

class Funcionario
{
    private $id;
    private $nome;
    private $cargo;
    private $salario;
    private $idade;
    private $endereco;
    private $telefone;

    //Função responsável por buscar os dados de TODOS os funcionarios
    public function get_funcionarios()
    {

        $conn = createConnection();

        $sql = "SELECT id, nome, cargo, salario 
                FROM funcionario";

        $result = $conn->query($sql);

        $funcionarios = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $funcionarios[] = $row;
            }
        }

        $conn->close();
        return $funcionarios;
    }

    //Função responsável por buscar os dados de UM funcionário
    public function get_funcionario()
    {

        $conn = createConnection();

        $query = "SELECT * 
                  FROM funcionario 
                  JOIN perfil_funcionario 
                  ON funcionario.id = perfil_funcionario.id_funcionario 
                  WHERE funcionario.id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $conn->close();
        return $data;
    }

    public function insert_funcionario()
    {

        $conn = createConnection();

        //Validação de dados vazios ou em formatos inadequados lado servidor
        if (empty($this->nome) || empty($this->cargo) || !is_numeric($this->salario) || $this->salario <= 0) {
            return false;
        }

        $query = "INSERT INTO funcionario(nome, cargo, salario) 
                  VALUES(?, ?, ?)";

        $stmt = $conn->prepare($query);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssd", $this->nome, $this->cargo, $this->salario);
        $response = $stmt->execute();

        $this->id = $stmt->insert_id;

        $conn->close();
        return $response;
    }

    public function insert_perfil_funcionario()
    {

        $conn = createConnection();

        //Validação de dados vazios ou em formatos inadequados lado servidor
        if (empty($this->idade) || empty($this->endereco) || empty($this->telefone) || $this->idade < 0) {
            return false;
        }

        $query = "INSERT INTO perfil_funcionario(id_funcionario, idade, endereco, telefone) 
                  VALUES(?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("iiss", $this->id, $this->idade, $this->endereco, $this->telefone);
        $response = $stmt->execute();

        $conn->close();
        return $response;
    }

    //Faz o insert de AMBAS tabelas, caso alguma falhe irá dar um rollback e fechar a conexão (Evitar adicionar dados em apenas uma tabela)
    public function insert_funcionario_completo()
    {
        $conn = createConnection();
        $conn->begin_transaction();


        $insert_funcionario = $this->insert_funcionario();

        if (!$insert_funcionario) {
            $conn->rollback();
            $conn->close();
            return false;
        }

        $insert_perfil_funcionario = $this->insert_perfil_funcionario();

        if (!$insert_perfil_funcionario) {
            $conn->rollback();
            $conn->close();
            return false;
        }

        
        $conn->commit();
        $conn->close();
        return true;
    }



    public function update_funcionario()
    {

        $conn = createConnection();

        $query = "UPDATE funcionario 
                  SET nome = ?, cargo = ?, salario = ? 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdi", $this->nome, $this->cargo, $this->salario, $this->id);
        $response = $stmt->execute();

        $conn->close();
        return $response;
    }

    public function update_perfil_funcionario()
    {
        $conn = createConnection();

        $query = "UPDATE perfil_funcionario 
                  SET idade = ?, endereco = ?, telefone = ? 
                  WHERE id_funcionario = ?";

        $stmt = $conn->prepare($query);


        $stmt->bind_param("issi", $this->idade, $this->endereco, $this->telefone, $this->id);
        $response = $stmt->execute();


        $conn->close();

        return $response;
    }

    public function delete_funcionario()
    {

        $conn = createConnection();

        $query = "DELETE FROM funcionario 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $response = $stmt->execute();

        $conn->close();
        return $response;
    }

    public function delete_perfil_funcionario()
    {

        $conn = createConnection();

        $query = "DELETE FROM perfil_funcionario 
                  WHERE id_funcionario = ?";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("i", $this->id);
        $response = $stmt->execute();

        $conn->close();
        return $response;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }


}