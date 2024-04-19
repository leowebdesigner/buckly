
### Passo a passo
Clone Repositório
```sh
git clone https://github.com/leowebdesigner/buckly.git
```
```sh
cd buckly
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Rodar as migrations
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)

Rode as factories 
```sh
php artisan tinker -- acesse o tinker para rodar 
\App\Models\Hotels::factory()->count(10)->create(); -- aqui você criará hotéis sem quartos
\App\Models\Rooms::factory()->count(10)->create(); -- aqui você criará quartos e hotéis já relacionados
\App\Models\User::factory()->count(10)->create(); -- aqui você criará usuários com senha padrão 12345

Todos os hoteís serão criados com endereço automático entre 3 ceps que deixei na factory usando a api VIACEP
```

Acesso ao phpmyAdmin - Banco de dados
```sh
http://localhost:8080/ 
usuário: username
senha: userpass
```
