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
                        ."<td class='align-middle'><a href='index.php?controller=country&action=getCountry&pays=".$countries['name']."'>".$countries['name']." <i class='fas fa-sign-in-alt'></i></a></td>"
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
        // var_dump($country);
        $this->page .= "<div class='container'>";
        $this->page .= "<h2 class='mt-4 mb-4'>Derniers chiffre du Coronavirus (Covid19) - Pays : ".$pays."</h2>";
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
        $this->page .= "</tbody></table>";
        $this->page .= "</div>";
        $this->displayPage();
    }
    
}
