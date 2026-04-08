# TP2 Symfony – Routage, Vues Dynamiques et Intégration de Templates

## Identification
- **Nom** : KUWONOU  
- **Prénom** : Enoch  
- **Projet** : SchoolPrepar  
- **TP** : TP2 (IT232)  

## 1) Objectifs du TP2 (rappel de l’énoncé)
Le TP2 demande de :
- Configurer le **routage Symfony** correctement.
- Créer des **contrôleurs organisés** (front-office et back-office).
- Utiliser **Twig** pour générer des vues dynamiques.
- Structurer l’application avec **deux interfaces distinctes** :
  - Front-office (utilisateurs/visiteurs)
  - Back-office (administration)
- Intégrer et adapter des templates d’interface.

## 2) Structure globale réalisée
Deux espaces de templates ont été mis en place :

### 2.1 Front-office (utilisateur)
Répertoire principal :
- `Schoolprepar/templates/front/`

Fichiers réalisés :
- **Layout** : `Schoolprepar/templates/front/base.html.twig`
- **Accueil** : `Schoolprepar/templates/front/home.html.twig`
- **Partials** :
  - `Schoolprepar/templates/front/partials/nav.html.twig`
  - `Schoolprepar/templates/front/partials/footer.html.twig`
- **Filières** :
  - `Schoolprepar/templates/front/filiere/index.html.twig`
  - `Schoolprepar/templates/front/filiere/show.html.twig`
- **Établissements** :
  - `Schoolprepar/templates/front/etablissement/index.html.twig`

### 2.2 Back-office (administration)
Répertoire principal :
- `Schoolprepar/templates/admin/`

Fichiers réalisés :
- **Layout** : `Schoolprepar/templates/admin/base.html.twig`
- **Dashboard** : `Schoolprepar/templates/admin/dashboard.html.twig`
- **Partials** :
  - `Schoolprepar/templates/admin/partials/nav.html.twig`
  - `Schoolprepar/templates/admin/partials/aside.html.twig`
  - `Schoolprepar/templates/admin/partials/footer.html.twig`
- **Gestion des filières** : `Schoolprepar/templates/admin/filiere/index.html.twig`
- **Gestion des établissements** : `Schoolprepar/templates/admin/etablissement/index.html.twig`

## 3) Routage et contrôleurs (exigence TP2)
Les routes sont gérées par **attributs** `#[Route]` dans les contrôleurs (convention Symfony 7).

### 3.1 Contrôleurs front-office
Fichiers :
- `Schoolprepar/src/Controller/HomeController.php`
- `Schoolprepar/src/Controller/FiliereController.php`
- `Schoolprepar/src/Controller/EtablissementController.php`

Routes réalisées :
- `/` → `HomeController` (accueil)
- `/filieres` → `FiliereController` (liste)
- `/filieres/{id}` → `FiliereController` (détail)
- `/etablissements` → `EtablissementController` (liste)

### 3.2 Contrôleurs back-office
Fichiers :
- `Schoolprepar/src/Controller/AdminDashboardController.php`
- `Schoolprepar/src/Controller/AdminFiliereController.php`
- `Schoolprepar/src/Controller/AdminEtablissementController.php`

Routes réalisées (minimum exigé) :
- `/admin` → Dashboard
- `/admin/filieres` → Liste filières
- `/admin/etablissements` → Liste établissements

## 4) Navigation (menus exigés)
### 4.1 Menu utilisateur (front)
Fichier :
- `Schoolprepar/templates/front/partials/nav.html.twig`

Liens présents :
- Accueil
- Filières
- Établissements

### 4.2 Menu admin (back)
Fichiers :
- `Schoolprepar/templates/admin/partials/nav.html.twig`
- `Schoolprepar/templates/admin/partials/aside.html.twig`

Liens présents :
- Dashboard
- Gestion des filières
- Gestion des établissements

