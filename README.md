# banco-capgemini-back

Estrutura

> /var/www/html
>
>banco-capgemini
>
>back
>
>front 

- Criar uma pasta www/html/banco-capgemini
    >  mkdir /var/www/html/banco-capgemini
                                                
- Dentro da pasta criada a cima, clonar o repositório back-end
    > git clone https://github.com/marcospmsantos/banco-capgemini-back.git back
                                                                 
- Entrar na pasta <strong>back</strong>
    > cd /var/www/html/banco-capgemini/back
                  
- Instalar as dependências                  
    > composer install

- Criar um arquivo .env & ajustar user e password
    > sudo cp .env.example .env && sudo chmod 777 -R .env

- Criar arquivo do banco de dados com o seguinte comando:
    >  sudo touch database/capgemini.sqlite && sudo chmod 777 -R database/capgemini.sqlite
                          
- Rodar as migrations e seeds                           
    >  php artisan migrate && php artisan migrate:refresh --seed
                                                                              
- Gerar a key da aplicação
    > php artisan key:generate                                                             

- Instalar o passport do Laravel                                                   
    > php artisan passport:install

- Rodar o servidor
    > php artisan serve
