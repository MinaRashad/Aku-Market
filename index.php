<?php
    include_once 'header.php'
?>
        <div>
            <h1>Listings</h1>
        </div>


<table border="1px solid">
<?php 
    require_once 'include/dbHandler.inc.php';

    $select = "SELECT users.username,listings.title, listings.description,(listings.price || listings.token) AS price, listings.posted_on
    FROM listings 
    LEFT JOIN users
    ON listings.userid = users.userid
    ORDER BY listings.posted_on DESC;";
    $stmt = $db->prepare($select);

    # Execute statement.
    $stmt->execute();

    # Get the results.
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($results[0]);
    echo "<tr>";

    ## PUT THE FIRST ROW

    for ($j=0; $j < count($keys); $j++) { 

        echo "<td>". htmlspecialchars(($keys[$j]) ?? '', ENT_QUOTES, 'UTF-8')."</td>";
    }
    ## PUT ALL LISTINGS OF USER IN A TABLE
    for ($i=0; $i < count($results); $i++) { 
        echo "<tr>";
        for ($j=0; $j < count($keys); $j++) { 

            echo "<td>". ($results[$i][$keys[$j]])."</td>";
        }
    }
    //print_r($results);
?>
</table>

        <script src="scripts/ENCRYPTO.js"></script>
        <script>

        </script>
    </body>
</html>