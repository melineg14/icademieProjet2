Commandes Docker basiques: 

docker-compose ps: voir les containeurs actifs
docker-compose up -d: lancer les containers en "detach"
docker exec -it -u dev sf4_php bash: se connecter au bash php (principal espace de travail)
docker exec -it -u dev sf4_mysql bash: se connecter au bash musql 
docker-compose down: quitter le container
