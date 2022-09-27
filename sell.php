<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
        exit();
    }
    include_once 'header.php'
?>

<h1>
Add a listing
</h1>
<form id="sellform" method="POST" action="include/sell.inc.php">
    <input type="text" name="title" placeholder="title" maxlength="100" required><br>
    <input type="number" name='price' min="0" step="any" placeholder="price" required>
    <input type="text" list="tokens" name='token' maxlength="5" placeholder="Token" style="width: 15%;" onfocus="this.value=''" required><br>
    <input list="categories" name="category" onfocus="this.value=''" placeholder="category (one word)" required>
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
    <input name="sbmt_btn" type="submit">
</form>

<span style="color:red;font-size:6vh;"><?php 

echo isset($_GET['error'])?'Error: '.$_GET["error"]:'';

?></span>