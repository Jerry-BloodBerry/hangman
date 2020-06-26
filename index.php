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
    <div class="container">
        <div class="row justify-content-center my-2">
            <div class="col-10">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="card-header bg-dark my-c-header">
                            The Hangman
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">About the game</h5>
                            <p class="card-text">
                                This game was created as a project for my course in building Internet
                                services using the PHP language. It is a standard version of the well
                                known "Hangman" game in which you need to guess the letters of the alphabet
                                a piece of text contains before.. well. Before you hang. Please feel free
                                to create your free account and "learn the ropes".
                            </p>
                            <div class="row">
                                <div class="col-8 text-center">
                                    <img src="/img/hangman.png" class="img" style="height: 100%; width: 75%;" alt="hangman">
                                </div>
                                <div class="col-4">
                                    <a href="/register" class="btn btn-primary my-c-button">Create account</a>
                                    <a href="/play" class="btn btn-success my-c-button">Play the game</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once 'php/templates/footer/footer.php';
?>
