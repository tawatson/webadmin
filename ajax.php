<?php
session_start();
require "config.php";

use Cz\Git\GitRepository;
switch ($_SERVER['REQUEST_METHOD']) {
  case 'POST':

  switch ($_POST['action']) {
    case 'git_pull':
        // GET REPO INFO FROM DB
        $db->query("SELECT * from wa_repos WHERE id = :id");
        $db->bind(":id", $_POST['repo']);
        $repo = $db->single();

        // CREATE INSTANCE OF REPO CLASS
        $git = new Tawatson_gitHook($db, new GitRepository($repo['local_dir']),$repo['repo_name']);
        if($git->pull()){echo "1";};
        break;

    default:
      # code...
      break;
  }

    break;

    case 'REQUEST':
    $term=$_REQUEST["q"];
      $db->query("SELECT name FROM wa_clients WHERE name LIKE '%:term%'");
      $db->bind(":term", $term);
      $result = mysql_query($sql);

      $json=array();

      while($row = mysql_fetch_array($result)) {
        array_push($json, $row['fname']);
      }

      echo json_encode($json);

    break;
      break;

  default:
    // code...
    break;
}



 ?>
