# Webservice Empresa

### Como fazer para rodar o Webservice?

Primeiro configure o arquivo **.env** usando o **.env.example** como modelo, coloque os dados do seu banco.

Depois de configurado, é necessário rodar o seguinte comando:
```php
php artisan key:generate
```

Em seguida, iremos criar o banco de dados utilizando migrate:
```php
php artisan migrate
```

Agora é só rodar a aplicação:
```php
php artisan serve
```

### Rotas:

Para consultar todas as empresas, acesse a rota:
```
http://127.0.0.1:8000/api/empresa
```

Para consultar uma empresa específica, acesse a mesma rota, mas com o id da empresa:
```
http://127.0.0.1:8000/api/empresa/1
```

Para cadastrar uma empresa, acesse a rota:
```
http://127.0.0.1:8000/api/empresa/cadastro
```

É necessário preencher o body da requisição com json. Segue um exemplo:
```json
{
    "nome": "Patrícia e Caleb Telecom Ltda",
    "cep": "19905200",
    "numero": "803",
    "complemento": null,
}
```
*"O complemento é o único dado que pode ser nulo".*