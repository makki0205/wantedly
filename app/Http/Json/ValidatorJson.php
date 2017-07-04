<?php
namespace App\Http\Json;

trait ValidatorJson
{
    private function validateMessage($errors)
    {
        return [
            'code' => 403,
            'errors' => $errors,
        ];
    }
}
