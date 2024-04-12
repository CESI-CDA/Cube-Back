# 🚀 API Cube-BACK 🌐

### 📱 Une api qui fait le lien entre les utilisateurs et les ressources

Cette api, développée avec Laravel, est le fruit de l'appel à projet "PROJET RESOURCES RELATIONNELLES" de l'État. Elle vise à facilité le développement, la récupération et le stockage des données de nos applications.

### 🎯 Fonctionnalités à votre service

- **📝 Inscription**: Créez votre compte et rejoignez la communauté.
- **🔐 Authentification**: Connectez-vous en toute sécurité.
- **🔄 Modification**: Personnalisez votre profil à votre guise.
- **📤 Envoi et stockage**: Partagez et conservez vos ressources précieuses.
- **🔍 Affichage**: Explorez les ressources filtrées ou découvrez le lot.
- **⭐ Mise en favoris**: Marquez vos ressources préférées pour un accès rapide.
- **🗄️ Archivage**: Organisez vos ressources en archives pour une meilleure gestion.

### 📥 Installation

#### Prérequis

1. PHP.
2. Composer
3. Base de donnée MySQL.

### Étapes d'installation

1. Clonez ce dépôt : `git clone <lien du dépôt>`
2. Accédez au répertoire du projet : `cd nom-du-projet`
3. Installez les dépendances PHP via Composer : `composer install`
4. Copiez le fichier `.env.example` et renommez-le en `.env`
5. Générez une clé d'application Laravel : `php artisan key:generate`
6. Configurez votre base de données dans le fichier `.env`
7. Exécutez les migrations pour créer les tables de base de données : `php artisan migrate`
8. Exécutez les seeders pour créer des enregistrements en base de données : `php artisan db:seed`
9. Démarrez le serveur de développement : `php artisan serve`

### 🚀 Utilisation

#### Mode développeur

1. Lancez l'api et inscrivez vous ou connectez vous.
2. Grace à la génération d'un token, indiquez le dans votre Header.
3. Plongez dans l'univers de l'api ressources relationnelles !

#### Mode production

1. Rendez vous sur le lien https://projet-resources.fr/api/documentation.
2. Testez notre api !

### 👥 Auteur

- Antoine Cuvilliez
