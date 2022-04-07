# Code Challenge: Ganho de Capital
## Stack do projeto
1. Linguagem: PHP 8.1 
   * Escolhi o PHP, pois é linguagem que mais trabalhei e tenho familiaridade para focar 100% na solução do desafio.
2. Infra: Docker
   * Escolhi essa ferramenta para facilitar na execução do projeto sem ter nenhuma dependência externa ou necessidade de instalação de algo além do Docker.
3. Testes: PHPUnit
   * Escolhi essa ferramenta, pois ela é usada para testes unitários e e2e no PHP, também tenho mais familiaridade com ela.
   
## Arquitetura
Segui a abordagem do `DDD` para design da aplicação, separei todas as responsabilidades do domínio em `Entidades` e `Serviços`.
De acordo com as regras de negócio descritas no documento, cada processo tem seu serviço e internamente suas regras.

## Para rodar o projeto será necessário:

1. Baixar o projeto.
2. Rodar o comando `make install` dentro do diretorio do projeto para subir o container da aplicação e instalar as dependências.
3. Agora vamos rodar o comando `make run` para testes manuais. 

## Estrutura de exemplo:
* Entrada
``` json
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":2.00, "quantity": 5000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":25.00, "quantity": 1000}]
```
* Saída
``` json
[{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 3000}]
```

## Testes unitários
1. Para rodar todos testes unitários rode o comando `make phpunit`
2. Caso queira filtrar por algum específico, pegue o nome do arquivo sem a extensão `.php` e rode com o comando `make php-filter NomeDaClasse`