## 5) Vues dynamiques Twig (exigence TP2)
Les vues utilisent des variables Twig (listes, détails, compteurs) passées depuis les contrôleurs.

Exemples de dynamisme :
- Boucles Twig `{% for %}` pour afficher listes de filières/établissements.
- Page détail filière avec établissements correspondants.
- Stats sur la page d’accueil (totaux).
- Recherche/tri/filtrage côté navigateur (JavaScript intégré dans les vues Twig).

Fichiers concernés :
- `Schoolprepar/templates/front/home.html.twig`
- `Schoolprepar/templates/front/filiere/index.html.twig`
- `Schoolprepar/templates/front/filiere/show.html.twig`
- `Schoolprepar/templates/front/etablissement/index.html.twig`
- `Schoolprepar/templates/admin/filiere/index.html.twig`
- `Schoolprepar/templates/admin/etablissement/index.html.twig`

## 6) Fonctionnalité “Orientation” (demande TP2 + amélioration)
Une option **Orientation** a été ajoutée sur le front :
- Sur la page d’accueil, l’utilisateur peut choisir une **orientation (filière)** et filtrer instantanément les établissements.

Fichier concerné :
- `Schoolprepar/templates/front/home.html.twig`

## 7) CRUD Admin Filière (ajouter / modifier / supprimer)
Pour aller au-delà du minimum demandé “préparer la gestion des contenus”, un module CRUD simple a été implémenté.

### 7.1 Fonctionnement
- L’admin peut :
  - **Ajouter** une filière
  - **Modifier** une filière
  - **Supprimer** une filière
- Les données sont stockées en **session** (démonstration TP2 sans base de données).

Fichiers concernés :
- `Schoolprepar/src/Controller/AdminFiliereController.php`
- `Schoolprepar/templates/admin/filiere/index.html.twig`
- `Schoolprepar/templates/admin/base.html.twig` (ajout style bouton danger)

Routes CRUD ajoutées :
- `GET  /admin/filieres` (liste)
- `GET  /admin/filieres/new` (form ajout)
- `POST /admin/filieres` (création)
- `GET  /admin/filieres/{id}/edit` (form modification)
- `POST /admin/filieres/{id}/edit` (mise à jour)
- `POST /admin/filieres/{id}/delete` (suppression)

## 8) Corrections techniques effectuées
### 8.1 Correction erreur session (`UndefinedMethodError`)
Une erreur 500 apparaissait car le code utilisait une méthode non disponible :
- `"$this->get('session')"`

Correction :
- Accès à la session via `RequestStack` :
  - `RequestStack->getCurrentRequest()?->getSession()`

Fichiers corrigés :
- `Schoolprepar/src/Controller/HomeController.php`
- `Schoolprepar/src/Controller/FiliereController.php`
- `Schoolprepar/src/Controller/EtablissementController.php`
- `Schoolprepar/src/Controller/AdminFiliereController.php`

## 9) Installation / exécution
### Prérequis
- PHP 8.2+
- Composer

### Lancer le projet
Depuis le dossier :
- `KUWONOU_ENOCH_GL_2025_2026_TP1_IT232/Schoolprepar/`

Commandes :
- `composer install`
- Configurer `.env` si besoin
- Lancer le serveur :
  - `php -S 127.0.0.1:8000 -t public`
  - ou `symfony serve` (si Symfony CLI installé)

### Vérifier les routes
- `php bin/console debug:router`

## 10) Checklist “normes TP2”
- [x] Deux interfaces distinctes (front / admin)
- [x] Layouts séparés (`front/base.html.twig`, `admin/base.html.twig`)
- [x] Routes fonctionnelles (front + admin)
- [x] Contrôleurs séparés (front + admin)
- [x] Vues Twig dynamiques (listes + détail)
- [x] Navigation conforme (menus front/admin)
- [x] Intégration de templates et adaptation (UI améliorée + cohérente)

