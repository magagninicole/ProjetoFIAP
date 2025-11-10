# Sistema de Secretaria FIAP

## Objetivo

O **Sistema de Secretaria FIAP** foi desenvolvido para uso administrativo interno da universidade, com o objetivo de **facilitar o gerenciamento de alunos, turmas e matrículas**.  
---

## Funcionalidades

- **Login administrativo** com autenticação de credenciais.
- **Gerenciamento de Alunos** — cadastro, edição, listagem e remoção. 
- **Gerenciamento de Turmas** — criação e administração das turmas disponíveis.
- **Matrículas** — vinculação e desvinculação de alunos às turmas, visualização dos alunos cadastrados e disponíveis.
---


## Tecnologias Utilizadas

- PHP 8.4
- MySQL
- HTML, CSS e JavaScript
- Bootstrap 5

---

## Estrutura do Projeto

- `app/` — código-fonte da aplicação
  - `Controllers/` — controladores
  - `Models/` — modelos de dados
  - `Views/` — templates de interface
  - `Core/` — núcleo do sistema (roteamento, base de controller, model)
- `public/` — arquivos públicos
- `vendor/` — dependências do Composer
- `dump.sql` — backup do banco de dados para importação

---

## Instalação e testes
Em um ambiente convigurado PHP e MySQL (Xampp, Wampp, Docker e afins)
1. Clone este repositório.
2. Instale o composer através do comando `Composer install`
3. Importe o arquivo `dump.sql` no seu banco de dados.
4. Ajuste as variáveis de configuração do banco em `app/Config/Config.php` ou diretamente no arquivo `.env`.
5. Acesse o sistema pelo navegador com \nomeDaPasta `(ex: http://localhost/ProjetoFIAP/)`.

O sistema irá abrir a tela de login, use os dados abaixo para seu primeiro login.

---

## Acesso de Teste

Para fins de validação, o sistema vem com um **usuário padrão de testes**:

| Campo     | Valor             |
|-----------|-----------------|
| E-mail    | admin@fiap.com   |
| Senha     | 123456           |

> **Observação:** O sistema não permite senhas fracas. A senha acima foi criada apenas para fins de teste.

---

