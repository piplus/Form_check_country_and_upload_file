<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>HW05 พรพิพัฒร์ วารินธุ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body onload="radid('exampleRadios1')">
    <form class="form-control mx-auto" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <input class="form-check-input" type="radio" name="radio" id="exampleRadios1" value="option1" onclick="radid('exampleRadios1')" checked>
        <label class="form-check-label mr-5" for="exampleRadios1">Select file</label>
        <input class="form-check-input" type="radio" name="radio" id="exampleRadios2" value="option2" onclick="radid('exampleRadios1')">
        <label class="form-check-label" for="exampleRadios2">Upload file</label>
        <br><hr>
        <label class="form-label file-input" for="customFile" style="display: none;">Default file input </label>
        <input type="file" style="width: 500px; display:none" class="form-control file-input" id="customFile" name="file" />
        <label class="form-label file-select" for="selectfile">Select file input </label>
        <select class="form-select file-select" aria-label="Default select example" id="selectfile" name="select">
            <option value="hw-doc01.txt" name="file-hw">hw-doc01.txt</option>
            <option value="hw-doc02.txt" name="file-hw">hw-doc02.txt</option>
            <option value="hw-doc03.txt" name="file-hw">hw-doc03.txt</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3 mb-3" name="submit">Confirm</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $globe = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czechia", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
        $Central_asia = array("Kazakhstan", "Kyrgyzstan", "Tajikistan", "Turkmenistan", "Uzbekistan");
        $Eastern_asia = array("China", "Hong Kong", "Macao", "North Korea", "Japan", "Mongolia", "Republic of Korea");
        $Southern_asia = array("Afghanistan", "Bangladesh", "Bhutan", "India", "Iran", "Maldives", "Nepal", "Pakistan", "Sri Lanka");
        $South_Eastern_asia = array("Brunei Darussalam", "Cambodia", "Indonesia", "Lao", "Malaysia", "Myanmar", "Philippines", "Singapore", "Thailand", "Timor-Leste", "Viet Nam");
        $Western_asia = array("Armenia", "Azerbaijan", "Bahrain", "Cyprus", "Georgia", "Iraq", "Israel", "Jordan", "Kuwait", "Lebanon", "Oman", "Qatar", "Saudi Arabia", "State of Palestine", "Syrian Arab Republic", "Turkey", "United Arab Emirates", "Yemen");

        if (empty($_POST['radio'])) {
            echo 'forget to press radio';
        } else {
            if ($_POST['radio'] == "option1") {
                // echo $_POST['radio'];
                $fl = $_POST['select'];
            } else {
                if(isset($_POST['submit'])){
                    $filename = $_FILES['file']['name'];
                    // echo $filename;
                    $ext = pathinfo($filename,PATHINFO_EXTENSION);
                    // echo $ext;
                    $allowed = array('txt');
                    if(!in_array($ext,$allowed)){
                        echo "  <div class='card '>
                                    <div class='card-body'>
                                    <h5 class='card-title'>Upload Only Text File</h5>
                                    </div>
                                </div>";
                        return;
                    }else{
                        $name = explode('.',$filename);
                        $ext = $name[1];
                        $tmpname = $_FILES['file']['tmp_name'];
                        $moveto = './' . $filename;
                        // echo $tmpname;

                        if(move_uploaded_file($tmpname,$moveto)){
                            chmod('./'.$filename,0777);
                            $fl = $filename;
                        }
                        $myfile = fopen($fl, "r") or die("Unable to open file!");
                        $rfile = fread($myfile,filesize($fl));
                        fclose($myfile);
                        // echo $rfile;
                    }
                }
            } 
            if (empty($fl)) {
                // echo "file is empty";
                echo "<div class='card '>
                    <div class='card-body'>
                    <h5 class='card-title'>File is empty</h5>
                    <p class='card-text'>-</p>
                    </div>
                </div>";
            } else {
                $myfile = fopen("$fl", "r") or die("Unable to open file!");
                $rfile = fread($myfile, filesize("$fl"));
                fclose($myfile);

                $find_country = array();
                $find_central_asia = array();
                $find_Eastern_asia = array();
                $find_Southern_asia = array();
                $find_South_Eastern_asia = array();
                $find_Western_asia = array();
                $find_country_other = array();


                foreach ($globe as $val) {
                    if (stripos($rfile, $val) !== false) {
                        $find_country[] = $val;
                    }
                }

                foreach ($find_country as $val) {
                    if (in_array($val, $Central_asia) !== false) {
                        $find_central_asia[] = $val;
                    } else if (in_array($val, $Eastern_asia) !== false) {
                        $find_Eastern_asia[] = $val;
                    } else if (in_array($val, $Southern_asia) !== false) {
                        $find_Southern_asia[] = $val;
                    } else if (in_array($val, $South_Eastern_asia) !== false) {
                        $find_South_Eastern_asia[] = $val;
                    } else if (in_array($val, $Western_asia) !== false) {
                        $find_Western_asia[] = $val;
                    } else {
                        $find_country_other[] = $val;
                    }
                }

                $res_all = implode(", ", $find_country);
                $res_central_asia = implode(", ", $find_central_asia);
                $res_Eastern_asia = implode(", ", $find_Eastern_asia);
                $res_Southern_asia = implode(", ", $find_Southern_asia);
                $res_South_Eastern_asia = implode(", ", $find_South_Eastern_asia);
                $res_Western_asia = implode(", ", $find_Western_asia);
                $res_country_other = implode(", ", $find_country_other);

                echo "  <div class='card' >
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'>File name : $fl</li>
                            </ul>
                        </div> ";

                echo "  <div class='card '>
                        <div class='card-body'>
                            <h5 class='card-title'>Content in file</h5>
                            <p class='card-text'>$rfile</p>
                        </div>
                        </div>";

                echo "  <div class='card' >
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'>Country : $res_all</li>
                            </ul>
                        </div> ";

                if (!empty($res_central_asia)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>Central Asia</h5>
                        <p class='card-text'>$res_central_asia</p>
                        </div>
                        </div>";
                }

                if (!empty($res_Eastern_asia)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>Eastern Asia</h5>
                        <p class='card-text'>$res_Eastern_asia</p>
                        </div>
                        </div>";
                }
                if (!empty($res_Southern_asia)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>Southern Asia</h5>
                        <p class='card-text'>$res_Southern_asia</p>
                        </div>
                        </div>";
                }
                if (!empty($res_South_Eastern_asia)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>South Eastern Asia</h5>
                        <p class='card-text'>$res_South_Eastern_asia</p>
                        </div>
                        </div>";
                }
                if (!empty($res_Western_asia)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>Western Asia</h5>
                        <p class='card-text'>$res_Western_asia</p>
                        </div>
                        </div>";
                }
                if (!empty($res_country_other)) {
                    echo "<div class='card '>
                        <div class='card-body'>
                        <h5 class='card-title'>Other</h5>
                        <p class='card-text'>$res_country_other</p>
                        </div>
                        </div>";
                }
            }
        }
    }
    ?>
    <script>
        function radid(elem) {
            var radio_1 = document.getElementById(elem);
            const file_input = document.querySelectorAll('.file-input');
            const file_select = document.querySelectorAll('.file-select');

            if (radio_1.checked) {
                file_input.forEach((p) => {
                    p.style.display = "none";
                });

                file_select.forEach((p) => {
                    p.style.display = "block";
                });
            } else {
                file_input.forEach((p) => {
                    p.style.display = "block";
                });

                file_select.forEach((p) => {
                    p.style.display = "none";
                });
            }
        }
    </script>
</body>
</html>