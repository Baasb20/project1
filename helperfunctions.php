<?php

class HelperFunctions{

  //hier wordt een functie gemaakt om ervoor te zorgen dat als de input field niet correct gevuld worden dat er een error te voorschijnt.
  public function has_provided_input_for_required_fields($fields){
    if(is_array($fields)){

      //hier wordt de variabele op false gezet
      $error = false;

      foreach ($fields as $fieldname) {
          // hier wordt er gekeken om de field correct is gevuld, zo niet dan is error true.
          if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
            $error = true;
          }
      }

      // als hier de error not is dan wordt er true gegeven
      if(!$error){
        return true;
      }

      return false;
    }else{
      echo "No array has been supplied as arg";
    }

  }

}

?>
