# 📝 Instruções de Instalação - Sistema Studio de Unhas

## ✅ Pré-requisitos

Antes de começar, certifique-se de ter instalado:
- **WAMP/XAMPP** (ou outro servidor local com PHP 8.1+ e MySQL)
- **Composer** - Gerenciador de dependências PHP
- **Git** (opcional, mas recomendado)

## 🚀 Passo a Passo para Instalação

### 1️⃣ Instalar o Composer (se ainda não tiver)

Baixe e instale o Composer de: https://getcomposer.org/download/

Verifique a instalação:
```bash
composer --version
```

### 2️⃣ Configurar o Banco de Dados

1. Abra o **phpMyAdmin** (geralmente em http://localhost/phpmyadmin)
2. Crie um novo banco de dados:
   - Clique em "Novo"
   - Nome: `studio_unhas`
   - Collation: `utf8mb4_unicode_ci`
   - Clique em "Criar"

### 3️⃣ Instalar Dependências do Laravel

Abra o **PowerShell** ou **CMD** como Administrador e navegue até a pasta do projeto:

```bash
cd C:\wamp\www\Studio
```

Instale as dependências do Composer:
```bash
composer install
```

**Nota**: Este processo pode demorar alguns minutos na primeira vez.

### 4️⃣ Configurar o Arquivo de Ambiente

O arquivo `.env` já está criado. Verifique se as configurações do banco de dados estão corretas:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studio_unhas
DB_USERNAME=root
DB_PASSWORD=
```

**Importante**: Se o seu MySQL tiver senha, adicione-a em `DB_PASSWORD`

### 5️⃣ Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

Isso irá gerar automaticamente uma chave única para sua aplicação no arquivo `.env`.

### 6️⃣ Executar as Migrations (Criar Tabelas)

```bash
php artisan migrate
```

Esse comando irá criar todas as tabelas necessárias no banco de dados:
- users (usuários)
- services (serviços)
- appointments (agendamentos)
- stock (estoque)
- cashflow (fluxo de caixa)
- sessions (sessões)

### 7️⃣ Popular o Banco com Dados Iniciais

```bash
php artisan db:seed
```

Isso irá adicionar:
- 2 usuários (1 admin e 1 cliente)
- 10 serviços (manicure, pedicure, alongamentos, etc.)
- 15 produtos em estoque

### 8️⃣ Iniciar o Servidor

```bash
php artisan serve
```

O servidor será iniciado em: **http://localhost:8000**

## 🔑 Credenciais de Acesso

### Administrador
- **URL**: http://localhost:8000/login
- **Email**: admin@studiounhas.com
- **Senha**: admin123

### Cliente de Teste
- **Email**: maria@example.com
- **Senha**: senha123

## 🌐 Acessando o Sistema

- **Página Inicial (Pública)**: http://localhost:8000
- **Fazer Agendamento**: http://localhost:8000/agendar
- **Login**: http://localhost:8000/login
- **Painel Admin**: http://localhost:8000/admin (requer login de admin)

## 🔧 Possíveis Problemas e Soluções

### ❌ Erro: "No application encryption key has been specified"
**Solução**: Execute `php artisan key:generate`

### ❌ Erro: "SQLSTATE[HY000] [1049] Unknown database 'studio_unhas'"
**Solução**: Crie o banco de dados `studio_unhas` no phpMyAdmin

### ❌ Erro: "SQLSTATE[HY000] [2002] No connection could be made"
**Solução**: Certifique-se de que o MySQL está rodando no WAMP/XAMPP

### ❌ Erro: "Class 'PDO' not found"
**Solução**: Ative a extensão PDO no php.ini
- Abra o arquivo `php.ini`
- Remova o `;` antes de `extension=pdo_mysql`
- Reinicie o Apache

### ❌ Erro de Permissão (Permission denied)
**Solução Windows**: Execute o CMD/PowerShell como Administrador

**Solução Linux/Mac**:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### ❌ Página em branco ou erro 500
**Solução**: Verifique o arquivo de log em `storage/logs/laravel.log`

### ❌ Erro: "composer: command not found"
**Solução**: 
1. Baixe e instale o Composer de https://getcomposer.org
2. Reinicie o terminal/CMD
3. Verifique com `composer --version`

## 🔄 Comandos Úteis

### Limpar Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Recriar o Banco de Dados (CUIDADO: Apaga todos os dados!)
```bash
php artisan migrate:fresh --seed
```

### Ver Todas as Rotas
```bash
php artisan route:list
```

### Parar o Servidor
Pressione `Ctrl + C` no terminal onde o servidor está rodando

## 📊 Estrutura do Projeto

```
Studio/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controladores
│   │   └── Middleware/       # Middleware de autenticação
│   └── Models/               # Models do banco
├── config/                   # Arquivos de configuração
├── database/
│   ├── migrations/           # Estrutura do banco
│   └── seeders/              # Dados iniciais
├── public/                   # Arquivos públicos (CSS, JS, imagens)
├── resources/
│   └── views/                # Views Blade (HTML)
├── routes/
│   └── web.php               # Rotas do sistema
├── storage/                  # Cache, logs, sessões
└── .env                      # Configurações do ambiente
```

## 🎯 Próximos Passos

1. ✅ Faça login como administrador
2. ✅ Explore o painel administrativo
3. ✅ Cadastre novos serviços se necessário
4. ✅ Teste o sistema de agendamento
5. ✅ Experimente o controle de estoque
6. ✅ Use o fluxo de caixa

## 📞 Suporte

Se encontrar algum problema:

1. Verifique o arquivo de log: `storage/logs/laravel.log`
2. Certifique-se de que seguiu todos os passos
3. Verifique se o WAMP/XAMPP está rodando
4. Confirme que o banco de dados foi criado

## 🎨 Personalizações

Para personalizar o sistema:
- **Cores**: Edite as classes Tailwind nas views (pasta `resources/views`)
- **Logo**: Adicione sua logo e atualize o layout
- **Horários**: Modifique em `AppointmentController.php`
- **Dias de funcionamento**: Ajuste a validação no mesmo controller

---

✨ **Pronto!** Seu sistema está configurado e pronto para uso!




