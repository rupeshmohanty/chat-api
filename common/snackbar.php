<?php
    if(isset($_GET['message'])){
        $message = $_GET['message'];
?>
    <div id="snackbar">
        <?=$message?>
    </div>
<?php
    }
?>