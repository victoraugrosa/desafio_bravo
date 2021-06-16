# desafio_bravo

# Etapas para reproduzir a aplicação:

- Crie um banco de dados com MySQL com o nome "desafio_bravo". Para testes e desenvolvimento utilizei o Php MyAdmin junto ao docker do Laradock para simular ambiente servidor e administrar banco de dados;
- Tenha o Framework Laravel versão 5.8 ou posterior instalada;
- Para ver a aplicação sendo executada, utilizando o laradock, levantar os containers docker na raiz "/laradock" o comando "docker-compose up -d nginx mysql phpmyadmin"  para levantar os serviços e o servidor localhost, na porta 80, e acessar o Projeto de Api;
- Posteriormente para acessar o container do projeto laravel "docker container exec -it laradock_workspace_1 bash" e o comando "cd desafio_bravo";
- Depois de criado o banco de dados e adicionado as configurações ao ".env" do Laravel, executar o comando "php artisan migrate:refresh --seed" na raiz do projeto, para criar as tabelas através do migration do Laravel;
- Para popular as tabelas, utilizar o comando "php artisan db:seed --class=CurrenciesTableSeeder" para adicionar os registros de moedas;
- Pode ser acessado através da URL: http://localhost/api/;
- Pode ser acessado através da URL: http://localhost/docs/ a documentação, utilizando Swagger, criada a partir do Swagger-php (Figura abaixo);
- Projeto se encontra no github, na branch "Master";
#Qualquer dúvida estou a disposição.

![image](https://user-images.githubusercontent.com/37803927/122277540-6181c480-cebc-11eb-9fc0-f1351a185022.png)
