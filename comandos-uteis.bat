@echo off
set PATH=%PATH%;C:\wamp\bin\php\php8.2.26

:menu
cls
echo ========================================
echo   STUDIO DE UNHAS - Menu de Comandos
echo ========================================
echo.
echo 1. Iniciar Servidor
echo 2. Criar Tabelas do Banco (migrate)
echo 3. Criar Tabelas + Popular Dados (migrate:fresh --seed)
echo 4. Limpar Cache
echo 5. Ver Todas as Rotas
echo 6. Sair
echo.
echo ========================================
set /p opcao="Escolha uma opcao (1-6): "

if "%opcao%"=="1" goto iniciar
if "%opcao%"=="2" goto migrate
if "%opcao%"=="3" goto fresh
if "%opcao%"=="4" goto cache
if "%opcao%"=="5" goto rotas
if "%opcao%"=="6" goto sair

echo Opcao invalida!
pause
goto menu

:iniciar
echo.
echo Iniciando servidor...
echo Acesse: http://localhost:8000
echo Pressione Ctrl+C para parar
echo.
php artisan serve
pause
goto menu

:migrate
echo.
echo Criando tabelas do banco...
php artisan migrate
echo.
pause
goto menu

:fresh
echo.
echo ATENCAO: Isso vai APAGAR todos os dados!
set /p confirma="Tem certeza? (S/N): "
if /i "%confirma%"=="S" (
    php artisan migrate:fresh --seed
    echo.
    echo Tabelas criadas e dados inseridos!
) else (
    echo Operacao cancelada.
)
pause
goto menu

:cache
echo.
echo Limpando cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.
echo Cache limpo com sucesso!
pause
goto menu

:rotas
echo.
echo Listando todas as rotas...
echo.
php artisan route:list
echo.
pause
goto menu

:sair
exit




