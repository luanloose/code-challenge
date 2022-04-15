# Code Challenge: Ganho de Capital
## Stack do projeto
1. Linguagem: PHP 8.1 
   * Linguagem que mais trabalhei e tenho familiaridade para focar 100% na solução do desafio.
2. Infra: Docker
   * Facilita na execução do projeto sem ter nenhuma dependência externa ou necessidade de instalação de algo além do Docker.
3. Testes: PHPUnit
   * Usada para testes unitários e e2e no PHP, também tenho mais familiaridade com ela.
   
## Arquitetura
Segui a abordagem do `DDD` (Domain Driven Design) para design da aplicação, separei todas as responsabilidades do domínio em `Entidades` e `Serviços`.
De acordo com as regras de negócio descritas no documento, cada processo tem seu serviço e internamente suas regras.

## Para rodar o projeto será necessário:

1. Baixar o projeto.
2. Rodar o comando `make install` dentro do diretorio do projeto para subir o container da aplicação e instalar as dependências.

Agora vc tem duas opções:
1. Rodar manualmente:
   * Rodar o comando `make run`.
   * Realizar o envio do input, abaixo deixo o exemplo que pode ser usado.
2. Rodar um arquivo com várias entradas
   * Rodar o comando `make run-file CaminhoDoArquivo`.
   * Realizar o envio do input, abaixo deixo o exemplo que pode ser usado.

### Exemplo da estrutura do input/output testes manuais:
* Entrada
``` json
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":2.00, "quantity": 5000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":25.00, "quantity": 1000}]
```
* Saída
``` json
[{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 3000}]
```
OBS: para sair da aplicação use `Control + C`

### Exemplo da estrutura do input/output testes com arquivo:
* Entrada
``` json
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"buy", "unit-cost":25.00, "quantity": 5000},{"operation":"sell", "unit-cost":15.00, "quantity": 10000},{"operation":"sell", "unit-cost":25.00, "quantity": 5000}]
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":2.00, "quantity": 5000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":25.00, "quantity": 1000}]
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":2.00, "quantity": 5000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":25.00, "quantity": 1000},{"operation":"buy", "unit-cost":20.00, "quantity": 10000},{"operation":"sell", "unit-cost":15.00, "quantity": 5000},{"operation":"sell", "unit-cost":30.00, "quantity": 4350},{"operation":"sell", "unit-cost":30.00, "quantity": 650}]
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":20.00, "quantity": 5000},{"operation":"sell", "unit-cost":5.00, "quantity": 5000}]
```
* Saída
``` json
[{"tax":0},{"tax":0},{"tax":0},{"tax":10000}]
[{"tax":0},{"tax":0},{"tax":0},{"tax":0},{"tax":3000}]
[{"tax":0},{"tax":0},{"tax":0},{"tax":0},{"tax":3000},{"tax":0},{"tax":0},{"tax":3700},{"tax":0}]
[{"tax":0},{"tax":10000},{"tax":0}]
```

## Testes unitários
1. Para rodar todos testes unitários rode o comando `make phpunit`
2. Caso queira filtrar por algum específico, pegue o nome do arquivo sem a extensão `.php` e rode com o comando `make php-filter NomeDaClasse`