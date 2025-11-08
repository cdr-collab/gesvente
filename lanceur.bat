@echo off
title Lancement du projet Laravel + Vite
cd /d "C:\wamp\www\laravel_auth"

echo =======================================
echo   Démarrage du serveur WAMP...
echo =======================================
echo.

:: Lance WAMP si non démarré
start "" "C:\wamp\wampmanager.exe"
timeout /t 5 >nul

echo =======================================
echo   Lancement du serveur Laravel...
echo =======================================
echo.

:: Ouvre un terminal séparé pour le serveur Laravel
start cmd /k "cd /d C:\wamp\www\laravel_auth && php artisan serve"

echo =======================================
echo   Lancement du serveur Vite (npm run dev)...
echo =======================================
echo.

:: Ouvre un deuxième terminal séparé pour npm run dev
start cmd /k "cd /d C:\wamp\www\laravel_auth && npm run dev"

:: Attendre quelques secondes avant d'ouvrir le navigateur
timeout /t 5 >nul

echo =======================================
echo   Ouverture du navigateur...
echo =======================================
echo.

start http://127.0.0.1:8000

echo =======================================
echo   Tout est prêt ! Laravel + Vite sont actifs.
echo =======================================
pause
