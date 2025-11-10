<?php

namespace App\Services;
use App\Models\Aluno;

class ValidacoesService
{
    private array $erros = [];

    /**
     * Valida os dados do aluno
     *
     * @param array $dados
     * @return bool 
     */
    public function validar(array $dados): bool
    {
        $this->erros = []; 
        $this->validarNome($dados['nome_aluno'] ?? '');
        $this->validarDataNascimento($dados['data_nascimento'] ?? '');
        $this->validarCPF($dados['cpf_aluno'] ?? '');
        $this->validarCpfEmail($dados['cpf_aluno'] ?? '', $dados['email_aluno'] ?? '', $dados['id_aluno'] ?? null);
        $this->validarEmail($dados['email_aluno'] ?? '');
        $this->validarSenha($dados['id_aluno'] ?? 0, $dados['senha_aluno'] ?? '');

        return empty($this->erros);
    }


    /**
     * Array de erros na validação
     *
     */
    public function getErros(): array
    {
        return $this->erros;
    }


    /**
     * Valida se o CPF ou email já existem no banco
     * @param string $cpf
     * @param string $email
     * @param int|null $id
     *
     */
    private function validarCpfEmail($cpf, $email, $id = null)
    {
        $alunoModel = new Aluno();

        // Se $idAtual for fornecido, ignora este aluno, pois é atualização
        if ($alunoModel->existeCpfOuEmail($cpf, $email, $id)) {
            $this->erros[] = "Já existe um aluno cadastrado com este CPF ou e-mail.";
        }
    }

    /**
     * Valida o tamanho do campo nome
     * @param string $nome
     *
     */
    private function validarNome(string $nome)
    {
        if (empty($nome)) {
            $this->erros['nome_aluno'] = "O nome é obrigatório.";
        } elseif (mb_strlen($nome) < 3) {
            $this->erros['nome_aluno'] = "O nome deve ter pelo menos 3 caracteres.";
        }
    }

    
    /**
     * Valida formato da data de nascimento
     * @param string $data
     *
     */
    private function validarDataNascimento(string $data)
    {
        if (empty($data)) {
            $this->erros['data_nascimento'] = "A data de nascimento é obrigatória.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
            $this->erros['data_nascimento'] = "A data de nascimento deve estar no formato DD-MM-AAAA.";
        }
    }

    /**
    * Valida o formato do CPF
    *
    */
    private function validarCPF(string $cpf)
    {
        $cpfNumeros = preg_replace('/\D/', '', $cpf); 

        if (empty($cpfNumeros)) {
            $this->erros['cpf_aluno'] = "O CPF é obrigatório.";
        } elseif (strlen($cpfNumeros) !== 11) {
            $this->erros['cpf_aluno'] = "O CPF deve conter 11 números.";
        }
    }

    
    /**
    * Valida o email
    * @param string $email
    *
    */
    private function validarEmail(string $email)
    {
        if (empty($email)) {
            $this->erros['email_aluno'] = "O email é obrigatório.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->erros['email_aluno'] = "O email informado não é válido.";
        }
    }

      
    /**
    * Valida a senha
    * @param string $senha
    *
    */
    private function validarSenha(int $id, string $senha)
    {
        if(!empty($id) && empty($senha)) {
            return; // Não é obrigatório atualizar a senha
        }

        if (empty($senha)) {
            $this->erros['senha_aluno'] = "A senha é obrigatória.";
            return;
        }

        // Pelo menos 8 caracteres, letras maiúsculas, minúsculas, números e símbolos
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $senha)) {
            $this->erros['senha_aluno'] = "A senha deve ter no mínimo 8 caracteres, incluindo letras maiúsculas, minúsculas, números e símbolos.";
        }
    }
}
