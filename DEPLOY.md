# Guia de Deploy - Studio Unhas

## 1. Configuração no cPanel

### Criar Aplicação Laravel
1. Acesse cPanel > "Setup Node.js App" ou "Setup PHP App"
2. Selecione:
   - **Application**: Laravel 11
   - **PHP Version**: PHP 8.2 ou 8.3
   - **Domain**: seu domínio
   - **Site User**: crie um usuário

## 2. Upload dos Arquivos

### Via FTP/File Manager
1. Faça upload de TODOS os arquivos do projeto
2. Coloque na pasta da aplicação (geralmente `public_html` ou pasta específica)

### Via Git (Recomendado)
```bash
# No terminal SSH do cPanel
cd ~/public_html
git clone seu-repositorio.git .
```

## 3. Configuração do Banco de Dados

### No cPanel
1. Acesse "MySQL Databases"
2. Crie um novo banco de dados
3. Crie um usuário
4. Adicione o usuário ao banco com todas as permissões
5. Anote: nome do banco, usuário e senha

## 4. Configuração do .env

```bash
# Copie o arquivo de produção
cp .env.production .env

# Edite com suas credenciais
nano .env
```

**Altere:**
- `APP_URL`: seu domínio completo
- `DB_DATABASE`: nome do banco criado
- `DB_USERNAME`: usuário do banco
- `DB_PASSWORD`: senha do banco
- `MAIL_*`: configurações de email

## 5. Instalação de Dependências

```bash
# Instalar dependências do Composer
composer install --optimize-autoloader --no-dev

# Gerar chave da aplicação
php artisan key:generate

# Limpar e otimizar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 6. Executar Migrations e Seeds

```bash
# Rodar migrations
php artisan migrate --force

# Rodar seeds (criar usuário admin)
php artisan db:seed --force
```

## 7. Configurar Permissões

```bash
# Dar permissão de escrita
chmod -R 775 storage bootstrap/cache
chown -R usuario:usuario storage bootstrap/cache
```

## 8. Configurar Document Root

No cPanel, configure o Document Root para apontar para a pasta `public`:
- Exemplo: `/home/usuario/public_html/public`

## 9. Configurar .htaccess (se necessário)

O Laravel já vem com .htaccess na pasta public, mas verifique se está correto.

## 10. Testar a Aplicação

1. Acesse seu domínio
2. Teste o login: admin@studiounhas.com / admin123
3. Verifique todas as funcionalidades

## 11. Segurança Pós-Deploy

```bash
# Remover arquivos desnecessários
rm -rf tests
rm .env.production
rm DEPLOY.md

# Verificar permissões
chmod 644 .env
```

## 12. Configuração de Email (Opcional)

Se usar email do cPanel:
- MAIL_HOST: mail.seudominio.com.br
- MAIL_PORT: 587
- MAIL_USERNAME: seu email completo
- MAIL_PASSWORD: senha do email
- MAIL_ENCRYPTION: tls

## Troubleshooting

### Erro 500
- Verifique permissões do storage
- Verifique o .env
- Veja logs em: `storage/logs/laravel.log`

### Erro de Banco
- Verifique credenciais no .env
- Teste conexão no phpMyAdmin

### CSS/JS não carregam
- Rode: `php artisan storage:link`
- Verifique o APP_URL no .env

### Página em branco
- Ative debug temporariamente: `APP_DEBUG=true`
- Veja o erro
- Desative depois: `APP_DEBUG=false`

## Comandos Úteis

```bash
# Limpar todos os caches
php artisan optimize:clear

# Recriar caches
php artisan optimize

# Ver logs
tail -f storage/logs/laravel.log

# Rodar migrations fresh (CUIDADO: apaga dados!)
php artisan migrate:fresh --seed --force
```

## Credenciais Padrão

**Admin:**
- Email: admin@studiounhas.com
- Senha: admin123

**IMPORTANTE:** Altere a senha do admin após o primeiro login!

## Backup

Faça backup regular de:
- Banco de dados (via phpMyAdmin ou cPanel)
- Pasta storage/app (uploads)
- Arquivo .env
