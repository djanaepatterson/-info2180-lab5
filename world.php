<?php
$host ='localhost';
$username ='lab5_user';
$password ='password123';
$dbname ='world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) and isset($_GET['context'])== "cities"){
  $country = $_GET['country'];
  $context = $_GET['context'];
  $country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
  $stmt = $conn->query("SELECT countries.name, cities.* FROM countries JOIN cities ON code = country_code WHERE countries.name LIKE '%$country%';");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
}
else if(isset($_GET['country'])){
  $country = $_GET['country'];
  $context = "";
  $country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
?>
<?php if(strlen($country)>0 and strlen($context)>0):?>
  <caption><h2>CITY INFORMATON</h2></caption>
    <table>
      <tr>
        <th>NAME</th>
        <th>DISTRICT</th> 
        <th>POPULATION</th>
      </tr>
      <?php foreach($results as $row): ?>
        <tr>
          <td><?=$row['name'] ?></td>
          <td><?=$row['district'] ?></td>
          <td><?=$row['population'] ?></td>
        </tr>        
      <?php endforeach; ?>  
    </table> 
<?php endif; ?>      

<?php if(strlen($country)>0 and strlen($context) == 0): ?>
  <caption><h2>COUNTRY INFORMATON</h2></caption>
    <table>
      <tr>
        <th>NAME</th>
        <th>CONTINENT</th> 
        <th>INDEPENDENCE</th>
        <th>HEAD OF STATE</th>
      </tr>
      <?php foreach($results as $row): ?>
        <tr>
          <td><?=$row['name'] ?></td>
          <td><?=$row['continent'] ?></td>
          <td><?=$row['independence_year'] ?></td>
          <td><?=$row['head_of_state'] ?></td>
        </tr>        
      <?php endforeach; ?>  
    </table>  
<?php endif; ?>  

<?php if(strlen($country) == 0): ?>
  <?php $stmt = $conn->query("SELECT * FROM countries;"); ?>
  <?php $results = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
  <h4> ENTER A NAME FROM THE LIST BELOW <h4>
  <?php foreach($results as $row): ?>
      <li><?=$row['name'];?></li>
    <?php endforeach; ?>  
<?php endif; ?>     