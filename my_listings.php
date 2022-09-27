<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location: /');
        exit();
    }
    include_once 'header.php';
?>
<h1>My Listings</h1>

<table border="1px solid">
<?php 
    
    $select = "SELECT * FROM listings WHERE userid = ? ORDER BY posted_on DESC;";
    $stmt = $db->prepare($select);
    
    # Execute statement.
    $stmt->execute(array($_SESSION['id']));

    # Get the results.
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        $keys = array_keys($results[0]);
        echo "<tr>";

        ## PUT THE FIRST ROW

        for ($j=2; $j < count($keys); $j++) { 

            echo "<td>". htmlspecialchars(($keys[$j]) ?? '', ENT_QUOTES, 'UTF-8')."</td>";
        }
        echo "<td>edit</td><td>Delete</td>";
        echo "</tr>";
        
        ## PUT ALL LISTINGS OF USER IN A TABLE
        for ($i=0; $i < count($results); $i++) { 
            echo "<tr>";
            for ($j=2; $j < count($keys); $j++) { 

                echo "<td>". ($results[$i][$keys[$j]])."</td>";
            }
            echo "<td><a href='listingaction/edit.php?listingid=".$results[$i]['listing_id']."'>edit</a></td>
                <td><a href='listingaction/delete.php?listingid=".$results[$i]['listing_id']."'>delete</a></td>";
            echo "</tr>";
        }
    }else {
        echo "<h3>You do not have any listings yet. Press \"Sell\" button on the top</h3>";
    }
    
    //print_r($results);
?>
</table>