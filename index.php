<?php
    include_once 'php/templates/header/header.php';
    if(isset($_SESSION['message']))
    {
        echo '
            <div class="alert alert-success" role="alert">' .
                $_SESSION['message'] .
            '</div>';
        unset($_SESSION['message']);
    }
?>

<?php
    include_once 'php/templates/footer/footer.php';
?>
