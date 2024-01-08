    <div class="DIVbox calendar" ID = "MAINRight">
        <h2>
            <?php setlocale(LC_TIME,'ita.UTF-8'); 
            echo mb_strtoupper(strftime("%A %d %B"));?>
        </h2>
        
        <table>
            <thead>
                <tr>
                    <td><b>LU</b></td>
                    <td><b>MA</b></td>
                    <td><b>ME</b></td>
                    <td><b>GI</b></td>
                    <td><b>VE</b></td>
                    <td><b>SA</b></td>
                    <td><b>DO</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php 
                    include '../common/DBquery.php';
                    if (date('m') == 2){
                        $month_lenght = 28;
                    } else if (date('m') == 4 || date('m') == 6 || date('m') == 9 || date('m') == 11) {
                        $month_lenght = 30;
                    } else { $month_lenght = 31; }
                    setlocale(LC_TIME,'en_en'); 
                    $daynum = date("N", strtotime(strftime("%A")));
                    $prev_m = date('m')-1;
                    if ($prev_m == 0) $prev_m = 12;
                    if ($prev_m == 2){ $prev_month_lenght = 28;
                    } else if ($prev_m == 4 || $prev_m == 6 || $prev_m == 9 || $prev_m == 11) { $prev_month_lenght = 30;
                    } else { $prev_month_lenght = 31; } 

                    $res = MAINCalendar($mail, date("m"), date("Y"));
                    $myarray = [];
                    if ($res != NULL){
                        while($row = $res->fetch_assoc()) {
                            array_push($myarray, date("d", strtotime($row['data'])));
                        }
                    }
                    
                    $diff = ((7-(strftime("%d")%7))+($daynum-1));
                    if ($diff >= 7) {$diff=$diff-7;}
                    for($i=($prev_month_lenght-$diff);$i<=($prev_month_lenght); $i++){ 
                        echo "<td ";
                        echo 'class="prev-month">';
                        echo ''; echo $i; echo "</td>";
                    }
                    for ($i=1; $i<=$month_lenght; $i++){
                        echo "<td ";
                        if (strftime("%d")==$i) { 
                            echo 'class="current-day'; 
                        } else {
                            echo 'class="';
                        };
                        
                        
                        //se c'è un evento  mette la class event (pallino)
                        if (in_array($i, $myarray)){
                            echo ' event" onclick="location.href = ' . "'ELENCOriun.php'";
                        }
                        echo '">'; 
                        echo $i; echo "</td>";
                    }
                    
                    ?>
                </tr>
            </tbody>
        </table>
    </div> <!-- end calendar -->
