# README - Projet Symfony

## Clonage du projet
1. **Cloner le projet.**
2. S'assurer d'avoir PHP 8.2 ou une version ultérieure.
3. Installer curl: `sudo apt install curl`
4. Installer Symfony CLI:
```bash
   - `curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash`
   - `sudo apt install symfony-cli`
```

## Installer Composer
```bash
- `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
- `php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`
- `php composer-setup.php`
- `php -r "unlink('composer-setup.php');"`
- `php composer.phar install`
```

## Installer les dépendances supplémentaires

```bash
- `sudo apt-get install php-xml`
- `sudo apt-get install php-dom php-xml`
- `sudo apt-get install php-mbstring`
- `sudo apt-get install php-intl`
- `sudo apt-get install php-mysql`
```

## Vérifier les prérequis Symfony
Vérifier que votre système est prêt en utilisant la commande :
```bash
- `symfony check:requirements`
```

## Configuration initiale
```bash
1. Aller dans la racine du projet.
2. Exécuter la commande `composer install`.
```

## Création de la base de données et insertion de données de test
```bash
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`
- `php bin/console doctrine:fixtures:load`
```

## Lancement du serveur Symfony
Une fois tout configuré, lancez le serveur Symfony:
```bash
- `symfony server:start`
```

**Le site est maintenant prêt à être utilisé!**

### Fonctionnalités ajoutées depuis la soutenance
- Menu admin
- Routes sécurisées

### Informations supplémentaires
Pour faciliter vos tests, dans le jeu de données, il y a 3 utilisateurs déjà créés :
- Administrateur : admin@gmail.com et `password`
- Spectateur :spectateur@gmail.com et `password`
- Membre : membre@gmail.com et `password`

`password` est le mot de passe.