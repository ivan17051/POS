<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=, initial-scale=1.0">
 <title>Barcode</title>
</head>

<body>
 <div style="border:1px solid black;width:fit-content;">
  <svg id="barcode"></svg>
 </div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
 <script>
  JsBarcode("#barcode", '{{$kode}}');
 </script>
</body>

</html>