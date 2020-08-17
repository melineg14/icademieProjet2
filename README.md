Veuillez trouver ci-dessous les commandes relatives à Docker :

Commandes de manière générale :
docker-compose ps: voir les containeurs actifs
docker-compose up -d: lancer les containers
docker-compose down: quitter les containers
docker exec -it -u dev sf4_php bash: se connecter au bash php (principal espace de travail)
docker exec -it -u dev sf4_mysql bash: se connecter au bash mysql


Pour exécuter l'application :
1) docker-compose up -d: lancer les containers
2) docker exec -it -u dev sf4_php bash: se connecter au bash php (principal espace de travail)
3) bien vérifier d'être dans le dossier sf4/
4) composer install && npm install
5) npm run build: compiler le css et le js avec webpack-encore