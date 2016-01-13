<?php
namespace Helpers;


class Validation_Exception extends \Exception
{
    public $field;
    public $error;

    public function __construct($field, $errorCode, $param = null)
    {
        $this->field = $field;
        $str = "";

        switch($errorCode) {
            case 1:
                $str = "Pole jest wymagane.";
                break;
            case 2:
                $str = "Wymagane minimum ".$param." znaków";
                break;
            case 3:
                $str = "Dozwolone maksimum ".$param." znaków";
                break;
            case 4:
                $str = "Hasła się różnią.";
                break;
            case 5:
                $str = "To nie jest prawidłowy adres email.";
                break;
            case 6:
                $str = "Dozwolone są litery, cyfry, spacja i myślnik.";
                break;
            case 7:
                $str = "Niepoprawne dane logowania.";
                break;
            case 8:
                $str = "Istnieje już w bazie danych.";
                break;
            case 9:
                $str = "Nie znaleziono takiego użytkownika.";
                break;
            case 10:
                $str = "Plik nie jest zdjęciem.";
                break;
            case 11:
                $str = "Plik jest zbyt duży. Dozwolony rozmiar: ".$param.".";
                break;
            case 12:
                $str = "Plik ma złe rozszerzenie. Dozwolone: ".$param.".";
                break;
            case 13:
                $str = "Wystąpił błąd podczas wgrywania pliku.";
                break;
            default:
                $str = "Validation error code: " . $errorCode;
                break;
        }

        $this->error = $str;
    }
}