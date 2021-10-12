## Detalhes do Projeto
O objetivo deste teste é conhecer suas habilidades em:
- PHP, Laravel, MySQL, HTML, CSS e JavaScript;
- Entendimento e análise dos requisitos;
- Modelagem de banco de dados;
- APIs REST;

## Tarefas
Criação do Banco de Dados (Usuários, Alunos, Professores, Aulas).
- Criação do sistema de permissão dos usuários para cada ação do
sistema.
- Criação de CRUD para Usuários, Alunos, Professores, Aulas.
- Criar sistema de Login para Usuários administradores, Alunos e
Professores.
- O Aluno pode solicitar participação em uma aula, essa participação
deverá ser exibida como notificação para o professor responsável, e o
mesmo deve aceitar ou recusar esse aluno na aula.
- Criação dos recursos de API Rest que possibilitem utilizar o sistema
através de um aplicativo externo.
- Utilizar Docker ou Sail (Laravel 8).
- Hospedar o projeto em serviço de sua preferência (AWS, DigitalOcean,
Heroku, etc).
- Utilizar Git para gerenciar o projeto.
- Deve ser utilizado o Composer para gerenciar as dependências da
aplicação.
- Crie um README com orientações para a instalação

## Observações

No sistema de permissão, o usuário administrador deve conseguir editar
a permissão para cada ação do sistema, para determinados níveis de
usuário(Professor, Aluno).
- O sistema de login, deve possibilitar o login e cadastro para todos os
níveis de usuário (Administrador, Aluno, Professor).
- Para o CRUD deve ser possível Criar, Listar, Editar e Visualizar esses
recursos através de um painel, de acordo com as respectivas permissões.
- O Painel de gerenciamento pode ser criado utilizando a tecnologia que
desejar para o Front-End.
- O Aluno pode: Visualizar as aulas e suas informações(Professor, matéria,
data, hora), se inscrever em uma aula, cancelar a participação em uma
aula.
- O Professor pode: Visualizar as aulas (Alunos, matéria, data, hora),
aceitar/rejeitar solicitação de novos alunos.
- O Administrador pode: Criar, editar, visualizar, excluir todos os recursos
(aulas, alunos, professores), alterar permissões.
- Caso o Aluno seja aceito em uma aula, deverá enviar uma notificação no
painel do mesmo para informar.
- Caso o Aluno seja recusado em uma aula, enviar notificação para o
mesmo informando o motivo da recusa.
- Para os recursos de API Rest, deverá ser desenvolvida seguindo o modelo
de autenticação padrão utilizando Passport. 

## Ferramentas para Rodar o projeto
- composer
- laravel
- node
- npm
- Apache e Mysql

## Comandos para rodar o projeto Linux
- (Caso não possua as ferramentas configuradas)
-- docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs

- ./vendor/bin/sail up -d
- ./vendor/bin/sail artisan migrate
- ./vendor/bin/sail artisan migrate:fresh --seed
- https://cogitare.press/tecnologia/um-guia-completo-para-o-laravel-sail

## Observações
- Crie o .env antes de utilizar o composer install e sail up
