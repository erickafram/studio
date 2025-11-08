#!/bin/bash

# Script de Deploy - Studio Unhas
# Execute: bash deploy.sh

echo "🚀 Iniciando deploy..."

# Backup do .env
echo "📦 Fazendo backup do .env..."
cp .env .env.backup.$(date +%Y%m%d_%H%M%S)

# Ativar modo de manutenção
echo "🔧 Ativando modo de manutenção..."
php artisan down

# Puxar atualizações do Git
echo "📥 Puxando atualizações do Git..."
git pull origin main

# Instalar/atualizar dependências
echo "📚 Atualizando dependências..."
composer install --optimize-autoloader --no-dev

# Rodar migrations
echo "🗄️ Executando migrations..."
php artisan migrate --force

# Limpar caches
echo "🧹 Limpando caches..."
php artisan optimize:clear

# Recriar caches
echo "⚡ Recriando caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ajustar permissões
echo "🔐 Ajustando permissões..."
chmod -R 775 storage bootstrap/cache

# Desativar modo de manutenção
echo "✅ Desativando modo de manutenção..."
php artisan up

echo "🎉 Deploy concluído com sucesso!"
echo "📝 Backup do .env salvo em: .env.backup.$(date +%Y%m%d_%H%M%S)"
