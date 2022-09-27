<?php
    session_start();

    if(isset($_SESSION['id']) && isset($_GET['listingid'])){
        require_once "../header.php";
        require_once "../include/dbHandler.inc.php";
        
        $select = "SELECT * FROM listings WHERE listing_id=? AND userid=?;";
        $stmt = $db->prepare($select);
        $stmt->execute(array($_GET['listingid'],$_SESSION['id']));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=null;
        if(!$result){
            header('location: ../my_listings.php');

        }
        $listing = $result[0];

    }else {
        header('location: ../index.php');
    }


?>
<h1>edit "<?php echo $listing['title'] ?>"</h1>
 <form id="editform" method="POST" action="/include/edit.inc.php">
    <table style="margin-bottom: 5vh;">
        <tr>
            <td>Title</td>
            <td><?php echo "<input type='text' name='title' value='".$listing['title']."'required>";?></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td>Category</td>
            <td><?php echo "    <input list='categories' name='category' onfocus='this.value=``' placeholder='category (one word)' value='".$listing['category']."'required>";?></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><?php echo "<input type='number' name='price' min='0' step='any' placeholder='price'  value='".$listing['price']."'required>";?></td>
            <td><?php echo "<input type='text' list='tokens' name='token' maxlength='5' placeholder='Token' style='width: 35%;' onfocus='this.value=``'  value='".$listing['token']."'required>";?></td>

        </tr>
        <tr>
    </table>
    <label>Description</label><br>
                <textarea name="description" style="width: 20vw;height:20vh; resize:none;" placeholder="Describe yourself here..."><?php echo $listing['description']; ?></textarea>
                
                <?php echo "<input type='hidden' name='listingid' value='".$listing['listing_id']."'required>";?>
    <datalist id="categories" size="3">
        <option value="electronics">electronics</option>
        <option value="Fasion">Fasion</option>
        <option value="DIY">DIY</option>
        <option value="Furniture">Furniture</option>
        <option value="Toys">Toys</option>
        <option value="Health">Health</option>
        <option value="Beauty">Beauty</option>
        <option value="Software">Software</option>
        <option value="Service">Service</option>
        <option value="Other">Other</option>
    </datalist>
    <datalist id="tokens" >
        <option value="BTC">Bitcoin</option>
        <option value="ETH">Etherium</option>
        <option value="USDT">Tether</option>
        <option value="BNB">Binance</option>
        <option value="LTC">Litecoin</option>
        <option value="CAKE">cake</option>
        <option value="MATIC">Matic</option>
        <option value="XMR">Menoro</option>
        <option value="$">Anything with the same value in USD</option>
    </datalist>
    <br>
    <input type="submit" name="sbmt_btn">
 </form>

 <span style="color:red;font-size:6vh;"><?php 

echo isset($_GET['error'])?'Error: '.$_GET["error"]:'';

?></span>

