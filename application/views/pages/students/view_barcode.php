<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .wrapper{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        div.b128 {
            border-left: 1px black solid;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="barcode">
            <span ><b>Name: <?php echo @$name ?></b></span>
            <?php echo $barcode ?>
        </div>
        <a id="canvasImage" href="">画像ダウンロード</a>
    </div>
    <script src="<?php echo base_url()."assets/plugins/html2canvas.min.js"; ?>"></script>
    <script>
        window.onload = function() {
            html2canvas(document.querySelector("#barcode")).then(canvas => {
                // document.querySelector("#barcode").style.display="none";
                // document.body.appendChild(canvas);
                document.getElementById('canvasImage').href = canvas.toDataURL()
                document.querySelector("#barcode").style.display="inline";
            })
        }
    </script>
</body>
</html>