@echo off
echo ===================================================
echo      Lancement du serveur Natfwa9 (Port 8080)
echo ===================================================
echo.
echo Lancement du serveur Web PHP sur le port 8080...
echo.
echo ---------------------------------------------------
echo  OUVREZ CE LIEN DANS VOTRE NAVIGATEUR :
echo  http://localhost:8080/connexion.html
echo ---------------------------------------------------
echo.
echo Appuyez sur Ctrl+C pour arreter le serveur.
echo.

php -c "%~dp0php.ini" -S localhost:8080
pause
