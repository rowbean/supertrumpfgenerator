<?php
require_once('config.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Supertrumpf-Kartenspielgenerator</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <meta name="theme-color" content="#563d7c">
        <script type="text/javascript">
            document.write('<style type="text/css" media="screen">header{display: none;}</style>');
        </script>
    </head>
    <body>
        <header>
            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container d-flex justify-content-between">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-triangle mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/></svg>
                        <strong>You need to enable Javascript to use this generator!</strong>
                    </a>
                </div>
            </div>
        </header>
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <svg width="40" height="40" viewBox="0 0 16 16" class="bi bi-joystick" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M7.106 15.553L.553 12.276A1 1 0 0 1 0 11.382V9.471a1 1 0 0 1 .606-.89L6 6.269v1.088L1 9.5l5.658 2.83a3 3 0 0 0 2.684 0L15 9.5l-5-2.143V6.27l5.394 2.312a1 1 0 0 1 .606.89v1.911a1 1 0 0 1-.553.894l-6.553 3.277a2 2 0 0 1-1.788 0z"/><path fill-rule="evenodd" d="M7.5 9.5v-6h1v6h-1z"/><path d="M10 9.75c0 .414-.895.75-2 .75s-2-.336-2-.75S6.895 9 8 9s2 .336 2 .75zM10 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg>
                    <h1 class="jumbotron-heading">Supertrumpf-Kartenspielgenerator</h1>
                    <p class="lead text-muted">Create your own Top Trumps cardgame</p>
                </div>
            </section>
            <div class="album py-5 bg-light ">
                <div class="container">
                    <div class="row">
                        <form action="up.php" method="post" enctype="multipart/form-data" target="_blank">
                            <div class="form-group">
                                <div id="manual">
                                    <h5>Gameplay</h5>
                                    <p>
                                        All the cards are dealt among the players. There must be at least two players, and at least one card for each player. The starting player (normally the player to the dealer's left) selects a category from his or her topmost card and reads out its value. Each other player then reads out the value of the same category from their cards. The best (usually the largest, but in the case of a sports car's weight or a sprinter's 100m time, for instance, lower is considered better) value wins the "trick", and the winner takes all the cards of the trick and places them at the bottom of his or her pile. The winner then looks at her/his new topmost card, and chooses the category for the next round.
                                        In the event of a draw the cards are placed in the center and a new category is chosen from the next card by the same person as in the previous round. The winner of that round obtains all of the cards in the center as well as the top card from each player.
                                        Players are eliminated when they lose their last card, and the winner is the player who obtains the whole pack. Some variants of the rules allow 'three card pick', whereby a player who has only 3 cards remaining is allowed to choose any of their three cards to play with. Typically, this lengthens the game considerably.
                                        <span class="cite">Wikipedia contributors, "Top Trumps," Wikipedia, The Free Encyclopedia, https://en.wikipedia.org/w/index.php?title=Top_Trumps&oldid=963385282 (accessed June 30, 2020). </span>
                                    </p>

                                    <h5>Howto</h5>
                                    <p>
                                        To start creating your own card deck you need to provide an .jpg image(1) for every card, which should use the <a href="https://en.wikipedia.org/wiki/CMYK_color_model">CMYK color model</a>. We don't prevent uploading images in RGB color model, but the printing company needs to convert them, which will lead to a (slight) color shift.
                                        The images will be resized, but not distorted, to fit in the designated area.
                                    </p>
                                    <p>
                                        In the description area(2) you can add a name or description of your item. It can have <?=DESC_MINLENGTH." to ".DESC_MAXLENGTH?> characters.
                                    </p>
                                    <p>
                                        There can be up to <?=TITLE_MAXAMOUNT?> category names aka titles(3) and their attached values on a card, at a maximum of <?=DATASET_MAXLENGTH?> characters each.
                                    </p>
                                    <img src="img/tut_card.png" alt="tutorial sample card">
                                </div>
                            </div>
                            <div class="step" id="cardfields">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addColumn()"><svg class="bi bi-plus-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z"/></svg> Add Category</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="removeColumn()"><svg class="bi bi-dash-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4 7.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1H4z"/></svg> Remove Category</button>

                                <table id="cardgrid" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th><input type="text" class="form-control" placeholder="Title" maxlength="<?=TITLE_MAXLENGTH?>" required name="titles[]"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input name="imagefile[]" type="file" class="form-control" accept="image/jpeg" required onchange="validateFiletype(this)"></td>
                                            <td><input type="text" placeholder="Description" class="form-control" maxlength="<?=DESC_MAXLENGTH?>" required name="description[]"></td>
                                            <td><input type="text" class="form-control" placeholder="Dataset" maxlength="<?=DATASET_MAXLENGTH?>" required name="dataset[0][0]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" id="adddataset" class="btn btn-outline-secondary btn-sm" onclick="addDataset()" ><svg class="bi bi-plus-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z"/></svg> Add Dataset</button>
                                <button type="button" id="removedataset" class="btn btn-outline-secondary btn-sm" onclick="removeDataset();"><svg class="bi bi-dash-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4 7.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1H4z"/></svg> Remove Dataset</button>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Create cards" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">About</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b>This project was made for Coding Da Vinci Saar-Lor-Lux 2020.</b>
                        <p>The intention of this project is to give cultural institutions with a small budget the opportunity to create a ready-to-print card game with their artworks. </p>

                        <p>
                            A big thanks to the CDVSLL-Team for bringing an event like this to our region.
                            Also we'd like to thank the people of the printing company(Kern GmbH), who helped us verifying the print files and of course everyone who contributes to the open source software, we were using:
                        </p>
                        <ul>
                            <li><a href="https://tcpdf.org/">TCPDF</a></li>
                            <li><a href="https://www.setasign.com/products/fpdi/about/">FPDI</a></li>
                            <li><a href="https://getbootstrap.com/">Bootstrap</a></li>
                            <li><a href="https://jquery.com/">jQuery</a></li>
                            <li><a href="https://inkscape.org">Inkscape</a></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Back to top</a>
                </p>
                <p>Made for <a href="https://codingdavinci.de/events/saar-lor-lux/">#CDVSLL</a> - <a href="#" data-toggle="modal" data-target="#exampleModal">About this Project</a></p>
            </div>
        </footer>
        <script type="text/javascript">
            var title_maxamount=<?=TITLE_MAXAMOUNT?>;
            var title_minamount=<?=TITLE_MINAMOUNT?>;
            var title_maxlength=<?=TITLE_MAXLENGTH?>;
            var desc_maxlength=<?=DESC_MAXLENGTH?>;
            var dataset_minamount=<?=DATASET_MINAMOUNT?>;
            var dataset_maxlength=<?=DATASET_MAXLENGTH?>;
        </script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/cgg.js"></script>
    </body>
</html>