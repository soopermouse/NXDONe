<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 25/09/2018
 * Time: 15:18
 */

?>

<!DOCTYPE HTML>
<head>
    <title>Home</title>
</head>

<body>
<h1>welcome</h1>
<p>Hello <?php echo htmlspecialchars($name);?></p>
<ul>
    <?php     foreach ($colours as $colour): ?>
   <li><?php echo htmlspecialchars($colour); ?></li>
    <?php endforeach;?>
</ul>
</body>


</html>
