# Fazer suas alterações
git add .
git commit -m "Descrição das alterações"
git push origin main


SERVIDOR PRODUÇÃO
cd /home/studiokauanyneres/htdocs/www.studiokauanyneres.online

# Fazer backup do .env antes do pull
cp .env .env.backup

# Puxar as atualizações
git pull origin main

# O .env não será alterado porque está no .gitignore

# Atualizar dependências se necessário
composer install --optimize-autoloader --no-dev

#RUN BUILD
npm run build

# Rodar migrations se houver
php artisan migrate --force

# Limpar e recriar cache
php artisan optimize:clear
php artisan optimize