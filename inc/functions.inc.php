<?php

///////////////////////////// Fonction de débugage //////////////////////////

            function debug($var) {
                
                echo '<pre class="border border-dark bg-light text-primary w-50 p-3">';

                    var_dump($var);

                echo '</pre>';

            }
            session_start();

// Constante du serveur => localhost
define("DBHOST", "localhost");

// Constante de l'utilisateur de la BDD du serveur en local  => root
define("DBUSER", "root");

// Constante pour le mot de passe de serveur en local => pas de mot de passe
define("DBPASS", "");

// Constante pour le nom de la BDD
define("DBNAME", "ecommerce");

 // constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemin absolus à partir de localhost (on ne prend pas locahost). Ainsi nous écrivons tous les chemins (exp : src, href) en absolus avec cette constante.
define("RACINE_SITE", "/site-vente-maillot/");
            function alert(string $contenu, string $class)
            {
            
                return "<div class='alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5' role='alert'>
                    $contenu
            
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            
                    </div>";
            }
                function connexionBdd()
            {
            
                // Sans la variable $dsn et sans le constantes, on se connecte à la BDD :
            
                // $pdo = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');
            
                // avec la variable DSN (Data Source Name) et les constantes
            
                // $dsn = "mysql:host=localhost;dbname=cinema;charset=utf8";
            
                $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";
            
                try {
            
                    $pdo = new PDO($dsn, DBUSER, DBPASS);
            
                    // On définit le mode d'erreur de PDO sur Exception
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
            
                    die($e->getMessage());
                }
            
                return $pdo;
            }
            
            function createTableUsers() {

                $pdo = connexionBdd();
        
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id_user INT PRIMARY KEY AUTO_INCREMENT,
                    firstName VARCHAR(50) NOT NULL,
                    lastName VARCHAR(50) NOT NULL,
                    pseudo VARCHAR(50) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    mdp VARCHAR(255) NOT NULL,
                    phone VARCHAR(30) NOT NULL,
                    civility ENUM('f', 'h') NOT NULL,
                    birthday DATE NOT NULL,
                    address VARCHAR(50) NOT NULL,
                    zipCode VARCHAR(50) NOT NULL,
                    city VARCHAR(50) NOT NULL,
                    country VARCHAR(50) NOT NULL,
                    role ENUM('ROLE_USER', 'ROLE_ADMIN') DEFAULT 'ROLE_USER'
                )";
        
                $request = $pdo->exec($sql);
        
            }
        
            createTableUsers();     
    function inscriptionUsers(string $firstName, string $lastName, string $pseudo, string $email, string $mdp, string $phone, string $civility, string $birthday, string $address, string $zipCode, string $city, string $country) 
    : void {

        $pdo = connexionBdd(); // je stock ma connexion  à la BDD dans une variable

        $sql = "INSERT INTO users 
        (firstName, lastName, pseudo, email, mdp, phone, civility, birthday, address, zipCode, city, country)
        VALUES
        (:firstName, :lastName, :pseudo, :email, :mdp, :phone, :civility, :birthday, :address, :zipCode, :city, :country)"; // Requête d'insertion que je stock dans une variable
        $request = $pdo->prepare($sql); // Je prépare ma requête et je l'exécute
        $request->execute( 
            array(
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':mdp' => $mdp,
            ':phone' => $phone,
            ':civility' => $civility,
            ':birthday' => $birthday,
            ':address' => $address,
            ':zipCode' => $zipCode,
            ':city' => $city,
            ':country' => $country

        ));


    }
/////////pour recuperer tous les utilisateurs//////////////////////
    function allUsers() :array{
    $pdo=connexionBdd();
    $sql="SELECT* FROM users";
    $request = $pdo->query($sql);
    $result=$request->fetchAll();
    return $result;
    }
    

    ////////////////// Fonction pour vérifier si un email existe dans la BDD ///////////////////////////////

    function checkEmailUser(string $email) :mixed {
        $pdo = connexionBdd();
        $sql = "SELECT * FROM users WHERE email = :email";
        $request = $pdo->prepare($sql);
        $request->execute(array(
            ':email' => $email

        ));

        $resultat = $request->fetch();
        return $resultat;
    }
    function checkPseudoUser(string $pseudo)
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':pseudo' => $pseudo

    ));

    $resultat = $request->fetch();
    return $resultat;
}
    function checkUser(string $email, string $pseudo): mixed
{

    $pdo = connexionBdd();

    $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND email = :email";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':pseudo' => $pseudo,
        ':email' => $email


    ));
    $resultat = $request->fetch();
    return $resultat;
}

//  /////////////////Fonction pour récupérer tous les utilisateurs///////////////////




// /////////////////  Fonction pour recupereer un seul utilisateur  //////////////////////

function showUser(int $id): array
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM users WHERE id_user = :id_user";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':id_user' => $id

    ));
    $result = $request->fetch();
    return $result;
}
function createTableClub() {

    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS clubs (
        id_club INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        description TEXT NULL
    )";

    $request = $pdo->exec($sql);

}
createTableClub();


function createTablePays() {
    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS pays (
        id_pays INT PRIMARY KEY AUTO_INCREMENT,
        nom VARCHAR(100) NOT NULL
                
    )";

    try {
        $pdo->exec($sql);
    } catch (PDOException $e) {
        echo "Erreur lors de la création de la table pays : " . $e->getMessage();
    }
}

createTablePays();

function allClubs(){
    $pdo = connexionBdd();
    $sql = "SELECT * FROM clubs";
    $request = $pdo->query($sql);
    $resultat = $request->fetchAll();
    return $resultat;

}
function addClub(string $nameEquipe, string $description): void
{
    $pdo = connexionBdd();
    $sql = "INSERT INTO clubs (name,description) VALUES(:name,:description)";

    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':name' => $nameEquipe,
        ':description' => $description
    ));
}

//////////////////////////////////::
///   une function pour requmerer tous les categoryes ////


//////    Récouperer les film selon leur category  /////
function maillotByClubeId(int $id){
    $pdo = connexionBdd();
    $sql = "SELECT * FROM clubs WHERE club_id = :id";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    $resultat = $request->fetchAll();
    return $resultat;

}


function clubArray(string $string): array
{

    $array = explode(',', trim($string));
    return $array;
}

function updateRole(string $role, int $id): void
{
    $pdo = connexionBdd();
    $sql = "UPDATE users SET role = :role WHERE id_user = :id_user";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':role' => $role,
        ':id_user' => $id

    ));
}
    

function createTableMaillots() {
    $pdo = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS maillots (
        id_maillot INT PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(255) NOT NULL,
        club_id INT NOT NULL, 
        size VARCHAR(5) NULL,
        couleur VARCHAR(5) NULL,
        date DATE NOT NULL,
        price FLOAT NOT NULL,
        stock INT NOT NULL,
        description TEXT NOT NULL,
        pays_id INT NOT NULL, 

        FOREIGN KEY (pays_id) REFERENCES pays(id_pays),
        FOREIGN KEY (club_id) REFERENCES clubs(id_club)
    )";

    $pdo->exec($sql);


    
        $request = $pdo->exec($sql);
    }
    createTableMaillots();

function allMaillots(): array
{

    $pdo = connexionBdd();
    $sql = "SELECT maillots.* , clubs.name as club
    FROM maillots
    LEFT JOIN clubs ON maillots.club_id = clubs.id_club";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}
