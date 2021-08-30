<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title><?php echo "$artist_name - Albums" ?></title>
</head>

<body>
    <main class='container'>
        <h1><?php echo "Álbumes de $artist_name" ?></h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Título</th>
                    <th scope="col">Lanzamiento</th>
                    <th scope="col">Link</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($albums as $album) {
                    $img_url = $album["images"][0]["url"];
                    $name = $album['name'];
                    $release_date = $album['release_date'];
                    $album_url = $album['external_urls']['spotify'];
                    echo "<tr>
                <td><img class='album-img' src='$img_url'></th>
                <td>$name</td>
                <td>$release_date</td>
                <td><a href='$album_url'>Ver en Spotify</td>
            </tr>";
                } ?>
            </tbody>
        </table>
    </main>
</body>

</html>