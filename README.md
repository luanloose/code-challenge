# Code Challenge: Ganho de Capital

### Para rodar o projeto será necessário:

1. Baixar o projeto.
2. Rodar o comando `make install` dentro do diretorio do projeto para subir o container da aplicação e instalar as dependências.
4. Agora vamos rodar o comando `make run` para testes manuais.
5. Estrutura de exemplo:
Entrada
``` json
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":2.00, "quantity": 5000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":20.00, "quantity": 2000},{"operation":"sell", "unit-cost":25.00, "quantity": 1000}]
```
Saída
``` json
[{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 0},{"tax": 3000}]
```

### Testes unitários
1. Para rodar todos testes unitários rode o comando `make phpunit`
2. Caso queira filtrar por algum específico, pegue o nome do arquivo sem a extensão .php e rode com o comando `make php-filter NomeDaClasse`

### Stack do projeto
1. Linguagem: PHP 8.1
2. Infra: Docker
3. Testes: PHPUnit