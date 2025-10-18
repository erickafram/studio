@echo off
echo ========================================
echo   Configurando PHP Permanentemente
echo ========================================
echo.
echo IMPORTANTE: Execute este arquivo como ADMINISTRADOR!
echo (Clique com botao direito e "Executar como administrador")
echo.
pause

setx PATH "%PATH%;C:\wamp\bin\php\php8.2.26" /M

echo.
echo ========================================
echo   PHP configurado com sucesso!
echo ========================================
echo.
echo Agora voce pode usar 'php' em qualquer lugar!
echo Feche e abra o PowerShell novamente.
echo.
pause

