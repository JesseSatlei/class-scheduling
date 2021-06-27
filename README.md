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