## Récupération et utilisation du projet

### Cloner le dépôt
La première étape étant de cloner le dépôt dans lequel vous retrouver le dossier du site web.

Exécutez la commande : 
```shell
git clone https://github.com/maximelarrieu/flockyou`
```

Très bien. Vous pouvez désormais vous rendre dans le dossier `/website`.

### Récupérer les packages et dépendances du projet
Pour pouvoir démarrer le serveur et tous les packages présent dans le projet, 
il faut d'abord effectuer quelques commandes d'installation.

Exécutez d'abord : *(récupération des packages et dépendances Symfony)*
```shell
composer install
```

puis : *(récupération de Webpack)*
```shell
yarn install
```

Parfait. Votre local possède tout le nécessaire pour lancer le projet.

### Démarrage du projet
#### Lancement du serveur
Selon la version Symfony installée sur votre machine, la commande sera peût-être différente. Si vous possédez la plus récente, exécutez :
```shell
symfony server:start
```

#### Lancement de Webpack
Pour terminer, il faut compiler les fichiers CSS et JS pour obtenir un beau rendu. J'ai prédéfini un alias pour cela.

Exécutez :
```shell
yarn css
```

---

### Bonne visite !