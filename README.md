# Code Challenge: Ganho de Capital

## Indíce

Criar índice

## Sobre o Projeto

O objetivo deste projeto é implementar um programa de linha de comando (CLI) que calcula o imposto a ser pago sobre lucros ou prejuízos de operações no mercado financeiro de ações.

## Setup:

1. Baixar o projeto.
2. Rodar o comando `make install` dentro do diretorio do projeto para subir o container da aplicação e instalar as dependências.

## Rodando o projeto
Vc tem duas opções:
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

## Sobre o ambiente
Recursos/Depedência utilizado durante o desenvolvimento:

- `composer` -> Gerenciador de dependência e autoload.
- `phpunit` -> Usado para rodar os testes e gerar relatório do coverage.
- `ext-bcmath` -> Extensão para de funções matemáticas de precisão arbitrária 

### Comandos disponíveis
````bash
make install # Build da aplicação + Instalação das dependencias.
make run # Roda a aplicação usando input como entrada.
make run-file # Roda a aplicação usando arquivo como entrada utilizando input redirection.
make composer # Instala dependencias se for necessário.
make up # Sobe o container da aplicação.
make down # Derruba o container da aplicação.
make recreate # Faz o re-build da aplicação e instala as dependencias.
make phpunit # Roda os tests unitários e integrados gerando coverage.
make phpunit-filter # Roda os tests unitários e integrados usando filtro por arquivo.
make phpunit-coverage-html # Gera relatório de coverage do código na pasta coverage
make phpunit-coverage-text # Gera relatório de coverage direto no terminal
make bash # acessa o terminal do container
````

## Organização de pastas

```yml
src/ #-> Código fonte
  ├──Domain/ #-> Tudo referente ao dominio do sistemas, o motivo pelo qual foi criado.
  │     ├── Entities/... #-> Entidades do domain.
  │     ├── Enums/... #-> Enumeradores do domain.
  │     └── Services/
  │          ├──BuyStockCalculator.php #-> Calculo de compra.
  │          ├──SellCalculator.php #-> Calculo de venda.
  │          └──TransactionTaxesCalculator.php #-> Calcula a taxa baseado na operação.  
  │  Infrastructure/
  │     └── Commands/
  │          └── CapitalGains.php #-> Arquivo "porta de entrada" para a aplicação.

tests/ #-> Pasta com tudo relacionado aos Testes.
  ├──stubs/ #-> Casos de utilização propostos no desafio do 1 ao 8 (Usados nos testes).
  │    ├── input{1...8}.json #-> entrada de cada caso.
  │    └── output{1...8}.json #-> saída de cada caso.
  ├──Unit/ #-> Testes unitários.
  │    ├── Domain/ #-> Testes relacionados ao Dominio.
  │    └── BaseTest.php #-> Super classe base para todos os testes.

```