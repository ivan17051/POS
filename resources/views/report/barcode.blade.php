<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=, initial-scale=1.0">
 <title>Barcode</title>
 
 <style>
  .stc {
    background-color: #FFFFFF;
    left: 50px;
    right: 5px;
    height: 4cm;
    width: 7cm;
    font-family: "Lucida Sans";
    font-family: verdana, helvetica, arial, sans-serif;
    font-family: Tahoma;
    font-family: "Times New Roman", serif;
  }
 </style>
</head>

<body class="stc">

<table style="font-size: 8pt; border: solid; padding: 5px; width: 100%;">
            <tbody><tr style="align-content: center;">
                <td rowspan="6" style="width: 60%; text-align: center;"><img id="barcode" alt=""></td>
                <!-- <td style="font-weight: bold; text-align: center;">KPRI Sekda Prov Jatim</td> -->
            </tr>
            <tr>
                <!-- <td></td> -->
                <td style="font-weight: bold; text-align: center; padding: 2px; height: 3px;"></td>
            </tr>
            <tr>
                <!-- <td></td> -->
                <td style="font-weight: bold; text-align: center; background-color: #d2d2d2; padding: 2px; height: 17px;">1: Rp {{number_format($barang->harga_1)}}</td>
            </tr>
            <tr>
                <!-- <td></td> -->
                <td style="font-weight: bold; text-align: center; background-color: #d2d2d2; padding: 2px; height: 17px;">3: Rp {{number_format($barang->harga_3)}}</td>
            </tr>
            <tr>
                <!-- <td></td> -->
                <td style="font-weight: bold; text-align: center; background-color: #d2d2d2; padding: 2px; height: 17px;">6: Rp {{number_format($barang->harga_6)}}</td>
            </tr>
            <tr>
                <!-- <td></td> -->
                <td style="font-weight: bold; text-align: center; padding: 2px; height: 5px;"></td>
            </tr>
            <tr>
                <!-- <td></td> -->
                <td rowspan="2" colspan="2" style="font-weight: bold; text-align: center; padding: 2px;font-size:12px;">{{$barang->namabarang}}</td>
            </tr>
            
        </tbody></table>
        <br>
    

 
 </div>

 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
 <script>
  JsBarcode("#barcode", "{{$barang->kodebarang}}", {
   width: 1,
   height: 50,
   fontSize: 15,
  });
 </script>
</body>

</html>