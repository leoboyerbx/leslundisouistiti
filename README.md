# Les lundis ouistiti
Exercice symfony.

Plannification d'événements avec des invités qui candidatent pour l'être:
- Les admins planifient les événement
- Les utilisateurs peuvent déposer des candidatures sur des événements
- Les admins peuvent accepter ou rejeter une candidature à un événement

Autres fonctions:
- Système d'options globales (utilisé basiquement ici mais potentilellement extensible)
- Mot de passe oublié (mais nécessite un serveur mail fonctionnel)

## Mise en place
Installer les dépendances avec `composer install` puis charger les fixtures avec:
`php bin/console hautelook:fixtures:load`

Cela va remplir le site avec de la fausse donnée.

On peut ensuite se connecter avec les identifiants:
- Admin: `admin@admin.com`
- Utilisateur normal: `user@user.com`

Tous les mots de passe sont `pass`.

On peut aussi créer un compte.
