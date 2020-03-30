<?php
class CountryView extends View
{
    
    /**
     * Affichage de la liste des pays
     *
     * @param [type] $listCountries
     * @return void
     */
    public function displayHome($listCountries,$infection,$worldDeath,$worldHealing,$worldPopulation)
    {
        // var_dump($infection);
        // var_dump($worldPopulation);
        foreach ($worldPopulation as $type => $totalPop) {
            $tauxInfection = round((($infection / $totalPop)*100), 2);
        }
        if ($infection > 0) {
            $worldDeathRate = round((($worldDeath / $infection)*100), 2);
            $worldHealingRate = round((($worldHealing / $infection)*100), 2);
        } else {
            $worldDeathRate = 0;
            $worldHealingRate = 0;
        }
        $this->page .= "<div class='container'>";
        $this->page .= "<h2 class='mt-4 mb-4'>Derniers chiffres du Coronavirus (Covid19)</h2>";
        $this->page .= "<div class='row mb-4'>
        <div class='col-sm-4 text-center'>
          <div class='card mx-auto'>
            <div class='card-body bg-secondary text-light'>
              <h5 class='card-title'>Infectés confirmés</h5>
              <p class='card-text'>
                  <div class='alert alert-warning' role='alert'>
                      <h5>".$infection."</h5>
                  </div>
              </p>
              <h5 class='card-title'>Taux d'infection</h5>
              <p class='card-text'>
                  <div class='alert alert-warning' role='alert'>
                      <h5>".$tauxInfection." %</h5>
                  </div>
              </p>
            </div>
          </div>
        </div>
        <div class='col-sm-4 text-center'>
          <div class='card mx-auto'>
              <div class='card-body bg-secondary text-light'>
                <h5 class='card-title'>Morts confirmés</h5>
                <p class='card-text'>
                    <div class='alert alert-danger' role='alert'>
                        <h5>".$worldDeath."</h5>
                    </div>
                </p>
                <h5 class='card-title'>Taux de mortalité</h5>
                <p class='card-text'>
                    <div class='alert alert-danger' role='alert'>
                        <h5>".$worldDeathRate." %</h5>
                    </div>
                </p>
              </div>
            </div>
        </div>
        <div class='col-sm-4 text-center'>
          <div class='card mx-auto'>
              <div class='card-body bg-secondary text-light'>
                <h5 class='card-title'>Guérisons dans le monde</h5>
                <p class='card-text'>
                    <div class='alert alert-success' role='alert'>
                        <h5>".$worldHealing."</h5>
                    </div>
                </p>
                <h5 class='card-title'>Taux de guérison</h5>
                <p class='card-text'>
                    <div class='alert alert-success' role='alert'>
                        <h5>".$worldHealingRate." %</h5>
                    </div>
                </p>
              </div>
            </div>
        </div>
      </div>";
        // if(isset($_SESSION['user'])){
        $this->page .= "<div class='d-flex justify-content-between mb-3'><p class='mb-0'><a href='index.php?controller=country&action=automaticUpload'><button type='button' class='btn btn-primary'>Mettre à jour</button></a></p>
        <p class='mb-0'><a href='index.php?controller=country&action=clearBdd'><button type='button' class='btn btn-danger'><i class='far fa-trash-alt'></i> Vider la table</button></a></p>
        <form action='index.php?controller=country&action=uploadFile' method='post' enctype='multipart/form-data'><label for='uploadFile' class='btn btn-warning'><i class='fas fa-upload'></i> Upload File</label>
        <input type='file' id='uploadFile' hidden name='uploadFile' onchange='form.submit()'>
        </form>
        <form role='search' class='bd-search d-flex align-items-center'><span class='algolia-autocomplete' style='position: relative; display: inline-block; direction: ltr;'><input type='search' class='form-control ds-input' id='search-input' placeholder='Chercher...' aria-label='Search for...' autocomplete='off' data-docs-version='4.4' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top;'><pre aria-hidden='true' style='position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;'></pre><span class='ds-dropdown-menu' role='listbox' id='algolia-autocomplete-listbox-0' style='position: absolute; top: 100%; z-index: 100; left: 0px; right: auto; display: none;'><div class='ds-dataset-1'></div></span></span></form></div>";
        // }
        $this->page .= "<table class='table table-sm'>";
        $this->page .= "<thead class='thead-dark'><tr>";
        $this->page .= "<th scope='col' class='align-middle'>Date<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>Pays<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>Infections<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>Morts<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>Guérisons<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>taux de décès<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>taux de guérison<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        $this->page .= "<th scope='col' class='align-middle'>taux d'infection<a href='#'><i class='fa fa-sort ml-1'></i></a></th>";
        // // if(isset($_SESSION['user'])){
        // // }
        $this->page .= "</tr></thead><tbody id='myTable'>";
        foreach ($listCountries as $countries) {
            if ($countries['Infections'] > 0) {
                $tauxDeces = round((($countries['Deces'] / $countries['Infections'])*100), 2);
                $tauxGuerison = round((($countries['Guerisons'] / $countries['Infections'])*100), 2);
            } else {
                $tauxDeces = 0;
                $tauxGuerison = 0;
            }
            $tauxInfection = round((($countries['Infections'] / $countries['population'])*100), 2);
            $this->page .= "<tr><th scope='row' class='align-middle'>".date("d-m-Y", $countries['Date'])."</th>"
                        ."<td class='align-middle'><a class='d-block' href='index.php?controller=country&action=getCountry&pays=".$countries['name']."'><img src='./png100px/".strtolower($countries['code']).".png'>"." ".$countries['name']." <i class='fas fa-sign-in-alt'></i></a></td>"
                        ."<td class='align-middle'>".$countries['Infections']."</td>"
                        ."<td class='align-middle'>".$countries['Deces']."</td>"
                        ."<td class='align-middle'>".$countries['Guerisons']."</td>"
                        ."<td class='align-middle'>".$tauxDeces." %</td>"
                        ."<td class='align-middle'>".$tauxGuerison." %</td>"
                        ."<td class='align-middle'>".$tauxInfection." %</td>";
            $this->page .= "</tr>";
        }
        $this->page .= "</tbody></table>";
        $this->page .= "</div>";
        $this->displayPage();
    }

