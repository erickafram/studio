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

# Rodar migrations se houver
php artisan migrate --force

# Limpar e recriar cache
php artisan optimize:clear
php artisan optimize




## INSTALAÇÃO DO NODE.JS E NPM NO SERVIDOR

### 1. Verificar se já está instalado
```bash
node --version
npm --version
```

### 2. Instalar Node.js e NPM (se não estiver instalado)

**Opção A - Via NVM (Recomendado):**
```bash
# Instalar NVM
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

# Recarregar o terminal
source ~/.bashrc

# Instalar Node.js LTS
nvm install --lts
nvm use --lts
```

**Opção B - Via gerenciador de pacotes (Ubuntu/Debian):**
```bash
# Atualizar repositórios
sudo apt update

# Instalar Node.js e NPM
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Verificar instalação
node --version
npm --version
```

**Opção C - Via cPanel/Hospedagem compartilhada:**
- Acesse o painel de controle (cPanel)
- Procure por "Node.js" ou "Setup Node.js App"
- Selecione a versão LTS mais recente (18.x ou 20.x)
- Configure o diretório da aplicação


## DEPLOY NO SERVIDOR PRODUÇÃO

```bash
cd /home/studiokauanyneres/htdocs/www.studiokauanyneres.online

# Fazer backup do .env antes do pull
cp .env .env.backup

# Puxar as atualizações
git pull origin main

# O .env não será alterado porque está no .gitignore

# Atualizar dependências PHP
composer install --optimize-autoloader --no-dev

# NOVO: Instalar dependências NPM
npm install --production

# NOVO: Compilar assets (CSS/JS)
npm run build

# Rodar migrations se houver
php artisan migrate --force

# Limpar e recriar cache
php artisan optimize:clear
php artisan optimize
```


## COMANDOS NPM ÚTEIS

### Desenvolvimento Local
```bash
# Instalar todas as dependências
npm install

# Compilar assets para desenvolvimento (com watch)
npm run dev

# Compilar assets para produção (otimizado)
npm run build
```

### Solução de Problemas
```bash
# Limpar cache do NPM
npm cache clean --force

# Remover node_modules e reinstalar
rm -rf node_modules package-lock.json
npm install

# Verificar vulnerabilidades
npm audit

# Corrigir vulnerabilidades automaticamente
npm audit fix
```


## OBSERVAÇÕES IMPORTANTES

1. **Arquivos compilados**: Os arquivos em `public/build/` são gerados automaticamente pelo `npm run build` e NÃO devem ser commitados no Git (já estão no .gitignore).

2. **Ambiente de produção**: Sempre use `npm run build` no servidor, nunca `npm run dev`.

3. **Permissões**: Se tiver erro de permissão, pode precisar usar `sudo` ou ajustar as permissões:
   ```bash
   sudo chown -R $USER:$USER ~/.npm
   ```

4. **Memória**: Se o build falhar por falta de memória, aumente temporariamente:
   ```bash
   NODE_OPTIONS=--max_old_space_size=4096 npm run build
   ```

5. **Hospedagem compartilhada**: Alguns servidores compartilhados podem não ter Node.js. Nesse caso:
   - Compile localmente: `npm run build`
   - Faça commit dos arquivos em `public/build/`
   - Remova `public/build` do .gitignore temporariamente
