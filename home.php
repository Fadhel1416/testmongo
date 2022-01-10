<?php
/*---------------------------------------------------------------*/
/*
    Titre : Statistiques de fréquentation d'un site                                                                      
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=71
    Auteur           : R@f                                                                                                
    Date édition     : 03 Oct 2004                                                                                        
    Date mise à jour : 19 Sept 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/?>

<?php
if(!defined('__CONFIG_INC_PHP__'))
{
  define('__CONFIG_INC_PHP__', 1);

  define ('MYSQL_HOST', 'localhost');
  define ('MYSQL_USER', 'root');
  define ('MYSQL_PASS', '');
  define ('MYSQL_BASE', 'testdb'); // base de données à utiliser
  define ('MYSQL_TABLE_STATS', 'stats'); // table des stats
  
  define ('COULEUR_TAB_1', '#EFEFEF'); // couleur 1 du tableau
  define ('COULEUR_TAB_2', '#DEE3E7'); // couleur 2 du tableau
  
  define ('MSG_JOUR', 'Journée du'); // Période (pour l'affichage journalier)
  define ('MSG_MOIS', 'Mois de'); // Période (pour l'affichage mensuel)
  define ('MSG_AN', 'Année'); // Période (pour l'affichage annuel)
  define ('DATE_SEPARATEUR', '/'); 
// Séparateur entre jours & mois et mois & an
  
  $MOIS = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet'
,
 'Août', 'Septembre',
 'Octobre', 'Novembre', 'Décembre');
}
?>

*************
Fichier funcs.php
*************
<?php
if(!defined('__FUNCS_PHP__'))
{
  define ('__FUNCS_PHP__', 1);
  
  // teste la validité d'une date
  function date_valide($date)
  {
    // si jour < 1 || $jour > 31
    if($date[0] < 1 || $date[0] > 31)
      return false;
      
    // si mois < 1 || $mois > 12
    if($date[1] < 1 || $date[1] > 12)
      return false;
      
    // si mois à 30 jour && jour == 31
    if(($date[1] == 4 || $date[1] == 6 || $date[1] == 9 || $date[1] == 11) && 
$date[0] == 31)
        return false;
    // si mois == février && jour > 28  
    else if($date[1] == 2 && $date[0] > 28)
    {
      // si jour > 29
      if($date[0] > 29)
        return false;
        
      // si !année bissextile
      if($date[2] % 100 == 0 || $date[2] % 4 != 0)
        return false;
    }
        
    return true;    
  }
  
  // passe une date de format quelconque en date de format jjmmaaa
  function post_dates(&$from, &$to)
  {
    // jours
    if(empty($from[0]))
      $from[0] = '00';
    if(empty($to[0]))
      $to[0] = '00';
      
    if(strlen($from[0]) == 1)
      $from[0] = '0' . $from[0];
      
    if(strlen($to[0]) == 1)
      $to[0] = '0' . $to[0];
      
    // mois
    if(empty($from[1]))
      $from[1] = '00';
    if(empty($to[1]))
      $to[1] = '00';
      
    if(strlen($from[1]) == 1)
      $from[1] = '0' . $from[1];
      
    if(strlen($to[1]) == 1)
      $to[1] = '0' . $to[1];
      
    // ans
    $len = strlen($from[2]);
    if($len < 4)
    {
      if($len == 2)
        $from[2] = $from[2] . '00';
      if($len == 3)
        $from[2] = $from[2] . '0';
    }
    
    $len = strlen($to[2]);
    if($len < 4)
    {
      if($len == 2)
        $to[2] = $to[2] . '00';
      if($len == 3)
        $to[2] = $to[2] . '0';
    }
      
    $from = $from[0] . $from[1] . $from[2];
    $to = $to[0] . $to[1] . $to[2];
  }
  
  // fonction qui rempli la table des stats
  function stats()
  {

     $conn = mysqli_connect(MYSQL_HOST,MYSQL_USER, MYSQL_PASS, MYSQL_BASE);


      
    // rcéupération des infos
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y-n-j');
    
    // deja un enregistrement pour cette ip et ce jour?
    $result = $conn->query("SELECT ip FROM " . MYSQL_TABLE_STATS .
" WHERE date_visite='$date' AND ip='$ip'");
    if(!$result)
      return 0;
    
    if($result->num_rows == 0)
    {
      $conn->query("INSERT INTO " . MYSQL_TABLE_STATS ." VALUES ('$ip', '$date')");

    }
    
    return 1;
  }
}
?>

*************
Fichier index.php
*************
<?php

// affichage du formulaire
if(!isset($_POST['aff']))
{
  stats();
  ?>
  <style>
  input {font-size: 13px;}
  div, span {font-size: 13px;}
  </style>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <br>
  <?php
  if(isset($_GET['from']) || isset($_GET['to']))
    echo 
'<span style="color: #FF0000;">Une des date que vous avez entré n\'est pas' .
' valide</span><br><br>';
  ?>
  
  <div style="position: relative; left: 20px;"> Du:  
    <input type="text" name="from[0]" maxlength="2" size="2" value="<?php if(
isset($_GET['from'])) echo substr($_GET['from'], 0, 2); ?>">
      /  
    <input type="text" name="from[1]" maxlength="2" size="2" value="<?php if(
isset($_GET['from'])) echo substr($_GET['from'], 2, 2); ?>">
      /  
    <input type="text" name="from[2]" maxlength="4" size="3" value="<?php if(
isset($_GET['from'])) echo substr($_GET['from'], 4, 4); ?>">
       au   
    <input type="text" name="to[0]" maxlength="2" size="2" value="<?php if(isset

($_GET['to'])) echo substr($_GET['to'], 0, 2); ?>">
      
    <input type="text" name="to[1]" maxlength="2" size="2" value="<?php if(isset

($_GET['to'])) echo substr($_GET['to'], 2, 2); ?>">
      
    <input type="text" name="to[2]" maxlength="4" size="3" value="<?php if(isset

($_GET['to'])) echo substr($_GET['to'], 4, 4); ?>">
      <br>
    <br>
    <input type="radio" name="aff" value="jour" checked>
    Affichage journalier<br>
    <input type="radio" name="aff" value="mois">
    Affichage mensuel<br>
    <input type="radio" name="aff" value="an">
    Affichage annuel<br>
  </div>
  
  <div style="position: relative; left: 50px;">
    <br><input type="submit" value="Voir les statistiques">
  </div>
  </form>
  <?php
}
else
{
  $aff = $_POST['aff'];
  $from = $_POST['from'];
  $to = $_POST['to'];
  
  // si année : 04 --> 2004
  if(strlen($from[2]) < 3)
    $from[2] = '20' . $from[2];
    
  // si année : 04 --> 2004
  if(strlen($to[2]) < 3)
      $to[2] = '20' . $to[2];
  
  // si une date n'est pas valide
  if(!date_valide($from) || !date_valide($to))
  {
    post_dates($from, $to);
    header("location: " . $_SERVER['PHP_SELF'] . '?from=' . $from . '&to=' . $to

);
    exit;
  }
  
$conn = mysqli_connect(MYSQL_HOST,MYSQL_USER, MYSQL_PASS, MYSQL_BASE);
  
  if($aff == 'jour')
    $sql_query = "SELECT date_visite, count(*) FROM " . MYSQL_TABLE_STATS . 
" WHERE date_visite >= '$from[2]-$from[1]-$from[0]' AND date_visite <" .
" '$to[2]-$to[1]-$to[0]' GROUP BY date_visite ORDER BY date_visite ASC";
  else if($aff == 'mois')
    $sql_query = "SELECT date_visite, count(*) FROM " . MYSQL_TABLE_STATS . 
" WHERE date_visite >= '$from[2]-$from[1]-$from[0]' AND date_visite <" .
" '$to[2]-$to[1]-$to[0]' GROUP BY MONTH(date_visite), YEAR(date_visite) ORDER" .
" BY date_visite ASC";
  else if($aff == 'an')
    $sql_query = "SELECT YEAR(date_visite), count(*) FROM " . MYSQL_TABLE_STATS 

. 
" WHERE date_visite >= '$from[2]-$from[1]-$from[0]' AND date_visite <" .
" '$to[2]-$to[1]-$to[0]' GROUP BY YEAR(date_visite) ORDER BY date_visite ASC";
    
  $result = $conn->query($sql_query);
  if(!$result)
  {
    echo 'Erreur lors de la récupération des résultats<br>';
    exit;
  }
  
  if($result->num_rows > 0)
  {
    echo 
"\r\n<table style=\"width: 100%;\" cellspacing=\"0\" cellspadding=\"0\">";
    echo 
"\r\n\t<tr><td style=\"width: 75%; background-color: #DEE3E7; padding-left:" .
" 10px;\"><span style=\"font-size: 14px; font-weight: bold;\">Période</span></"
 .
"td><td style=\"width: 25%; background-color: #DEE3E7;\"><span style=\"font-si" 
.
"ze: 14px; font-weight: bold;\">Nombre de visiteurs</span></td>";
  
    $color = 0;
    while($ret = mysqli_fetch_array($result))
    {
      $background_color = $color == 0 ? COULEUR_TAB_1 : COULEUR_TAB_2;
      
      echo "\r\n\t<tr>";
      if($aff == 'jour')
      {
        echo 
"\r\n\t\t<td style=\"background-color: $background_color; padding-left:" .
" 10px;\"><span style=\"font-size: 13px;\">";
        echo MSG_JOUR . ' ' .  substr($ret[0], 8, 2) . DATE_SEPARATEUR . substr(
$ret[0], 5, 2) . DATE_SEPARATEUR . substr($ret[0], 0, 4);
        echo '</span></td>';
        echo 
"\r\n\t\t<td style=\"background-color: $background_color;\"><span" .
" style=\"font-size: 13px;\">" . $ret[1] . '</span></td>';
      }
      else if($aff == 'mois')
      {
        echo 
"\r\n\t\t<td style=\"background-color: $background_color; padding-left:" .
" 10px;\"><span style=\"font-size: 13px;\">";
        echo MSG_MOIS . ' ' . $MOIS[substr($ret[0], 5, 2) - 1] . ' ' . substr(
$ret[0], 0, 4);
        echo '</span></td>';
        echo 
"\r\n\t\t<td style=\"background-color: $background_color;\"><span" .
" style=\"font-size: 13px;\">" . $ret[1] . '</span></td>';
      }
      else if($aff == 'an')
      {
        echo 
"\r\n\t\t<td style=\"background-color: $background_color; padding-left:" .
" 10px;\"><span style=\"font-size: 13px;\">";
        echo MSG_AN . ' ' . $ret[0];
        echo '</span></td>';
        echo 
"\r\n\t\t<td style=\"background-color: $background_color;\"><span" .
" style=\"font-size: 13px;\">" . $ret[1] . '</span></td>';
      }
      echo "\r\n\t</tr>";
      
      $color = $color == 0 ? 1 : 0;
    }
  
    echo "\r\n</table>";
  }
}
?>
