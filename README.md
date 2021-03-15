# Payment

Projeto que simula uma transferência entre dois usuários.

## Branches:

Segue uma breve descrição de cada uma das branches que utilizou-se durante a criação do projeto.

    PD-1: Docker configuration (Project structure: PHP)
    PD-2: Docker configuration (Database structure: MySQL)
    PD-3: Migrations, Seeders and Factories
    PD-4: Backend
    PD-5: Documentação (Swagger)

## Instalação:

    1. git clone git@github.com:GilbertoGiro/payment.git
    2. cd payment
    3. docker-compose up -d --build
    4. docker-compose logs -f app
    5. Aguarde até verificar que a task "===> Running supervisor" foi iniciada

Pronto! A aplicação já está disponível em [http://localhost](http://localhost)

## Referências interessantes:
* [Docker-Compose Wait](https://github.com/ufoscout/docker-compose-wait)