    /**
     * Affichage d'un pays
     *
     * @param [type] $country,$pays
     * @return void
     */
    public function modal($country,$pays){
        $this->page .= "<div class='container'>";
        foreach ($country as $key => $value) {
            $nomPays = $value['name'];
            $codePays = $value['code'];
            $population = $value['population'];
        }
        $this->page .= "<div class='text-center'><img class='rounded mx-auto d-block' src='./png100px/".strtolower($codePays).".png'>
                    <p class='mt-4'><i class='fa fa-users mr-1'></i>".$population." habitants</p></div>";
        $this->page .= "<div class='col-12' id='chartContainer'>
                        <div class='col-12 bg-transparent' id='countryInfo'>
                        </div>
                        <div id='graph' style='width:100%; height:400px; margin-top: 1em;'></div>
                        </div>";
        $this->page .= "<h2 class='mt-4 mb-4'>Derniers chiffres du Coronavirus (Covid19) - Pays : ".$nomPays." ( ".$codePays." )</h2>";
        $this->page .= "<div class='d-flex mb-3'>
                        <p class='mb-0 mr-3'><a href='index.php?controller=country&action=createPdf&pays=".$nomPays."'><button type='button' class='btn btn-success'><i class='fas fa-file-download'></i> PDF</button></a></p>
                        <p class='mb-0'><a href='index.php?controller=country&action=export_data_to_csv&pays=".$nomPays."'><button type='button' class='btn btn-warning'><i class='fas fa-file-download'></i> CSV</button></a></p>
                        </div>";
        $this->page .= "<table class='table table-sm'>";
        $this->page .= "<thead class='thead-dark'><tr>";
        $this->page .= "<th scope='col' class='align-middle'>Date</th>";
        $this->page .= "<th scope='col' class='align-middle'>Infections</th>";
        $this->page .= "<th scope='col' class='align-middle'>Morts</th>";
        $this->page .= "<th scope='col' class='align-middle'>Guérisons</th>";
        $this->page .= "<th scope='col' class='align-middle'>taux de décès</th>";
        $this->page .= "<th scope='col' class='align-middle'>taux de guérison</th>";
        $this->page .= "<th scope='col' class='align-middle'>taux d'infection</th>";
        $this->page .= "</tr></thead><tbody id='myTable'>";
        foreach ($country as $count) {
            // var_dump($country);
            if ($count['Infections'] > 0) {
                $tauxDeces = round((($count['Deces'] / $count['Infections'])*100), 2);
                $tauxGuerison = round((($count['Guerisons'] / $count['Infections'])*100), 2);
            } else {
                $tauxDeces = 0;
                $tauxGuerison = 0;
            }
            $tauxInfection = round((($count['Infections'] / $count['population'])*100), 2);
            $this->page .= "<tr><th scope='row' class='align-middle'>".date("d-m-Y", $count['Date'])."</th>"
                        ."<td class='align-middle'>".$count['Infections']."</td>"
                        ."<td class='align-middle'>".$count['Deces']."</td>"
                        ."<td class='align-middle'>".$count['Guerisons']."</td>"
                        ."<td class='align-middle'>".$tauxDeces." %</td>"
                        ."<td class='align-middle'>".$tauxGuerison." %</td>"
                        ."<td class='align-middle'>".$tauxInfection." %</td>";
            $this->page .= "</tr>";
        }
        $dateArray = [];
        $infectionsArray = [];
        $decesArray = [];
        $guerisonsArray = [];
        foreach ($country as $key) {
            // var_dump($country);
            array_push($dateArray, $key['Date']*1000);
            array_push($infectionsArray, intval($key['Infections']));
            array_push($decesArray, intval($key['Deces']));
            array_push($guerisonsArray, intval($key['Guerisons']));
        }
        // $dataDate = [date("d-m-Y", $country[0]['Date']),date("d-m-Y", $country[1]['Date']),date("d-m-Y", $country[2]['Date']),date("d-m-Y", $country[3]['Date']),date("d-m-Y", $country[4]['Date']),date("d-m-Y", $country[5]['Date']),date("d-m-Y", $country[6]['Date']),date("d-m-Y", $country[7]['Date']),date("d-m-Y", $country[8]['Date']),date("d-m-Y", $country[9]['Date'])];
        // // $dataDate = [$country[0]['Date'],$country[1]['Date'],$country[2]['Date'],$country[3]['Date'],$country[4]['Date'],$country[5]['Date'],$country[6]['Date'],$country[7]['Date'],$country[8]['Date'],$country[9]['Date']];
        // $dataGuerisons = [$country[0]["Guerisons"],$country[1]["Guerisons"],$country[2]["Guerisons"],$country[3]["Guerisons"],$country[4]["Guerisons"],$country[5]["Guerisons"],$country[6]["Guerisons"],$country[7]["Guerisons"],$country[8]["Guerisons"],$country[9]["Guerisons"]];
        // $dataDeces = [$country[0]["Deces"],$country[1]["Deces"],$country[2]["Deces"],$country[3]["Deces"],$country[4]["Deces"],$country[5]["Deces"],$country[6]["Deces"],$country[7]["Deces"],$country[8]["Deces"],$country[9]["Deces"]];
        // $dataInfections = [$country[0]["Infections"],$country[1]["Infections"],$country[2]["Infections"],$country[3]["Infections"],$country[4]["Infections"],$country[5]["Infections"],$country[6]["Infections"],$country[7]["Infections"],$country[8]["Infections"],$country[9]["Infections"]];
        // $dataDate = json_encode($dataDate, JSON_NUMERIC_CHECK);
        // $dataGuerisons = json_encode($dataGuerisons, JSON_NUMERIC_CHECK);
        // $dataDeces = json_encode($dataDeces, JSON_NUMERIC_CHECK);
        // $dataInfections = json_encode($dataInfections, JSON_NUMERIC_CHECK);
        $this->page .= "</tbody></table>";
        $this->page .= "</div>";
        $this->page .= "<script>document.addEventListener('DOMContentLoaded', function () {
            var dateArray = {dateArray};
            var infectionsArray = {infectionsArray};
            var decesArray = {decesArray};
            var guerisonsArray = {guerisonsArray};
            console.log(dateArray);
            console.log(infectionsArray);
            console.log(decesArray);
            console.log(guerisonsArray);
            
        
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graph',
                type: 'line'
            },
            title: {
                text: 'Graphique sur les 10 derniers jours'
            },
            xAxis: {
                type: 'datetime',
                title: {
                    text: 'Jour'
                },
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
                
            },
            yAxis: {
                title: {
                    text: 'Nombre de personnes'
                },
                min: 0
            },
            colors: ['#FFC107', '#DC3545', '#28A745'],
            series: [{
                name: 'Infectés',
                data: [
                    [dateArray[9], infectionsArray[9]],
                    [dateArray[8], infectionsArray[8]],
                    [dateArray[7], infectionsArray[7]],
                    [dateArray[6], infectionsArray[6]],
                    [dateArray[5], infectionsArray[5]],
                    [dateArray[4], infectionsArray[4]],
                    [dateArray[3], infectionsArray[3]],
                    [dateArray[2], infectionsArray[2]],
                    [dateArray[1], infectionsArray[1]],
                    [dateArray[0], infectionsArray[0]]
                    
                ]
            }, {
                name: 'Morts',
                data: [
                    [dateArray[9], decesArray[9]],
                    [dateArray[8], decesArray[8]],
                    [dateArray[7], decesArray[7]],
                    [dateArray[6], decesArray[6]],
                    [dateArray[5], decesArray[5]],
                    [dateArray[4], decesArray[4]],
                    [dateArray[3], decesArray[3]],
                    [dateArray[2], decesArray[2]],
                    [dateArray[1], decesArray[1]],
                    [dateArray[0], decesArray[0]]
                ]
            }, {
                name: 'Guéris',
                data: [
                    [dateArray[9], guerisonsArray[9]],
                    [dateArray[8], guerisonsArray[8]],
                    [dateArray[7], guerisonsArray[7]],
                    [dateArray[6], guerisonsArray[6]],
                    [dateArray[5], guerisonsArray[5]],
                    [dateArray[4], guerisonsArray[4]],
                    [dateArray[3], guerisonsArray[3]],
                    [dateArray[2], guerisonsArray[2]],
                    [dateArray[1], guerisonsArray[1]],
                    [dateArray[0], guerisonsArray[0]]
                ]
            }]
        });
        });</script>";
        $this->page = str_replace('{dateArray}', json_encode($dateArray),$this->page);
        $this->page = str_replace('{infectionsArray}', json_encode($infectionsArray),$this->page);
        $this->page = str_replace('{decesArray}', json_encode($decesArray),$this->page);
        $this->page = str_replace('{guerisonsArray}', json_encode($guerisonsArray),$this->page);
        $this->displayPage(); 
    }
    
}
