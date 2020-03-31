<?php
require('fpdf/fpdf.php');

class CountryModel extends Model
{
        /**
     * Fonction affichage de tous les pays
     *
     * @return void
     */
    public function getCountries(){
        $requete = "SELECT *, d.id as id_Code
        FROM daydata as d
        LEFT JOIN country as c
        ON d.code = c.code
        WHERE Date = (SELECT MAX(Date) FROM daydata)
        ORDER BY name";
        $result = $this->connexion->query($requete);
        $listCountries = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listCountries;
    }

    /**
     * Fonction affichage d'un pays
     *
     * @return void
     */
    public function getCountry(){
        $pays = $_GET['pays'];

        $requete = $this->connexion->prepare("SELECT *, d.id as id_Code
        FROM daydata as d
        LEFT JOIN country as c
        ON d.code = c.code
        WHERE c.name = :pays
        ORDER BY Date DESC");
        $requete->bindParam(':pays', $pays);
        $result = $requete->execute();
        $country = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $country;
    }

    // public function parseJson(){
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $countryList = [];
    //     foreach ($parsed_json->PaysData as $key) {
    //         $countryList[$key->Pays][strtotime($key->Date)] = array(
    //             "infections" => $key->Infection,
    //             "deces"=> $key->Deces,
    //             "guerisons"=> $key->Guerisons
    //             // "tauxDeces"=> $key->TauxDeces,
    //             // "tauxGuerison"=> $key->TauxGuerison,
    //             // "tauxInfection"=> $key->TauxInfection
    //         );
    //     };
    //     return $countryList;
    // }

    // public function parseCountryData()
    // {
    //     $file = 'country_data.json'; 
    //     $json = file_get_contents($file);
    //     $parsed_json = json_decode($json);

    //     $countryData = [];
    //     foreach ($parsed_json as $codeCountry => $values) {
    //         $countryData[$codeCountry] = array(
    //             "population" => $values->Population,
    //             "name"=> $values->Frenchname
    //         );
    //     };
    //     return $countryData;
    // }

    // public function getFileJson(){
    //     $file = 'https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881'; 
    //     // mettre le contenu du fichier dans une variable
    //     $data = file_get_contents($file); 
    //     // décoder le flux JSON
    //     $array = json_decode($data); 
    //     $array = $array->{'PaysData'}; 
    //     $yesterday = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-1,date("Y")));
    //     //$yesterday = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-1,date("Y")))."T00:00:00";
    //         //if ($row->{'Date'} !== $yesterday) {
    //             //unset($row);
    //         //}
    //     // var_dump($array);
    //     $requete = $this->connexion->beginTransaction();
    //     $requete1 = $this->connexion->prepare("TRUNCATE TABLE datas");
    //     $requete1->execute();
    //     foreach($array as $row) {
    //         $date = substr($row->{'Date'}, 0, 10);
    //         $pays = $row->{'Pays'};
    //         $infection = $row->{'Infection'};
    //         $deces = $row->{'Deces'};
    //         $guerisons = $row->{'Guerisons'};
    //         $tauxDeces = $row->{'TauxDeces'};
    //         $tauxGuerison = $row->{'TauxGuerison'};
    //         $tauxInfection = $row->{'TauxInfection'};
    //         $requete2 = $this->connexion->prepare("INSERT INTO `datas` VALUES (:Date,:Pays,:Infections,:Deces,:Guerisons,:TauxDeces,:TauxGuerison,:TauxInfection)");
    //         $requete2->bindParam(':Date' , $date);
    //         $requete2->bindParam(':Pays' , $pays);
    //         $requete2->bindParam(':Infections' , $infection); 
    //         $requete2->bindParam(':Deces' , $deces); 
    //         $requete2->bindParam(':Guerisons' , $guerisons); 
    //         $requete2->bindParam(':Deces' , $deces); 
    //         $requete2->bindParam(':TauxDeces' , $tauxDeces); 
    //         $requete2->bindParam(':TauxGuerison' , $tauxGuerison); 
    //         $requete2->bindParam(':TauxInfection' , $tauxInfection); 
    //         $result = $requete2->execute();
    //         // var_dump($requete->errorInfo());
    //         // var_dump($result);
    //     }
    //     $requete = $this->connexion->commit();
    // }

    //     /**
    //  * Fonction affichage fichier Json taux infection
    //  *
    //  * @return void
    //  */
    // public function getWorldInfectionRate() {
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $infectionRate = $parsed_json->{'GlobalData'}[0]->{'TauxInfection'};
    //     return $infectionRate;
    // }

    //    /**
    //  * Fonction affichage fichier Json nbre morts
    //  *
    //  * @return void
    //  */
    // public function getWorldDeath() {
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $worldDeath = $parsed_json->{'GlobalData'}[0]->{'Deces'};
    //     return $worldDeath;
    // }

    //    /**
    //  * Fonction affichage fichier Json taux de mortalité
    //  *
    //  * @return void
    //  */
    // public function getWorldDeathRate() {
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $worldDeathRate = $parsed_json->{'GlobalData'}[0]->{'TauxDeces'};
    //     return $worldDeathRate;
    // }

    //        /**
    //  * Fonction affichage fichier Json nbre guérisons
    //  *
    //  * @return void
    //  */
    // public function getWorldHealing() {
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $worldHealing = $parsed_json->{'GlobalData'}[0]->{'Guerisons'};
    //     return $worldHealing;
    // }

    //            /**
    //  * Fonction affichage fichier Json taux de guérisons
    //  *
    //  * @return void
    //  */
    // public function getWorldHealingRate() {
    //     $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
    //     $parsed_json = json_decode($json);
    //     $worldHealingRate = $parsed_json->{'GlobalData'}[0]->{'TauxGuerison'};
    //     return $worldHealingRate;
    // }

    // public function getFullDataFromDB()
    // {
    //     $sql = "SELECT country.name, country.population, daydata.* 
    //     FROM daydata JOIN country ON country.code = daydata.code";
    //     $request = $this->connexion->prepare($sql);
    //     $result = $request->execute();
    //     $data = $request->fetchAll(PDO::FETCH_ASSOC);

    //     $parsedData = [];
    //     foreach ($data as $dat) {
    //         // var_dump($dat);
    //         $parsedData[$dat['name']]['population'] = $dat['population'];
    //         $parsedData[$dat['name']]['code'] = $dat['code'];
    //         $parsedData[$dat['name']]['data'][$dat['Date']] = array(
    //             "infections" => $dat['Infections'],
    //             "deces" => $dat['Deces'],
    //             "guerisons" => $dat['Guerisons']

    //         );
    //     }
    //     return $parsedData;
    // }

    // public function compare($oldData, $countryList)
    // {
    //     var_dump($countryList);
    //     $filteredData = [];
    //     // foreach ($countryList as $countryName => $newValue) {
    //     //     // var_dump($newValue);
    //     //     // if (!in_array($countryName, array_keys($oldData))) {
    //     //     //     $filteredData[$countryName] = [];
    //     //     //     foreach ($newValue as $time => $data) {
    //     //     //         $filteredData[$countryName][$time] = $data;
    //     //     //     }
    //     //     // } 
    //     //     // else {
    //     //         foreach ($newValue as $time => $data) {
    //     //             // var_dump($data);
    //     //             if (!in_array($time, array_keys($oldData[$countryName]))) {
    //     //                 $filteredData[$countryName][$time] = $data;
    //     //             }
    //     //     //     }
    //     //     }
    //     // }
    //     // var_dump($filteredData);
    //     return $filteredData;
    // }

    // public function addCodeAndPopulation($countryList,$newCountryData)
    // {
    //     // var_dump($countryList);
    //     // var_dump($newCountryData);
    //     $countriesWithCode = [];
    //     foreach ($countryList as $countryName => $dayDataList) {
    //         // var_dump($dayDataList);
    //         $hasMatched = false;
    //         foreach ($newCountryData as $countryCode => $countryDetails) {
    //             if($countryName == $countryDetails['name']) {
    //                 $countriesWithCode[$countryCode] = array(
    //                     'population' => $countryDetails['population'],
    //                     'name' => $countryName,
    //                     'data' => $dayDataList
    //                 );
    //                 $hasMatched = true;
    //                 break;
    //             }
    //         }
    //         // if ($hasMatched == false) {
    //         //     var_dump($countryName);
    //         // }
    //     }
    //     // var_dump($countriesWithCode);
    //     return $countriesWithCode;
    // }

    // public function uploadDataToDB($dataToUpLoad)
    // {
    //     // var_dump($dataToUpLoad);
    //     $requete = $this->connexion->beginTransaction();
    //     $requete1 = $this->connexion->prepare("TRUNCATE TABLE daydata");
    //     $requete1->execute();
    //     foreach($dataToUpLoad as $countryCode => $values) {
    //         foreach ($values['data'] as $date => $dayValues) {
    //             // var_dump($dayValues);
    //             $time = $date;
    //             $infections = $dayValues["infections"];
    //             $deces = $dayValues["deces"];
    //             $guerisons = $dayValues["guerisons"];
    //             $code = $countryCode;
    //             $requete2 = $this->connexion->prepare("INSERT INTO daydata 
    //                                 VALUES (NULL,:Date,:Infections,:Deces,:Guerisons,:code)");
    //             $requete2->bindParam(':Date' , $time);
    //             $requete2->bindParam(':Infections' , $infections); 
    //             $requete2->bindParam(':Deces' , $deces); 
    //             $requete2->bindParam(':Guerisons' , $guerisons); 
    //             $requete2->bindParam(':code' , $code); 
    //             $result = $requete2->execute();
    //         }
    //         // var_dump($result);
    //         // var_dump($requete2->errorInfo());
    //     }
    //     $requete = $this->connexion->commit();
    // }

    // public function uploadDataToDB($newData)
    // {
    //     // var_dump($newData);
    //     $this->connexion->beginTransaction();
    //     foreach($newData as $countryName => $values) {
    //         foreach ($values as $time => $dayValues) {
    //             $pays = $countryName;
    //             $date = $time;
    //             $infections = $dayValues["infections"];
    //             $deces = $dayValues["deces"];
    //             $guerisons = $dayValues["guerisons"];
    //             $tauxDeces = $dayValues["tauxDeces"];
    //             $tauxGuerison = $dayValues["tauxGuerison"];
    //             $tauxInfection = $dayValues["tauxInfection"];
    //             $requete = $this->connexion->prepare("INSERT INTO datas 
    //                                 VALUES (:Date,:Pays,:Infections,:Deces,:Guerisons,:TauxDeces,:TauxGuerison,:TauxInfection)");
    //             $requete->bindParam(':Date' , $date);
    //             $requete->bindParam(':Pays' , $pays);
    //             $requete->bindParam(':Infections' , $infections); 
    //             $requete->bindParam(':Deces' , $deces); 
    //             $requete->bindParam(':Guerisons' , $guerisons); 
    //             $requete->bindParam(':Deces' , $deces); 
    //             $requete->bindParam(':TauxDeces' , $tauxDeces); 
    //             $requete->bindParam(':TauxGuerison' , $tauxGuerison); 
    //             $requete->bindParam(':TauxInfection' , $tauxInfection);
    //             $result = $requete->execute();
    //         }
    //         // var_dump($result);
    //         // var_dump($requete->errorInfo());
    //     }
    //     $this->connexion->commit();
    // }

        /**
     * Insertion des données dans la table country
     *
     * @return void
     */
    public function pop()
    {
        $file = 'country_data.json'; 

        $json = file_get_contents($file);
        $parsed_json = json_decode($json);

        $countryData = [];
        foreach ($parsed_json as $codeCountry => $values) {
            $countryData[$codeCountry] = array(
                "population" => $values->Population,
                "name"=> $values->Frenchname
            );
        };

        foreach ($countryData as $code => $values) {
                $codeCountry = $code; 
                $french = $values['name'];
                $pop = $values['population'];
                $requete = $this->connexion->prepare("INSERT INTO country (code, population, name) VALUES (:code,:pop,:french)");
                $requete->bindParam(':code' , $codeCountry);
                $requete->bindParam(':french' , $french);
                $requete->bindParam(':pop' , $pop); 

                $result = $requete->execute();
            };
    }

        /**
     * Fonction affichage fichier Json nbre infection
     *
     * @return void
     */
    public function getWorldInfection() {
        $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
        // var_dump(json_decode($json));
        $parsed_json = json_decode($json);
        // var_dump($parsed_json);
        $infection = $parsed_json->{'GlobalData'}[0]->{'Infection'};
        // var_dump($infection);
        return $infection;
    }

    /**
     * Fonction affichage fichier Json nbre guérisons
     *
     * @return void
     */
    public function getWorldHealing() {
        $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
        $parsed_json = json_decode($json);
        $worldHealing = $parsed_json->{'GlobalData'}[0]->{'Guerisons'};
        return $worldHealing;
    }

    /**
     * Fonction affichage fichier Json nbre morts
     *
     * @return void
     */
    public function getWorldDeath() {
        $json = file_get_contents("https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881");
        $parsed_json = json_decode($json);
        $worldDeath = $parsed_json->{'GlobalData'}[0]->{'Deces'};
        return $worldDeath;
    }

    /**
     * Fonction calcul population mondiale
     *
     * @return void
     */
    public function getWorldPopulation()
    {
        $requete = $this->connexion->prepare("SELECT SUM(population)
        FROM country");
        $result = $requete->execute();
        $worldPopulation = $requete->fetch(PDO::FETCH_ASSOC);
        return $worldPopulation;
    }

    /**
     * Fonction parse fichier json
     *
     * @param string $file
     * @return void
     */
    public function parseJSONFile(string $file)
    {
        $string = file_get_contents($file);
        $rawData = json_decode($string);
        // var_dump($rawData);
        // Parse Country Data

        $parsedData = [];

        foreach ($rawData->PaysData as $datum) {
            $parsedData[$datum->Pays][strtotime($datum->Date)] = array(
                "infections" => $datum->Infection,
                "deces" => $datum->Deces,
                "guerisons" => $datum->Guerisons
            );
        };
        $results = array(
            "countries" => $parsedData
        );
        return $results;
    }

    /**
     * Fonction liste données depuis la base et création d'un tableau
     *
     * @return void
     */
    public function getFullDataFromDBase()
    {
        $sql = "SELECT country.name, country.population, daydata.*
        FROM daydata JOIN country 
        ON country.code = daydata.code";
        $request = $this->connexion->prepare($sql);
        $result = $request->execute();
        $data = $request->fetchAll(PDO::FETCH_ASSOC);

        $parsedData = [];

        foreach ($data as $datum) {
            $parsedData[$datum['name']]['population'] = $datum['population'];
            $parsedData[$datum['name']]['code'] = $datum['code'];
            $parsedData[$datum['name']]['data'][$datum['Date']] = array(
                "infected" => $datum['Infections'],
                "death" => $datum['Deces'],
                "recovered" => $datum['Guerisons']
            );
        }
        // var_dump($data);
        return $parsedData;
    }

    /**
     * Fonction comparaison des données
     *
     * @param [type] $oldData
     * @param [type] $newRawData
     * @return void
     */
    public function compareFile($oldData, $newRawData)
    {
        $filteredData = [];
        // var_dump($newRawData);
        foreach ($newRawData as $newCountryName => $newValue) {
            // var_dump(array_keys($oldData));
            // var_dump($newCountryName);
            if (!in_array($newCountryName, array_keys($oldData))) {
                $filteredData[$newCountryName] = [];
                foreach ($newValue as $time => $data) {
                    // var_dump($newValue);
                    $filteredData[$newCountryName][$time] = $data;
                }
            } else {
                foreach ($newValue as $time => $data) {
                    // var_dump($oldData[$newCountryName]['data']);
                    if (!in_array($time, array_keys($oldData[$newCountryName]['data']))) {
                        $filteredData[$newCountryName][$time] = $data;
                    }
                }
            }
        }
        // var_dump($filteredData);
        return $filteredData;
    }

    /**
     * Fonction Ajout code et population à chaque entrée du tableau
     *
     * @param [type] $data
     * @return void
     */
    public function addCodeAndPopulations($data)
    {
        $filePath = 'country_data.json';
        $string = file_get_contents($filePath);
        $rawData = json_decode($string);

        $updatedData = [];

        foreach ($data as $countryName => $countryData) {
            $hasMatched = False;
            foreach ($rawData as $isoCode => $values) {
                if (strtolower($countryName) == strtolower($values->Frenchname)) {
                    $updatedData[$isoCode]['Name'] = $countryName;
                    $updatedData[$isoCode]['Population'] = $values->Population;
                    $updatedData[$isoCode]['data'] = $countryData;
                    $hasMatched = TRUE;
                    break;
                }
            }
            if (!$hasMatched) {
                // var_dump("Error at:".$countryName );
            }
        }
        return $updatedData;
    }

    public function checkCountryList($data)
    {
        $request = $this->connexion->prepare("SELECT * FROM country");
        $result = $request->execute();
        $countriesInDB = $request->fetchAll(PDO::FETCH_ASSOC);

        $countryToCreate = [];

        foreach ($data as $countryCode => $values) {
            $hasMatched = FALSE;
            foreach ($countriesInDB as $existingCountry) {
                if ($existingCountry['code'] == $countryCode) {
                    $hasMatched = true;
                    break;
                }
            }

            if (!$hasMatched) {
                $countryToCreate[$countryCode] = array(
                    'Name' => $values['Name'],
                    'Population' => $values['Population']
                    // 'Data' => $values['data']
                );
            }
        }

        if (!empty($countryToCreate)) {
            // Create to DB;
            $this->connexion->beginTransaction();
            foreach ($countryToCreate as $countryCode => $values) {
                $request = $this->connexion->prepare("INSERT INTO `country` (`code`, `population`, `name`) VALUES (:code, :population, :name)");
                $request->bindParam(':code', $countryCode);
                $request->bindParam(':population', $values['Population']);
                $request->bindParam(':name', $values['Name']);
                $request->execute();
            }
            $this->connexion->commit();
        }
        // var_dump("Added Country: ");
        // var_dump(count($countryToCreate));
    }

    /**
     * Fonction envoi des données vers la BDD
     *
     * @param [type] $data
     * @return void
     */
    public function uploadDataToDBase($data)
    {
        // var_dump($data['AE']);
        $this->connexion->beginTransaction();
        foreach ($data as $countryCode => $values) {
            foreach ($values['data'] as $time => $dayValues) {
                $request = $this->connexion->prepare("INSERT INTO `daydata` (`id`, `Date`, `Infections`, `Deces`, `Guerisons`, `code`) 
                                                        VALUES (null, :date, :infected, :death, :recovered, :code)");
                $request->bindParam(':death', $dayValues['deces']);
                $request->bindParam(':infected', $dayValues['infections']);
                $request->bindParam(':recovered', $dayValues['guerisons']);
                $request->bindParam(':date', $time);
                $request->bindParam(':code', $countryCode);
                $request->execute();
                // var_dump($request->errorInfo());
            }
        }
        $this->connexion->commit();
    }

    public function createPdf($country){
        $header = array("Date", "Infections", "Décès", "Guérisons");
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('png100px/'.strtolower($country[0]['code']).'.png',10,5,20);
        // $pdf->Ln();
        $donneePdf = [];
        foreach ($country as $key ) {
            $donneePdf[] = array(
                "date" => date("d-m-Y", $key['Date']),
                "infection" => $key['Infections'],
                "deces" => $key['Deces'],
                "guerisons" => $key['Guerisons'],
            );}
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell('auto',10,utf8_decode("Evolution par jour : ".$country[0]['name']),0,0,'C');
        $pdf->Ln();

        $pdf->SetFont('Helvetica','B',8);
        foreach($header as $col)
            $pdf->Cell(45,6,utf8_decode($col),1);
            $pdf->Ln();
    // Données
        $pdf->SetFont('Helvetica','',9);
        foreach($donneePdf as $row)
        {
            foreach($row as $col)
            $pdf->Cell(45,6,utf8_decode($col),1);
            $pdf->Ln();
        }
        $pdf->Output($country[0]["name"].'-Codid19-'.date("d-m-Y").'.pdf', 'I');

    }

    function export_data_to_csv($country,$filename='export',$delimiter = ';',$enclosure = '"'){
        // Tells to the browser that a file is returned, with its name : $filename.csv
        header("Content-disposition: attachment; filename=$filename.csv");
        // Tells to the browser that the content is a csv file
        header("Content-Type: text/csv");
    
        // I open PHP memory as a file
        $fp = fopen("php://output", 'w');
    
        // Insert the UTF-8 BOM in the file
        fputs($fp, $bom=(chr(0xEF) . chr(0xBB) . chr(0xBF)));
    
        // I add the array keys as CSV headers
        fputcsv($fp,array_keys($country[0]),$delimiter,$enclosure);
    
        // Add all the data in the file
        foreach ($country as $fields) {
            fputcsv($fp, $fields,$delimiter,$enclosure);
        }
    
        // Close the file
        fclose($fp);
    
        // Stop the script
        die();
    }

    public function clearBdd()
    {
        $request = $this->connexion->prepare("Truncate Table daydata");
        $result = $request->execute();
    }

}
