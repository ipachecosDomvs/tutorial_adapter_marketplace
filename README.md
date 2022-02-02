# Padrão Adapter - Exemplo de Projeto

### Conceito
Um marketplace online que apresenta os produtos de 2 lojas.

Cada loja possui um banco de dados e API (simulados) próprios e o formato retornado não é uniforme.

A página inical do marketplace apresenta os produtos de apenas uma das lojas por vez, alterando a loja apresentada com frequência.

### Motivação
O padrão Adapter pode ser utilizado para facilitar a alteração da loja apresentada na tela inicial ao converter o conteúdo das lojas para um formato padrão já definido.

### Inicialização
#### Instalando as dependências do projeto
Executar `composer install` na pasta do projeto (dentro do diretório _tutorial_marketplace_adapter_).

#### Configuração das variáveis de ambiente
Por questões de segurança, não é recomendado que as variáveis de ambiente sejam armazenadas em repositórios remotos. 

Portanto, foi fornecido um arquivo .env.example na pasta do projeto, que possui a maior parte do conteúdo necessário.

Na pasta do projeto, renomear o arquivo _.env.example_ para _.env_

Desta forma, nossa variavel de ambiente `CURRENT_STORE`, pode ser visualizada pelo sistema.

#### Criando a _APP_KEY_
Para o funcionamento correto de um projeto em _Laravel_, a variável `APP_KEY` no arquivo _.env_ é necessária. 

Para gerar a `APP_KEY`, precisamos executar o comando `php artisan key:generate` na pasta do projeto.

#### Iniciando o servidor do marketplace
Executar `php artisan serve` dentro do diretório _tutorial_marketplace_adapter_.

Este comando inicializará um servidor no endereço http://localhost:8000/, caso deseje alterar a porta utilizada, execute o comando passando o parâmetro `--port=` , com o valor da porta desejada.

### Utilização
#### Utilizando o marketplace
O marketplace possui um único  _endpoint_, que deve ser acessado através de requisições _GET_.

**Página Inicial:** http://localhost:8000/api/products 

#### Alterando a loja na página inicial
A variável de ambiente `CURRENT_STORE`, contida no arquivo _.env_, armazena o número da loja cujos produtos serão apresentados na tela inicial do Marketplace. 

Para alterar a loja, basta modificar o valor armazenado pela variável pelo número correspondente à loja desejada.

Após a alteração, o _ProductsController_ do Marketplace se encarregará de chamar o _Adapter_ correspondente.
