<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");
include('connection.php');
$request_method = $_SERVER["REQUEST_METHOD"];
  switch($request_method)
  {
    case 'GET':
      if(!empty($_GET["id"]))
      {
        // Récupérer un seul book
        /* $id = intval($_GET["id"]);
        getBook($id); */
      }
      else
      {
        // Récupérer tous les books
        getArticles();
      }
      break;
    case 'POST':
    {
        if (isset($_POST['title']) && isset($_POST['descriptions']) && isset($_POST['published']))
        {
            addArticle();
        }
    }
    break;
    default:
      // Requête invalide
      header("aucune requete possible");
      break;
  }
  function getArticles()
  {
      global $con;
      $sql = "SELECT * FROM article";
      $result = mysqli_query($con,$sql); 
      $myArray = array();
      if (mysqli_num_rows($result) > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) {
              $myArray[] = array_map("utf8_encode", $row);
          }
          print json_encode($myArray);
      } 
      else 
      {
        print json_encode('aucun article pour le moment');
      }
  }

  function addArticle()
  {
    global $conn;
    $title = $_POST["title"];
    $descriptions = $_POST["description"];
    $published = $_POST["published"];

    $query="INSERT INTO article(descriptions,published,title) VALUES('".$descriptions."', '".$published."', '".$title."')";

    if(mysqli_query($conn, $query))
    {
        print json_encode('ajout effectué');
    }
  }
?>
  }
?>


