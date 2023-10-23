# <a></a>**Backend IP4Y**
Este é o backend API para o aplicativo IP4Y construído com Laravel. Ele usa MySQL como banco de dados.

## <a></a>**Requisitos**
- PHP >= 8.0
- MySQL
- Composer
## <a ></a>**Instalação**
1. Clone o repositório
2. Execute composer install
3. Copie .env.example para .env e atualize os valores de configuração
4. Execute php artisan key:generate
5. Execute php artisan migrate
6. Execute php artisan serve para iniciar o servidor de desenvolvimento
## <a></a>**Rotas da API**
### <a></a>Usuários
- GET api/users - Obter todos os usuários
- POST api/users - Criar um novo usuário
- GET api/users/{user} - Obter um usuário
- PUT api/users/{user} - Atualizar usuário
- DELETE api/users/{user} - Excluir usuário

- POST api/send-users - Envia lista de usuários em formato JSON para o link <a>https://api-teste.ip4y.com.br/cadastro</a>
## <a></a>**Variáveis de Ambiente**
O arquivo .env contém as variáveis de ambiente para configurar o aplicativo.

- APP\_NAME - Nome do aplicativo
- APP\_ENV - Ambiente do aplicativo (local, produção, etc)
- APP\_KEY - Chave do aplicativo
- APP\_URL - URL base do aplicativo
- DB\_CONNECTION - Conexão com banco de dados
- DB\_HOST - Host do banco de dados
- DB\_PORT - Porta do banco de dados
- DB\_DATABASE - Nome do banco de dados
- DB\_USERNAME - Usuário do banco de dados
- DB\_PASSWORD - Senha do banco de dados
##**Testando a API**
Você pode testar os endpoints da API usando o Postman ou qualquer outro cliente de API.

