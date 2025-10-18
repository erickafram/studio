# Sistema de Gerenciamento para Studio de Unhas

Sistema completo desenvolvido em Laravel 10 com MySQL e Tailwind CSS para gerenciamento de um Studio de Unhas.

## 🚀 Funcionalidades

### Área Pública
- **Página Inicial**: Exibição de todos os serviços disponíveis com descrição e preço
- **Sistema de Agendamento**: Cliente pode escolher serviço, data e horário disponível
- **Registro de Clientes**: Sistema de cadastro para clientes

### Painel Administrativo
- **Dashboard**: Visão geral com estatísticas e indicadores
  - Receita diária e mensal
  - Agendamentos do dia e próximos
  - Alertas de estoque baixo
  
- **Gerenciamento de Serviços**
  - Cadastrar, editar e excluir serviços
  - Definir preços e duração
  - Ativar/desativar serviços

- **Gerenciamento de Agendamentos**
  - Visualizar todos os agendamentos
  - Criar agendamentos manualmente
  - Alterar status (pendente, confirmado, concluído, cancelado)
  - Filtros por data e status

- **Controle de Estoque**
  - Cadastrar produtos
  - Controle de quantidade e estoque mínimo
  - Alertas de estoque baixo
  - Custo unitário dos produtos

- **Fluxo de Caixa**
  - Registro de entradas e saídas
  - Categorização de transações
  - Relatórios diário e mensal
  - Fechamento diário de caixa

## 📋 Requisitos

- PHP 8.1 ou superior
- MySQL 5.7 ou superior
- Composer
- Servidor Web (Apache/Nginx)

## 🔧 Instalação

1. **Clone o repositório ou navegue até a pasta do projeto**
```bash
cd C:\wamp\www\Studio
```

2. **Instale as dependências do Composer**
```bash
composer install
```

3. **Configure o arquivo de ambiente**
```bash
# Copie o arquivo .env.example para .env (se necessário)
# Edite o arquivo .env com as configurações do seu banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studio_unhas
DB_USERNAME=root
DB_PASSWORD=
```

4. **Gere a chave da aplicação**
```bash
php artisan key:generate
```

5. **Crie o banco de dados**
```sql
CREATE DATABASE studio_unhas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

6. **Execute as migrations**
```bash
php artisan migrate
```

7. **Popule o banco com dados iniciais**
```bash
php artisan db:seed
```

8. **Configure as permissões (se necessário)**
```bash
# No Windows com WAMP, geralmente não é necessário
# No Linux/Mac:
chmod -R 775 storage bootstrap/cache
```

9. **Inicie o servidor de desenvolvimento**
```bash
php artisan serve
```

10. **Acesse o sistema**
- Site: http://localhost:8000
- Admin: http://localhost:8000/admin

## 👤 Usuários Padrão

### Administrador
- **Email**: admin@studiounhas.com
- **Senha**: admin123

### Cliente de Teste
- **Email**: maria@example.com
- **Senha**: senha123

## 📊 Estrutura do Banco de Dados

### Tabelas Principais
- `users` - Usuários do sistema (admin e clientes)
- `services` - Serviços oferecidos
- `appointments` - Agendamentos
- `stock` - Controle de estoque
- `cashflow` - Fluxo de caixa

## 🎨 Design

O sistema utiliza **Tailwind CSS** via CDN para um design moderno, responsivo e intuitivo com:
- Esquema de cores rosa/pink como tema principal
- Interface limpa e profissional
- Totalmente responsivo para desktop e mobile
- Ícones Font Awesome para melhor UX

## 🔐 Segurança

- Autenticação nativa do Laravel
- Proteção de rotas com middleware
- Validação de formulários
- Proteção CSRF
- Senhas criptografadas com bcrypt

## 📱 Horário de Funcionamento

O sistema está configurado para:
- **Dias**: Segunda a Sábado
- **Horário**: 9h às 18h
- **Intervalo de agendamento**: 30 minutos

## 🛠️ Manutenção

### Limpeza de Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Backup do Banco de Dados
```bash
# Use ferramentas como mysqldump
mysqldump -u root -p studio_unhas > backup.sql
```

## 📝 Licença

Este projeto é de código aberto e está disponível sob a licença MIT.

## 👨‍💻 Suporte

Para dúvidas ou problemas:
- Verifique o arquivo de log em `storage/logs/laravel.log`
- Certifique-se de que todas as dependências estão instaladas
- Verifique as configurações do banco de dados no arquivo `.env`

## 🚀 Próximas Funcionalidades

- Sistema de notificações por email/SMS
- Relatórios mais detalhados
- Sistema de fidelidade para clientes
- Integração com pagamento online
- App mobile

---

Desenvolvido com ❤️ para Studio de Unhas





