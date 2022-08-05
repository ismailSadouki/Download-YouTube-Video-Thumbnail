<?php
    if(isset($_POST['download'])) { // if download btn clicked
        $imgUrl = $_POST['imgurl']; // getting img url from hidden input
        $ch = curl_init($imgUrl); // initializing curl
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // it transfers data as the return value of curl_exec rather than outputting it directly
        $download = curl_exec($ch); // executing curl
        curl_close($ch);
        header('Content-type: image/jpg');
        header('Content-Desposition: attachment; filename="thumpnail.jpg"');
        echo $download;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Video Thumbnail | ISMAIL SADOUKI</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paste video url:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=kdjsfkj" required>
                <input type="hidden" class="hidden-input" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img src="" alt="" class="thumbnail">
            <i class="icon fas fa-cloud-download-alt"></i>
            <span>Paste Video url to see preview</span>
        </div>
        <button class="download-btn" type="submit" name="download">Download thumbnail</button>
    </form>

    <script>
        const urlField = document.querySelector(".field input"),
            previewArea = document.querySelector(".preview-area"),
            imgTag = previewArea.querySelector('.thumbnail');
            hiddenInput = document.querySelector(".hidden-input");

            urlField.onkeyup = () => {
                let imgUrl = urlField.value; // getting user entered value 
                previewArea.classList.add("active");

                if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) {
                    let vidId = imgUrl.split("v=")[1].substring(0, 11);
                    let ytThumUrl = `https://i.ytimg.com/vi/${vidId}/hqdefault.jpg` // passing entered url video id inside yt thumbnail url
                    imgTag.src = ytThumUrl;
                } else if (imgUrl.indexOf("https://youtu.be/") != -1) {
                    let vidId = imgUrl.split("be")[1].substring(0, 11);
                    let ytThumUrl = `https://i.ytimg.com/vi/${vidId}/hqdefault.jpg` // passing entered url video id inside yt thumbnail url
                    imgTag.src = ytThumUrl;
                } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) {
                    imgTag.src = imgUrl;
                } else {
                    imgTag.src = "";
                    previewArea.classList.remove("active");
                }
                hiddenInput.value = imgTag.src; //passing img src  
            }
    </script>
</body>
</html>