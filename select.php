<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>pdfmake sandbox</title>
    <script src='PDF_config/js/pdfmake.min.js'></script>
    <script src='PDF_config/js/vfs_fonts.min.js'></script>
    <!-- <script src='PDF_config/js/path_fonts.js'></script> -->
</head>

<body>
    <style>

    </style>
    <div class="container">
        <?php 
            include('login/server.php');

            $array_data_pdf = array();
            $sql = "SELECT * FROM `user`";
            $result = $conn->query($sql);

            array_push($array_data_pdf,[
                'ชื่อ', 'นามสกุล','อีเมลล์', 'เบอร์โทร'
            ]);

            foreach($result as $array_data){

                array_push($array_data_pdf,[
                    $array_data['firstname'] , $array_data['lastname'] , $array_data['email'] , $array_data['num_phone']
                ]);

            }
        ?>

        <button id="make-pdf" onclick="makePdf();">make pdf</button>
    </div>
    <script>
        
        function makePdf() {
            var docDefinition = {
                content: [
                    // { text: "Sarabun Thai font กเดกดเ" ,fontSize :20 },
                    { text: "Sarabun Thai font bold กดเกหดเ", bold: true ,fontSize :20 },
                    // { text: "Sarabun Thai font bold กดเกหดเกดเ", italics: true ,fontSize :20  },
                    {
                        layout: 'lightHorizontalLines', // optional
                        table: {
                            // headers are automatically repeated if the table spans over multiple pages
                            // you can declare how many rows should be treated as headers
                            headerRows: 1,
                            widths: [ '*', 'auto', 100, '*' ],

                            // body: [
                            // [ 'First', 'Second', 'Third', 'The last one' ],
                            // [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
                            // [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
                            // ]
                            body : <?php echo json_encode($array_data_pdf) ?>
                        }
                    },
                ],
                // defaultStyle: { 
                //     font: 'Roboto'
                // }
            };
            pdfMake.createPdf(docDefinition).print();
        }

    </script>
    
</body>

</html>

<section class="home-section"><br>
    <div id="chartContainer" 
    style="height: 380px;
    max-width: 900px;
    position: absolute;
    left: 20%;
    right: 20%;"></div>
    <div id="chartContainer1" 
    style="height: 380px;
    max-width: 900px;
    position: absolute;
    top: 430px;
    left: 20%;
    right: 20%;"></div>
    <div id="chartContainer2" 
    style="height: 380px;
    max-width: 900px;
    position: absolute;
    top: 430px;
    left: 20%;
    right: 20%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</section>