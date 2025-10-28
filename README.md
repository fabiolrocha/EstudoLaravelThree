Projeto de um Simples CRM para colocar em pratica estudos sobre o Laravel

## Executar Localmente

1.  Clone o repositório: `git clone https://github.com/fabiolrocha/EstudoLaravelThree`
2.  Navegue até a pasta do projeto: `cd EstudoLaravelThree`
3.  Instale as dependências do Composer: `composer install`
4.  Instale as dependências do NPM: `npm install`
5.  Compile os assets: `npm run dev` (ou `npm run build` para produção)
6.  Copie o arquivo de ambiente: `cp .env.example .env`
7.  Gere a chave da aplicação: `php artisan key:generate`
8.  Configure as suas credenciais do banco de dados no arquivo `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
9.  Configure as suas credenciais de envio de email no `.env` (MAIL_MAILER, MAIL_HOST, etc. - use `MAIL_MAILER=log` para testes locais sem envio real).
10. Execute as migrations e os seeders: `php artisan migrate:fresh --seed`
11. Inicie o servidor de desenvolvimento: `php artisan serve`

**Utilizadores de Teste (Criados pelo Seeder):**
* Admin: Email> `admin@example.com` / Senha> `password`
* Manager: Email> `manager1@example.com` / Senha> `password`
* User: Email> `user@example.com` / Senha> `password`
* (Admin que Usei): Email> `fabiolrocha2013@gmail.com` / Senha> `rochafabio`