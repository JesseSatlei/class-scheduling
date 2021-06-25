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

./vendor/bin/sail up
./vendor/bin/sail artisan migrate

## Observações
- Para conseguir rodar o projeto não se esqueça de criar seu proprio .env e adicionar seus dados do banco de dados.
- O Sistema de Permissão não foi finalizado.
- Recomendo que seja criado primeiro um usuário administrador e em seguida criado os alunos e professores para depois criar alguma aula.