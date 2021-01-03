# Instabook : partage de photos avec des groupes d'amis. 

## Démarche
Je me suis servi de l'enregistrement de vos cours ainsi que de chaines youtubes pour avancer dans le projet.
J'ai également pas mal lu la doc 

## Difficultés rencontrés
J'ai eu des difficultés sur la connexion avec la base de données semble t'il. Ce que je ne comprends pas c'est que 
sur mes premières versions du projet ToDo je n'avais pas ce genre de problème, hors je n'ai rien changé à ma base de 
données. De plus j'ai suivie à la lettre toutes vos recommandations et celles de Stack.
J'ai bien vérifié, mon mot de passe et le nom de ma db utilisé dans PhpMyAdmin sont bien identiques à ceux 
présents dans mon .env.
Je vous joins si dessous le résultat obtenu après avoir lancé la commande : php artisan migrate

```bash
PS C:\xampp\htdocs\Ynov\Laravel\InstaBox\instabook> php artisan migrate
**************************************
*     Application In Production!     *
**************************************

 Do you really wish to run this command? (yes/no) [no]:
 > yes


   Illuminate\Database\QueryException

  SQLSTATE[HY000] [1045] Access denied for user 'forge'@'localhost' (using password: NO) (SQL: select * from information_schema.tables where table_schema = forge and table_name = migrations and table_type = 'BASE TABLE')

  at C:\xampp\htdocs\Ynov\Laravel\InstaBox\instabook\vendor\laravel\framework\src\Illuminate\Database\Connection.php:678
    674â–•         // If an exception occurs when attempting to run a query, we'll format the error
    675â–•         // message to include the bindings with SQL, which will make this exception a
    676â–•         // lot more helpful to the developer instead of just the database's errors.
    677â–•         catch (Exception $e) {
  âžœ 678â–•             throw new QueryException(
    679â–•                 $query, $this->prepareBindings($bindings), $e
    680â–•             );
    681â–•         }
    682â–•

  1   C:\xampp\htdocs\Ynov\Laravel\InstaBox\instabook\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70
      PDOException::("SQLSTATE[HY000] [1045] Access denied for user 'forge'@'localhost' (using password: NO)")

  2   C:\xampp\htdocs\Ynov\Laravel\InstaBox\instabook\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70
      PDO::__construct("mysql:host=127.0.0.1;port=3306;dbname=forge", "forge", "", [])
PS C:\xampp\htdocs\Ynov\Laravel\InstaBox\instabook>
```

## Solutions trouvées
Et bien j'ai essayé pas mal de solutions sur divers sites, sans grand succès, puis à la fin ça ressemblait plus à 
de la magie noire, mais pas plus de succès ... 
