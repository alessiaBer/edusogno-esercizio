<?php
require_once __DIR__ . "/../Helpers/DB.php";
require_once __DIR__ . "/../Models/User.php";

$connection = DB::connect();
$users = User::all();

if(isset($_GET['key'])) {
    $event_id = $_GET['key'];
    $sql = "SELECT * FROM eventi WHERE id = $event_id";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();

        if($result && $result->num_rows > 0) {
            // var_dump($result);
            $event = mysqli_fetch_array($result);
        } else {
            DB::disconnect($connection);
            return false;
        }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- EXTERNAL BOOTSTRAP CSS CDN -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="my-3">
        <div>
            <h1 class="text-center">Modifica</h1>
        </div>
    </header>
    <main class="my-3">
        <div class="container">
            <form class="my-3" action="update.php?key=<?=$event_id?>" method="post">
            <div class="attendees">
                    <label for="attendees">Attendees</label>
                    <div class="d-flex gap-3 my-2">
                        <?php foreach ($users as $user) {?>
                            <div class="form-check">
                                <?php if (str_contains($event["attendees"], $user["email"])) {?>
<input class="form-check-input" type="checkbox" value="<?= $user["email"] ?>" id="<?= $user["email"] ?>" name="attendees[]" checked>
                                <?php } else { ?>
                                <input class="form-check-input" type="checkbox" value="<?= $user["email"] ?>" id="<?= $user["email"] ?>" name="attendees[]">
                                <?php } ?>
                                <label class="form-check-label" for="<?= $user["email"] ?>"><?= $user["email"] ?> </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nome_evento" class="form-label">Nome evento</label>
                    <input type="text" class="form-control" id="nome_evento" required name="nome_evento" value="<?= $event["nome_evento"]?>">
                </div>
                <div class="mb-3">
                    <label for="data_evento" class="form-label">Data evento</label>
                    <input type="datetime-local" class="form-control" id="data_evento" required name="data_evento" value="<?= $event["data_evento"]?>">                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Conferma</button>
                </div>
            </form>
        </div>
        <div class="big-circle">
            <svg width="180" height="358" viewBox="0 0 180 358" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="1" cy="179" r="179" fill="white" />
            </svg>
        </div>
        <div class="small-circle">
            <svg width="181" height="181" viewBox="0 0 181 181" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="90.5" cy="90.5" r="90.5" fill="white" />
            </svg>
        </div>
        <div class="white-wave">
            <svg width="1440" height="128" viewBox="0 0 1440 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M550.04 20.7802C309.334 -30.4323 58.3859 24.9498 -37 59.0424V152L1505.7 142.434C1506.68 130.171 1508.06 94.1161 1505.7 48.0053C1428.64 75.2303 850.923 84.7959 550.04 20.7802Z"
                    fill="white" />
            </svg>
        </div>
        <div class="light-wave">
            <img src="../assets/img/Vector 4.png" alt="">
        </div>
        <div class="dark-wave">
            <svg width="1440" height="226" viewBox="0 0 1440 226" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1333.21 30.8969C1794.82 -45.248 2276.07 37.0965 2459 87.7868V226L-499.505 211.778C-501.388 193.544 -504.023 139.936 -499.505 71.3763C-351.721 111.856 756.189 126.078 1333.21 30.8969Z"
                    fill="#B8CCE4" />
            </svg>
        </div>
        <div class="rocket">
            <svg width="111" height="185" viewBox="0 0 111 185" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M55.5 0L87.1099 63H23.8901L55.5 0Z" fill="white" />
                <rect x="24" y="63" width="63" height="96" fill="white" />
                <path d="M0 145.867L20 127V159.145L0 185V145.867Z" fill="white" />
                <path d="M111 145.867L91 127V159.145L111 185V145.867Z" fill="white" />
                <rect x="53" y="128" width="5" height="56" fill="white" />
                <circle cx="55.5" cy="102.5" r="14.5" fill="#D9E5F3" />
            </svg>
        </div>
    </main>
</body>
</html>