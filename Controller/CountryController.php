<?php

include 'Model/CountryModel.php';
include 'View/CountryView.php';

class CountryController extends Controller
{


    public function __construct()
    {
        $this->view = new CountryView();
        $this->model = new CountryModel();
    }
    //######################################################
    /**
     * Construction de la page d'accueil
     * Liste des informations
     * @return void
     ******************************************************/
    public function list()
    {
        $listCountries = $this->model->getCountries();
        $infection = $this->model->getWorldInfection();
        $worldDeath = $this->model->getWorldDeath();
        $worldHealing = $this->model->getWorldHealing();
        $worldPopulation = $this->model->getWorldPopulation();
        $this->view->displayHome($listCountries, $infection, $worldDeath, $worldHealing, $worldPopulation);
    }

       /**
     * Affichage de la page d'un pays
     *
     * @return void
     */
    public function getCountry(){
        $pays = $_GET['pays'];
        $country = $this->model->getCountry();
        $this->view->modal($country,$pays);
    }

    //     /**
    //  * Gestion de l'affichage du formulaire d'ajout
    //  *
    //  * @return void
    //  */
    // public function updateJson()
    // {
    //     $this->model->getFileJson();
    //     // $this->model->pop();
    //     header('location:index.php?controller=country');
    // }

    // public function uploadFile()
    // {
    //         $countryList = $this->model->parseJson();
    //         $newCountryData = $this->model->parseCountryData();
    //         $oldData = $this->model->getFullDataFromDB();
    //         $newData = $this->model->compare($oldData, $countryList);
    //         // $this->model->pop();
    //         $dataToUpLoad = $this->model->addCodeAndPopulation($countryList,$newCountryData);
    //         // $this->model->uploadDataToDB($dataToUpLoad);
    //         // $this->model->uploadDataToDB($newData);
    //         // header('location:index.php?controller=country');
    // }

    public function automaticUpload()
    {
        $path ="https://www.data.gouv.fr/fr/datasets/r/a7596877-d7c3-4da6-99c1-2f52d418e881";
        $parsedData = $this->model->parseJSONFile($path);
        $newRawData = $parsedData['countries'];
        $oldData = $this->model->getFullDataFromDBase();
        $newData = $this->model->compareFile($oldData, $newRawData);
        $dataToUpload = $this->model->addCodeAndPopulations($newData);
        $this->model->checkCountryList($dataToUpload);
        $this->model->uploadDataToDBase($dataToUpload);
        header("Location: index.php");
    }

    public function uploadFile()
    {
        if (isset($_FILES['uploadFile'])) {
            $file = $_FILES["uploadFile"];
            $fileName = $file['tmp_name'];
            $parsedData = $this->model->parseJSONFile($fileName);
            $newRawData = $parsedData['countries'];
            $oldData = $this->model->getFullDataFromDBase();
            $newData = $this->model->compareFile($oldData, $newRawData);
            $dataToUpload = $this->model->addCodeAndPopulations($newData);
            $this->model->checkCountryList($dataToUpload);
            $this->model->uploadDataToDBase($dataToUpload);
            header("Location: index.php");
        } 
    }

    public function createPdf()
    {
        $country = $this->model->getCountry();
        $this->model->createPdf($country);
    }

    public function export_data_to_csv()
    {
        $country = $this->model->getCountry();
        $this->model->export_data_to_csv($country);
    }

    public function clearBdd()
    {
        $this->model->clearBdd();
        header("Location: index.php");
    }

}