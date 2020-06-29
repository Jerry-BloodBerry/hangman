<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login");
}
include_once __DIR__ . '/../templates/header/header.php';
?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-2 text-right">
                <h3>Score: <span id="score_container">120</span></h3>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-10">
                <div class="row">
                    <div class="col-6" id="keyboard-container">
                        <table class="table table-borderless table-sm" id="keyboard-table">
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-A" value="A">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-B" value="B">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-C" value="C">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-D" value="D">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-E" value="E">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-F" value="F">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-G" value="G">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-H" value="H">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-I" value="I">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-J" value="J">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-K" value="K">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-L" value="L">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-M" value="M">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-N" value="N">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-O" value="O">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-P" value="P">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-Q" value="Q">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-R" value="R">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-S" value="S">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-T" value="T">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-U" value="U">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-V" value="V">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-W" value="W">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-X" value="X">
                                    </td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-Y" value="Y">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="button" class="btn keyboard-button" id="button-Z" value="Z">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 text-center" id="hangman-container">
                        <img src="/img/hang0.png" id="hangman-img" alt="hangman">
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-10 text-center" id="words_container">
            </div>
        </div>
    </div>
    <div id="endGameModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="endGameModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pb-2">
                <h3 class="text-center my-2" id="end-game-title"></h3>
                <div class="modal-body text-center">
                    <img src="//placehold.it/1000x600" class="img-responsive" style="width: 100%" id="end-game-image" alt="Endgame image">
                    <button class="btn btn-success w-75 text-center mt-5" onclick="location.reload()">Play again</button>
                    <button class="btn btn-danger w-75 text-center my-2" onclick="window.location.href='/'">Quit game</button>
                </div>

            </div>
        </div>
    </div>
    <script src="/js/game-manager.js" type="text/javascript"></script>
<?php
include_once __DIR__ . '/../templates/footer/footer.php';
?>